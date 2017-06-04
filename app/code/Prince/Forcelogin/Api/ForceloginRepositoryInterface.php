<?php


namespace Prince\Forcelogin\Api;

use Magento\Framework\Api\SearchCriteriaInterface;

interface ForceloginRepositoryInterface
{


    /**
     * Save forcelogin
     * @param \Prince\Forcelogin\Api\Data\ForceloginInterface $forcelogin
     * @return \Prince\Forcelogin\Api\Data\ForceloginInterface
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    
    public function save(
        \Prince\Forcelogin\Api\Data\ForceloginInterface $forcelogin
    );

    /**
     * Retrieve forcelogin
     * @param string $forceloginId
     * @return \Prince\Forcelogin\Api\Data\ForceloginInterface
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    
    public function getById($forceloginId);

    /**
     * Retrieve forcelogin matching the specified criteria.
     * @param \Magento\Framework\Api\SearchCriteriaInterface $searchCriteria
     * @return \Prince\Forcelogin\Api\Data\ForceloginSearchResultsInterface
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    
    public function getList(
        \Magento\Framework\Api\SearchCriteriaInterface $searchCriteria
    );

    /**
     * Delete forcelogin
     * @param \Prince\Forcelogin\Api\Data\ForceloginInterface $forcelogin
     * @return bool true on success
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    
    public function delete(
        \Prince\Forcelogin\Api\Data\ForceloginInterface $forcelogin
    );

    /**
     * Delete forcelogin by ID
     * @param string $forceloginId
     * @return bool true on success
     * @throws \Magento\Framework\Exception\NoSuchEntityException
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    
    public function deleteById($forceloginId);
}
