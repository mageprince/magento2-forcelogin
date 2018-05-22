<?php

/**
 * MagePrince
 * Copyright (C) 2018 Mageprince
 *
 * NOTICE OF LICENSE
 *
 * This program is free software: you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation, either version 3 of the License, or
 * (at your option) any later version.
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License
 * along with this program. If not, see http://opensource.org/licenses/gpl-3.0.html
 *
 * @category MagePrince
 * @package Prince_Forcelogin
 * @copyright Copyright (c) 2018 MagePrince
 * @license http://opensource.org/licenses/gpl-3.0.html GNU General Public License,version 3 (GPL-3.0)
 * @author MagePrince
 */

namespace Prince\Forcelogin\Helper;

use Magento\Customer\Model\Session;
use Magento\Framework\App\Request\Http;

/**
 * Class Data
 * @package Prince\Forcelogin\Helper
 */
class Data extends \Magento\Framework\App\Helper\AbstractHelper
{
    /**
     * Configuration path of urlcondition
     */
    CONST CONFIG_PATH_URL_CONDITION = 'forcelogin/general/urlcondition';

    /**
     *  Configuration path of module enable/disable status
     */
    CONST CONFIG_PATH_MODULE_ENABLE = 'forcelogin/general/enable';

    /**
     * Configuration path of error message
     */
    CONST CONFIG_PATH_ERROR_MESSAGE = 'forcelogin/general/message';

    /**
     * Default cms page action
     */
    CONST CMS_PAGE_ACTION = 'cms_index_index';

    /**
     * login post url
     */
    CONST LOGIN_POST_URL = 'customer/account/loginPost';

    /**
     * customer login url
     */
    CONST CUSTOMER_LOGIN_URL = 'customer/account/login';
    /**
     * @var \Magento\Customer\Model\Session
     */
    private $customerSession;

    /**
     * @var \Magento\Framework\App\Request\Http
     */
    private $request;

    /**
     * @var \Magento\Framework\UrlInterface
     */
    private $urlInterface;

    /**
     * @var \Prince\Forcelogin\Model\ResourceModel\Forcelogin\CollectionFactory
     */
    private $forceLoginModel;

    /**
     * @var \Magento\Store\Model\StoreManagerInterface
     */
    private $store;

    /**
     * @var \Magento\Framework\App\Config\ScopeConfigInterface
     */
    public $scopeConfig;

    /**
     * Data constructor.
     * @param \Magento\Framework\App\Helper\Context $context
     * @param Session $customerSession
     * @param \Magento\Framework\App\Http\Context $httpContext
     * @param Http $request
     * @param \Prince\Forcelogin\Model\ResourceModel\Forcelogin\CollectionFactory $forceLoginModel
     * @param \Magento\Store\Model\StoreManagerInterface $storeManager
     */
    public function __construct(
        \Magento\Framework\App\Helper\Context $context,
        Session $customerSession,
        \Magento\Framework\App\Http\Context $httpContext,
        Http $request,
        \Prince\Forcelogin\Model\ResourceModel\Forcelogin\CollectionFactory $forceLoginModel,
        \Magento\Store\Model\StoreManagerInterface $storeManager
    ) {
        $this->customerSession = $customerSession;
        $this->httpContext = $httpContext;
        $this->request = $request;
        $this->urlInterface = $context->getUrlBuilder();
        $this->scopeConfig = $context->getScopeConfig();
        $this->forceLoginModel = $forceLoginModel;
        $this->store = $storeManager;
        parent::__construct($context);
    }

    /**
     * Retrieve current url
     *
     * @return string
     */
    public function getCurrentUrl()
    {
        return $this->urlInterface->getCurrentUrl();
    }

    /**
     * Retrieve current url after base url path
     *
     * @return string
     */
    public function getAfterBaseUrl()
    {
        $currentUrl = $this->urlInterface->getCurrentUrl();
        $baseUrl = $this->urlInterface->getBaseUrl();
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
        return $this->forceLoginModel->create();
    }
    
    /**
     * Retrieve url collection
     *
     * @param string $url
     * @return int
     */
    public function getUrlCollection($url)
    {
        $collection = $this->getCollection()->addFieldToFilter('url', $url);
        $collection->addFieldToFilter('status', 1);
        $collection->addFieldToFilter(
            'customer_group',
            [
                ['null' => true],
                ['finset' => $this->getCurrentCustomer()]
            ]
        );
        $collection->addFieldToFilter(
            'storeview',
            [
                ['eq' => 0],
                ['finset' => $this->getCurrentStore()]
            ]
        );

        return $collection->getSize();
    }

    /**
     * Retrieve current customer group id
     *
     * @return int
     */
    public function getCurrentCustomer()
    {
        return $this->customerSession->getCustomer()->getGroupId();
    }

    /**
     * Retrieve current store Id
     *
     * @return int
     */
    public function getCurrentStore()
    {
        return $this->store->getStore()->getId();
    }

    /**
     * Retrieve config value
     *
     * @return string
     */
    public function getConfig($path)
    {
        return $this->scopeConfig->getValue(
            $path,
            \Magento\Store\Model\ScopeInterface::SCOPE_STORE
        );
    }

    /**
     * Retrive url condition
     *
     * @return number
     */
    public function getUrlCondition()
    {
        return $this->getConfig(self::CONFIG_PATH_URL_CONDITION);
    }

    /**
     * Retrive module status
     *
     * @return string
     */
    public function getEnable()
    {
        return $this->getConfig(self::CONFIG_PATH_MODULE_ENABLE);
    }

    /**
     * Retrieve error message
     *
     * @return string
     */
    public function getMessage()
    {
        return $this->getConfig(self::CONFIG_PATH_ERROR_MESSAGE);
    }

    /**
     * Check customer is loggedIn or not
     *
     * @return boolean
     */
    public function checkCustomerlogin()
    {
        $isLoggedIn = $this->httpContext->getValue(\Magento\Customer\Model\Context::CONTEXT_AUTH);
        if($isLoggedIn) {
            return true;
        }
        return false;
    }
    
    /**
     * Default actions
     *
     * @return bool
     */
    public function getDefaultAction()
    {
        $currentAction = $this->request->getFullActionName();
        $defaultActions = [
            'customer_account_login',
            'customer_account_logoutSuccess',
            'customer_account_create',
            'customer_account_index',
            'customer_account_forgotpassword',
            'customer_account_forgotpasswordpost'
        ];
        $currentUrl = $this->getCurrentUrl();
        $loginPostUrl = $this->urlInterface->getUrl(self::LOGIN_POST_URL);
        if (!in_array($currentAction, $defaultActions) && ($currentUrl != $loginPostUrl)) {
            return false;
        } else {
            return true;
        }
    }

    /**
     * Check is current page is homepage
     *
     * @return bool
     */
    public function checkIsHomePage()
    {
        $currentAction = $this->request->getFullActionName();
        if($currentAction == self::CMS_PAGE_ACTION) {
            return true;
        }
    }
}
