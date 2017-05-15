<?php 


namespace Prince\Forcelogin\Model\Observer;

use Magento\Framework\Event\ObserverInterface;
use Magento\Framework\Event\Observer;

class Forcelogin implements ObserverInterface
{   
    /**
     * @var \Prince\Forcelogin\Helper\Data
     */
    protected $_helper;

    /**
     * @var Magento\Framework\App\ResponseFactory
     */
    protected $_responseFactory;

    /**
     * @var \Magento\Framework\UrlInterface
     */
    protected $_url;

    /**
     * @var \Magento\Framework\Message\ManagerInterface
     */
    protected $_messageManager;

    /**
     * @param \Prince\Forcelogin\Helper\Data              $helper
     * @param \Magento\Framework\App\ResponseFactory      $responseFactory
     * @param \Magento\Framework\UrlInterface             $url
     * @param \Magento\Framework\Message\ManagerInterface $messageManager
     */
    public function __construct(
        \Prince\Forcelogin\Helper\Data $helper,
        \Magento\Framework\App\ResponseFactory $responseFactory,
        \Magento\Framework\UrlInterface $url,
        \Magento\Framework\Message\ManagerInterface $messageManager
    )
    {   
        $this->_responseFactory = $responseFactory;
        $this->_helper = $helper;
        $this->_url = $url;
        $this->_messageManager = $messageManager;
    }
    
    public function execute(Observer $observer)
    {    
        $url = $this->_helper->getAfterBaseUrl(); 
        $collection = $this->_helper->getUrlCollection($url);
        
        $enable = $this->_helper->getEnable();
        $urlCondition = $this->_helper->getConfig();
        $defaultAction = $this->_helper->getDefaultAction();
        $isCustomerLogin = $this->_helper->checkCustomerlogin();
        $message = "Please login or create account to access page";
        
        if(!$defaultAction && !$isCustomerLogin && $enable)
        {    
            if($urlCondition)
            {
                if(!$collection)
                {
                    $this->_messageManager->addError($message);
                    $CustomRedirectionUrl = $this->_url->getUrl('customer/account/login');
                    $this->_responseFactory->create()->setRedirect($CustomRedirectionUrl)->sendResponse();
                    exit();
                }   
            }else{
                if($collection)
                {
                    $this->_messageManager->addError($message);
                    $CustomRedirectionUrl = $this->_url->getUrl('customer/account/login');
                    $this->_responseFactory->create()->setRedirect($CustomRedirectionUrl)->sendResponse();
                    exit();
                } 
            }
        }
    }

}