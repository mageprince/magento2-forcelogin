<?php


namespace Prince\Forcelogin\Controller\Adminhtml;

abstract class Forcelogin extends \Magento\Backend\App\Action
{

    const ADMIN_RESOURCE = 'Prince_Forcelogin::top_level';
    protected $_coreRegistry;

    /**
     * @param \Magento\Backend\App\Action\Context $context
     * @param \Magento\Framework\Registry $coreRegistry
     */
    public function __construct(
        \Magento\Backend\App\Action\Context $context,
        \Magento\Framework\Registry $coreRegistry
    ) {
        $this->_coreRegistry = $coreRegistry;
        parent::__construct($context);
    }

    /**
     * Init page
     *
     * @param \Magento\Backend\Model\View\Result\Page $resultPage
     */
    public function initPage($resultPage)
    {
        $resultPage->setActiveMenu('Experius_Test::top_level')
            ->addBreadcrumb(__('Prince'), __('Prince'))
            ->addBreadcrumb(__('Forcelogin'), __('Forcelogin'));
        return $resultPage;
    }
}
