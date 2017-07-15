<?php

namespace Prince\Adminlogs\Model\Observer;
 
use Magento\Framework\Event\Observer;
use Magento\Framework\Event\ObserverInterface;
use Magento\Backend\Model\Auth\Session;

/**
 * Class Adminlogin
 * @package Prince\Adminlogs\Model\Observer
 */
class Adminlogin implements ObserverInterface
{
    /**
     * @var Session $authSession
     */
    private $authSession;

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
     * @param Session $authSession
     * @param \Prince\Adminlogs\Model\AdminlogsFactory $adminLogsModel
     * @param \Magento\Framework\HTTP\PhpEnvironment\RemoteAddress $ipAddress 
     */
    public function __construct(
        Session $authSession,
        \Prince\Adminlogs\Model\AdminlogsFactory $adminLogsModel,
        \Magento\Framework\HTTP\PhpEnvironment\RemoteAddress $ipAddress
    ) {
        $this->authSession = $authSession;
        $this->adminLogsModel = $adminLogsModel;
        $this->ipAddress = $ipAddress;
    }

    /**
     * Admin Login Success Action
     */
    public function execute(Observer $observer)
    {
        $user = $this->authSession->getUser();
        $ipAddress = $this->ipAddress->getRemoteAddress();
        $model = $this->adminLogsModel->create();
        $model->setUsername($user->getUsername());
        $model->setIpaddress($ipAddress);
        $model->setStatus(1);
        $model->setDate(date('Y-m-d H:i:s'));
        $model->save();
    }
}
