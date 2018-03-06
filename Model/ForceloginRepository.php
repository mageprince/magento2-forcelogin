<?php

/**
 * MagePrince
 * Copyright (C) 2018 Mageprince
 *
 * NOTICE OF LICENSE
 *
 * This program is free software: you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation, either version 3 of the License, or
 * (at your option) any later version.
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License
 * along with this program. If not, see http://opensource.org/licenses/gpl-3.0.html
 *
 * @category MagePrince
 * @package Prince_Forcelogin
 * @copyright Copyright (c) 2018 MagePrince
 * @license http://opensource.org/licenses/gpl-3.0.html GNU General Public License,version 3 (GPL-3.0)
 * @author MagePrince
 */

namespace Prince\Forcelogin\Model;

use Magento\Framework\Reflection\DataObjectProcessor;
use Prince\Forcelogin\Model\ResourceModel\Forcelogin\CollectionFactory as ForceloginCollectionFactory;
use Prince\Forcelogin\Model\ResourceModel\Forcelogin as ResourceForcelogin;
use Magento\Framework\Exception\NoSuchEntityException;
use Magento\Framework\Api\SortOrder;
use Magento\Framework\Exception\CouldNotSaveException;
use Prince\Forcelogin\Api\Data\ForceloginSearchResultsInterfaceFactory;
use Prince\Forcelogin\Api\ForceloginRepositoryInterface;
use Magento\Framework\Api\DataObjectHelper;
use Prince\Forcelogin\Api\Data\ForceloginInterfaceFactory;
use Magento\Framework\Exception\CouldNotDeleteException;
use Magento\Store\Model\StoreManagerInterface;

class ForceloginRepository implements forceloginRepositoryInterface
{
    /**
     * @var DataObjectHelper
     */
    private $dataObjectHelper;

    /**
     * @var ForceloginInterfaceFactory
     */
    private $dataForceloginFactory;

    /**
     * @var ForceloginSearchResultsInterfaceFactory
     */
    private $searchResultsFactory;

    /**
     * @var StoreManagerInterface
     */
    private $storeManager;

    /**
     * @var ResourceForcelogin
     */
    private $resource;

    /**
     * @var DataObjectHelper
     */
    private $dataObjectProcessor;

    /**
     * @var ForceloginFactory
     */
    private $forceloginFactory;

    /**
     * @var ForceloginCollectionFactory
     */
    private $forceloginCollectionFactory;

    /**
     * @param ResourceForcelogin $resource
     * @param ForceloginFactory $forceloginFactory
     * @param ForceloginInterfaceFactory $dataForceloginFactory
     * @param ForceloginCollectionFactory $forceloginCollectionFactory
     * @param ForceloginSearchResultsInterfaceFactory $searchResultsFactory
     * @param DataObjectHelper $dataObjectHelper
     * @param DataObjectProcessor $dataObjectProcessor
     * @param StoreManagerInterface $storeManager
     */
    public function __construct(
        ResourceForcelogin $resource,
        ForceloginFactory $forceloginFactory,
        ForceloginInterfaceFactory $dataForceloginFactory,
        ForceloginCollectionFactory $forceloginCollectionFactory,
        ForceloginSearchResultsInterfaceFactory $searchResultsFactory,
        DataObjectHelper $dataObjectHelper,
        DataObjectProcessor $dataObjectProcessor,
        StoreManagerInterface $storeManager
    ) {
        $this->resource = $resource;
        $this->forceloginFactory = $forceloginFactory;
        $this->forceloginCollectionFactory = $forceloginCollectionFactory;
        $this->searchResultsFactory = $searchResultsFactory;
        $this->dataObjectHelper = $dataObjectHelper;
        $this->dataForceloginFactory = $dataForceloginFactory;
        $this->dataObjectProcessor = $dataObjectProcessor;
        $this->storeManager = $storeManager;
    }

    /**
     * {@inheritdoc}
     */
    public function save(
        \Prince\Forcelogin\Api\Data\ForceloginInterface $forcelogin
    ) {
        try {
            $this->resource->save($forcelogin);
        } catch (\Exception $exception) {
            throw new CouldNotSaveException(__(
                'Could not save the forcelogin: %1',
                $exception->getMessage()
            ));
        }
        return $forcelogin;
    }

    /**
     * {@inheritdoc}
     */
    public function getById($forceloginId)
    {
        $forcelogin = $this->forceloginFactory->create();
        $forcelogin->load($forceloginId);
        if (!$forcelogin->getId()) {
            throw new NoSuchEntityException(__('forcelogin with id "%1" does not exist.', $forceloginId));
        }
        return $forcelogin;
    }

    /**
     * {@inheritdoc}
     */
    public function getList(
        \Magento\Framework\Api\SearchCriteriaInterface $criteria
    ) {
        $searchResults = $this->searchResultsFactory->create();
        $searchResults->setSearchCriteria($criteria);
        
        $collection = $this->forceloginCollectionFactory->create();
        foreach ($criteria->getFilterGroups() as $filterGroup) {
            foreach ($filterGroup->getFilters() as $filter) {
                if ($filter->getField() === 'store_id') {
                    $collection->addStoreFilter($filter->getValue(), false);
                    continue;
                }
                $condition = $filter->getConditionType() ?: 'eq';
                $collection->addFieldToFilter($filter->getField(), [$condition => $filter->getValue()]);
            }
        }
        $searchResults->setTotalCount($collection->getSize());
        $sortOrders = $criteria->getSortOrders();
        if ($sortOrders) {
            /** @var SortOrder $sortOrder */
            foreach ($sortOrders as $sortOrder) {
                $collection->addOrder(
                    $sortOrder->getField(),
                    ($sortOrder->getDirection() == SortOrder::SORT_ASC) ? 'ASC' : 'DESC'
                );
            }
        }
        $collection->setCurPage($criteria->getCurrentPage());
        $collection->setPageSize($criteria->getPageSize());
        $items = [];
        
        foreach ($collection as $forceloginModel) {
            $forceloginData = $this->dataForceloginFactory->create();
            $this->dataObjectHelper->populateWithArray(
                $forceloginData,
                $forceloginModel->getData(),
                'Prince\Forcelogin\Api\Data\ForceloginInterface'
            );
            $items[] = $this->dataObjectProcessor->buildOutputDataArray(
                $forceloginData,
                'Prince\Forcelogin\Api\Data\ForceloginInterface'
            );
        }
        $searchResults->setItems($items);
        return $searchResults;
    }

    /**
     * {@inheritdoc}
     */
    public function delete(
        \Prince\Forcelogin\Api\Data\ForceloginInterface $forcelogin
    ) {
        try {
            $this->resource->delete($forcelogin);
        } catch (\Exception $exception) {
            throw new CouldNotDeleteException(__(
                'Could not delete the forcelogin: %1',
                $exception->getMessage()
            ));
        }
        return true;
    }

    /**
     * {@inheritdoc}
     */
    public function deleteById($forceloginId)
    {
        return $this->delete($this->getById($forceloginId));
    }
}
