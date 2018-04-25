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
     * @param \Magento\Framework\App\Response\Http $redirect
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
            if($urlCondition == "2") {
                if (!$this->helper->checkIsHomePage()) {
                    $this->messageManager->addError($message);
                    $customRedirectionUrl = $this->url->getUrl('customer/account/login');
                    $this->redirect->setRedirect($customRedirectionUrl);
                }
            } else {
                if ($urlCondition && !$collection) {
                    $this->messageManager->addError($message);
                    $customRedirectionUrl = $this->url->getUrl('customer/account/login');
                    $this->redirect->setRedirect($customRedirectionUrl);
                } elseif (!$urlCondition && $collection) {
                    $this->messageManager->addError($message);
                    $customRedirectionUrl = $this->url->getUrl('customer/account/login');
                    $this->redirect->setRedirect($customRedirectionUrl);
                }
            }
        }
    }
}
