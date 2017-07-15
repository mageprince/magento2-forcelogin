<?php


namespace Prince\Adminlogs\Model\ResourceModel\Adminlogs;

/**
 * Class Collection
 * @package Prince\Adminlogs\Model\ResourceModel\Adminlogs
 */
class Collection extends \Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection
{
    protected $_idFieldName = 'adminlogs_id';

    /**
     * Define resource model
     *
     * @return void
     */
    public function _construct()
    {
        $this->_init(
            'Prince\Adminlogs\Model\Adminlogs',
            'Prince\Adminlogs\Model\ResourceModel\Adminlogs'
        );
    }
}
