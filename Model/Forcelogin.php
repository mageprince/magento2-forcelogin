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

use Prince\Forcelogin\Api\Data\ForceloginInterface;

class Forcelogin extends \Magento\Framework\Model\AbstractModel implements ForceloginInterface
{

    /**
     * @return void
     */
    public function _construct()
    {
        $this->_init('Prince\Forcelogin\Model\ResourceModel\Forcelogin');
    }

    /**
     * Get forcelogin_id
     * @return string
     */
    public function getForceloginId()
    {
        return $this->getData(self::FORCELOGIN_ID);
    }

    /**
     * Set forcelogin_id
     * @param string $forceloginId
     * @return Prince\Forcelogin\Api\Data\ForceloginInterface
     */
    public function setForceloginId($forceloginId)
    {
        return $this->setData(self::FORCELOGIN_ID, $forceloginId);
    }

    /**
     * Get name
     * @return string
     */
    public function getName()
    {
        return $this->getData(self::NAME);
    }

    /**
     * Set name
     * @param string $name
     * @return Prince\Forcelogin\Api\Data\ForceloginInterface
     */
    public function setName($name)
    {
        return $this->setData(self::NAME, $name);
    }

    /**
     * Get url
     * @return string
     */
    public function getUrl()
    {
        return $this->getData(self::URL);
    }

    /**
     * Set url
     * @param string $url
     * @return Prince\Forcelogin\Api\Data\ForceloginInterface
     */
    public function setUrl($url)
    {
        return $this->setData(self::URL, $url);
    }

    /**
     * Get storeview
     * @return string
     */
    public function getStoreview()
    {
        return $this->getData(self::STOREVIEW);
    }

    /**
     * Set storeview
     * @param string $storeview
     * @return Prince\Forcelogin\Api\Data\ForceloginInterface
     */
    public function setStoreview($storeview)
    {
        return $this->setData(self::STOREVIEW, $storeview);
    }

    /**
     * Get customer_group
     * @return string
     */
    public function getCustomerGroup()
    {
        return $this->getData(self::CUSTOMER_GROUP);
    }

    /**
     * Set customer_group
     * @param string $customer_group
     * @return Prince\Forcelogin\Api\Data\ForceloginInterface
     */
    public function setCustomerGroup($customer_group)
    {
        return $this->setData(self::CUSTOMER_GROUP, $customer_group);
    }

    /**
     * Get status
     * @return string
     */
    public function getStatus()
    {
        return $this->getData(self::STATUS);
    }

    /**
     * Set status
     * @param string $status
     * @return Prince\Forcelogin\Api\Data\ForceloginInterface
     */
    public function setStatus($status)
    {
        return $this->setData(self::STATUS, $status);
    }
}
