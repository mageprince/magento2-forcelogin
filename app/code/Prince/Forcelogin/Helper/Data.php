<?php

namespace Prince\Forcelogin\Helper;

class Data extends \Magento\Framework\App\Helper\AbstractHelper
{
    /**
     * @var \Magento\Framework\UrlInterface
     */
    protected $_urlInterface;

    /**
     * @var \Prince\Forcelogin\Model\Forcelogin
     */
    protected $_forceLoginModel;

    /**
     * @var \Magento\Customer\Model\Session
     */
    protected $_customerSession;

    /**
     * @var \Magento\Store\Model\StoreManagerInterface
     */
    protected $_store;

    /**
     * @var \Magento\Framework\App\Request\Http
     */
    protected $_request;

    /**
     * @var \Magento\Framework\App\Config\ScopeConfigInterface
     */
    protected $_scopeConfig;

    /**
     * @var \Magento\Customer\Model\Session
     */
    protected $_session;

    /**
     * @param \Magento\Framework\UrlInterface $urlInterface
     * @param \Prince\Forcelogin\Model\Forcelogin $forceLoginModel
     * @param \Magento\Customer\Model\Session $customerSession
     * @param \Magento\Store\Model\StoreManagerInterface $storeManager
     * @param \Magento\Framework\App\Request\Http $request
     * @param \Magento\Framework\App\Config\ScopeConfigInterface $scopeConfig
     * @param \Magento\Customer\Model\Session $session
     */
    public function __construct(
        \Magento\Framework\UrlInterface $urlInterface,
        \Prince\Forcelogin\Model\Forcelogin $forceLoginModel,
        \Magento\Customer\Model\Session $customerSession,
        \Magento\Store\Model\StoreManagerInterface $storeManager,
        \Magento\Framework\App\Request\Http $request,
        \Magento\Framework\App\Config\ScopeConfigInterface $scopeConfig,
        \Magento\Customer\Model\Session $session

    )
    {
        $this->_urlInterface = $urlInterface;
        $this->_forceLoginModel = $forceLoginModel;
        $this->_customerSession = $customerSession;
        $this->_store = $storeManager;
        $this->_request = $request;
        $this->_scopeConfig = $scopeConfig;
        $this->_session = $session;
    }


    /**
     * Retrieve current url
     *
     * @return string
     */
    public function getCurrentUrl()
    {
        return $this->_urlInterface->getCurrentUrl();
    }

    /**
     * Retrieve current url after base url path
     *
     * @return string
     */
    public function getAfterBaseUrl()
    {
        $currentUrl = $this->_urlInterface->getCurrentUrl();
        $baseUrl = $this->_urlInterface->getBaseUrl();
        $url = rtrim(str_replace($baseUrl, "", $currentUrl), '/');
        return $url;
    }

    /**
     * Retrieve forcelogin collection
     *
     * @return collection
     */
    public function getCollection()
    {
        return $this->_forceLoginModel->getCollection();

    }
    
    /**
     * Retrieve url collection
     *
     * @return Number
     */
    public function getUrlCollection($url)
    {
        $collection = $this->getCollection()->addFieldToFilter('url', $url);
        $collection->addFieldToFilter('status', 1);
        $collection->addFieldToFilter(
            'customer_group',
                array(
                    array('null' => true),
                    array('finset' => $this->getCurrentCustomer())
                    )
                );
        $collection->addFieldToFilter(
            'storeview', 
            array(
                array('eq' => 0),
                array('finset' => $this->getCurrentStore())
                )
            );

        return $collection->count();
    }

    /**
     * Retrieve current customer group id
     *
     * @return Number
     */
    public function getCurrentCustomer()
    {
        return $this->_customerSession->getCustomer()->getGroupId();
    }

    /**
     * Retrieve current store Id
     *
     * @return Number
     */
    public function getCurrentStore()
    {
        return $this->_store->getStore()->getId();
    }

    /**
     * Retrieve config value
     */
    public function getConfig()
    {
        return $this->_scopeConfig->getValue('forcelogin/general/urlcondition', \Magento\Store\Model\ScopeInterface::SCOPE_STORE);
    }

    public function getEnable()
    {
        return $this->_scopeConfig->getValue('forcelogin/general/enable', \Magento\Store\Model\ScopeInterface::SCOPE_STORE);
    }

    public function checkCustomerlogin()
    {
        if ($this->_session->isLoggedIn()) {
            return true; 
        } else {
            return false;
        }
    }
    
    public function getDefaultAction()
    {   
        $currentAction = $this->_request->getFullActionName();
        $loginAction = "customer_account_login";
        $logoutAction = "customer_account_logoutSuccess";
        $registerAction = "customer_account_create";
        $accountAction = "customer_account_index";
        $currentUrl = $this->getCurrentUrl();
        $loginPostUrl = $this->_urlInterface->getUrl('customer/account/loginPost');
        if($currentAction != $loginAction
            && $currentAction != $logoutAction 
            && $currentAction != $registerAction
            && $currentAction != $accountAction
            && $currentUrl != $loginPostUrl
        ){
            return false;
        }else{
            return true;
        }
        
    }

}