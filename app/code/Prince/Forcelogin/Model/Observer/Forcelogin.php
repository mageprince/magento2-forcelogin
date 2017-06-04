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
     * @var Magento\Framework\App\ResponseFactory
     */
    private $responseFactory;

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
     * @param \Magento\Framework\App\ResponseFactory $responseFactory
     * @param \Magento\Framework\UrlInterface $url
     * @param \Magento\Framework\Message\ManagerInterface $messageManager
     */
    public function __construct(
        \Prince\Forcelogin\Helper\Data $helper,
        \Magento\Framework\App\ResponseFactory $responseFactory,
        \Magento\Framework\UrlInterface $url,
        \Magento\Framework\Message\ManagerInterface $messageManager
    ) {
        $this->responseFactory = $responseFactory;
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
            if ($urlCondition) {
                if (!$collection) {
                    $this->messageManager->addError($message);
                    $CustomRedirectionUrl = $this->url->getUrl('customer/account/login');
                    $this->responseFactory->create()->setRedirect($CustomRedirectionUrl)->sendResponse();
                    die();
                }
            } else {
                if ($collection) {
                    $this->messageManager->addError($message);
                    $CustomRedirectionUrl = $this->url->getUrl('customer/account/login');
                    $this->responseFactory->create()->setRedirect($CustomRedirectionUrl)->sendResponse();
                    die();
                }
            }
        }
    }
}
