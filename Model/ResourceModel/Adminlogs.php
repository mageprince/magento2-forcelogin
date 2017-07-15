<?php


namespace Prince\Adminlogs\Model\ResourceModel;

/**
 * Class Adminlogs
 * @package Prince\Adminlogs\Model\ResourceModel
 */
class Adminlogs extends \Magento\Framework\Model\ResourceModel\Db\AbstractDb
{

    /**
     * Define resource model
     *
     * @return void
     */
    public function _construct()
    {
        $this->_init('prince_adminlogs', 'adminlogs_id');
    }
}
