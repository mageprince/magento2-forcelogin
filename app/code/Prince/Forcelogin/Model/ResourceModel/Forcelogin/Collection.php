<?php


namespace Prince\Forcelogin\Model\ResourceModel\Forcelogin;

class Collection extends \Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection
{
    protected $_idFieldName = 'forcelogin_id';
    
    /**
     * Define resource model
     *
     * @return void
     */
    public function _construct()
    {
        $this->_init(
            'Prince\Forcelogin\Model\Forcelogin',
            'Prince\Forcelogin\Model\ResourceModel\Forcelogin'
        );
    }
}
