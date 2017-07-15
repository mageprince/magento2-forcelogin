<?php

namespace Prince\Adminlogs\Model\Observer;
 
use Magento\Framework\Event\Observer;
use Magento\Framework\Event\ObserverInterface;

/**
 * Class Adminloginfail
 * @package Prince\Adminlogs\Model\Observer
 */
class Adminloginfail implements ObserverInterface
{
    /**
     * @var \Prince\Adminlogs\Model\AdminlogsFactory
     */
    private $adminLogsModel;

    /**
     * @var \Magento\Framework\HTTP\PhpEnvironment\RemoteAddress
     */
    private $ipAddress;

    /**
     * Constructor
     *
     * @param \Prince\Adminlogs\Model\AdminlogsFactory $adminLogsModel
     * @param \Magento\Framework\HTTP\PhpEnvironment\RemoteAddress $ipAddress
     */
    public function __construct(
        \Prince\Adminlogs\Model\AdminlogsFactory $adminLogsModel,
        \Magento\Framework\HTTP\PhpEnvironment\RemoteAddress $ipAddress
    ) {
        $this->adminLogsModel = $adminLogsModel;
        $this->ipAddress = $ipAddress;
    }

    /**
     * Admin Login Fail Action
     */
    public function execute(Observer $observer)
    {
        $ipAddress = $this->ipAddress->getRemoteAddress();
        $model = $this->adminLogsModel->create();
        $model->setUsername($observer->getUserName());
        $model->setIpaddress($ipAddress);
        $model->setStatus(0);
        $model->setDate(date('Y-m-d H:i:s'));
        $model->save();
    }
}
