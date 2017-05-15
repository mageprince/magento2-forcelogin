<?php


namespace Prince\Forcelogin\Model;

use Prince\Forcelogin\Api\Data\ForceloginInterface;

class Forcelogin extends \Magento\Framework\Model\AbstractModel implements ForceloginInterface
{

    /**
     * @return void
     */
    protected function _construct()
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
