<?php


namespace Prince\Forcelogin\Model\ResourceModel;

class Forcelogin extends \Magento\Framework\Model\ResourceModel\Db\AbstractDb
{

    /**
     * Define resource model
     *
     * @return void
     */
    public function _construct()
    {
        $this->_init('prince_forcelogin', 'forcelogin_id');
    }
}
