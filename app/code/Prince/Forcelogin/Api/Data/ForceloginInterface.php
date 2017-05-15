<?php


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
