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

namespace Prince\Forcelogin\Api\Data;

interface ForceloginInterface
{
    const URL = 'url';
    const FORCELOGIN_ID = 'forcelogin_id';
    const CUSTOMER_GROUP = 'customer_group';
    const NAME = 'name';
    const STOREVIEW = 'storeview';
    const STATUS = 'status';

    /**
     * Get forcelogin_id
     * @return string|null
     */
    
    public function getForceloginId();

    /**
     * Set forcelogin_id
     * @param string $forcelogin_id
     * @return Prince\Forcelogin\Api\Data\ForceloginInterface
     */
    
    public function setForceloginId($forceloginId);

    /**
     * Get name
     * @return string|null
     */
    
    public function getName();

    /**
     * Set name
     * @param string $name
     * @return Prince\Forcelogin\Api\Data\ForceloginInterface
     */
    
    public function setName($name);

    /**
     * Get url
     * @return string|null
     */
    
    public function getUrl();

    /**
     * Set url
     * @param string $url
     * @return Prince\Forcelogin\Api\Data\ForceloginInterface
     */
    
    public function setUrl($url);

    /**
     * Get storeview
     * @return string|null
     */
    
    public function getStoreview();

    /**
     * Set storeview
     * @param string $storeview
     * @return Prince\Forcelogin\Api\Data\ForceloginInterface
     */
    
    public function setStoreview($storeview);

    /**
     * Get customer_group
     * @return string|null
     */
    
    public function getCustomerGroup();

    /**
     * Set customer_group
     * @param string $customer_group
     * @return Prince\Forcelogin\Api\Data\ForceloginInterface
     */
    
    public function setCustomerGroup($customer_group);

    /**
     * Get status
     * @return string|null
     */
    
    public function getStatus();

    /**
     * Set status
     * @param string $status
     * @return Prince\Forcelogin\Api\Data\ForceloginInterface
     */
    
    public function setStatus($status);
}
