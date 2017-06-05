<?php


namespace Prince\Forcelogin\Model\Observer;

use Magento\Framework\Event\ObserverInterface;
use Magento\Framework\Event\Observer;

class Forcelogin implements ObserverInterface
{
    /**
     * @var \Prince\Forcelogin\Helper\Data
     */
    private $helper;

    /**
     * @var Magento\Framework\App\Response\Http
     */
    private $redirect;

    /**
     * @var \Magento\Framework\UrlInterface
     */
    private $url;

    /**
     * @var \Magento\Framework\Message\ManagerInterface
     */
    private $messageManager;

    /**
     * @param \Prince\Forcelogin\Helper\Data $helper
     * @param Magento\Framework\App\Response\Http $redirect
     * @param \Magento\Framework\UrlInterface $url
     * @param \Magento\Framework\Message\ManagerInterface $messageManager
     */
    public function __construct(
        \Prince\Forcelogin\Helper\Data $helper,
        \Magento\Framework\App\Response\Http $redirect,
        \Magento\Framework\UrlInterface $url,
        \Magento\Framework\Message\ManagerInterface $messageManager
    ) {
        $this->redirect = $redirect;
        $this->helper = $helper;
        $this->url = $url;
        $this->messageManager = $messageManager;
    }
    
    public function execute(Observer $observer)
    {
        $url = $this->helper->getAfterBaseUrl();
        $collection = $this->helper->getUrlCollection($url);
        $enable = $this->helper->getEnable();
        $urlCondition = $this->helper->getConfig();
        $defaultAction = $this->helper->getDefaultAction();
        $isCustomerLogin = $this->helper->checkCustomerlogin();
        $message = $this->helper->getMessage();
        
        if (!$defaultAction && !$isCustomerLogin && $enable) {
            if ($urlCondition && !$collection) {
                $this->messageManager->addError($message);
                $customRedirectionUrl = $this->url->getUrl('customer/account/login');
                $this->redirect->setRedirect($customRedirectionUrl);
            } elseif ($collection) {
                $this->messageManager->addError($message);
                $customRedirectionUrl = $this->url->getUrl('customer/account/login');
                $this->redirect->setRedirect($customRedirectionUrl);
            }
        }
    }
}
