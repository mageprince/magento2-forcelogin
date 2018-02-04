<?php


namespace Prince\Forcelogin\Controller\Adminhtml\Forcelogin;

class Edit extends \Prince\Forcelogin\Controller\Adminhtml\Forcelogin
{
    /**
     * @var \Magento\Framework\Registry
     */
    private $resultPageFactory;

    /**
     * @var \Magento\Framework\Registry
     */
    private $coreRegistry;

    /**
     * @var \Prince\Forcelogin\Model\Forcelogin
     */
    private $forceLoginModel;

    /**
     * @param \Magento\Backend\App\Action\Context $context
     * @param \Magento\Framework\Registry $coreRegistry
     * @param \Magento\Framework\View\Result\PageFactory $resultPageFactory
     * @param \Prince\Forcelogin\Model\Forcelogin $forceLoginModel
     */
    public function __construct(
        \Magento\Backend\App\Action\Context $context,
        \Magento\Framework\Registry $coreRegistry,
        \Magento\Framework\View\Result\PageFactory $resultPageFactory,
        \Prince\Forcelogin\Model\Forcelogin $forceLoginModel
    ) {
        $this->resultPageFactory = $resultPageFactory;
        $this->coreRegistry = $coreRegistry;
        $this->forceLoginModel = $forceLoginModel;
        parent::__construct($context, $coreRegistry);
    }

    /**
     * Edit action
     *
     * @return \Magento\Framework\Controller\ResultInterface
     */
    public function execute()
    {
        // 1. Get ID and create model
        $id = $this->getRequest()->getParam('forcelogin_id');
        $model = $this->forceLoginModel;
        
        // 2. Initial checking
        if ($id) {
            $model->load($id);
            if (!$model->getId()) {
                $this->messageManager->addError(__('This URL no longer exists.'));
                /** @var \Magento\Backend\Model\View\Result\Redirect $resultRedirect */
                $resultRedirect = $this->resultRedirectFactory->create();
                return $resultRedirect->setPath('*/*/');
            }
        }
        $this->coreRegistry->register('prince_forcelogin_forcelogin', $model);
        
        // 5. Build edit form
        /** @var \Magento\Backend\Model\View\Result\Page $resultPage */
        $resultPage = $this->resultPageFactory->create();
        $this->initPage($resultPage)->addBreadcrumb(
            $id ? __('Edit Forcelogin') : __('New URL'),
            $id ? __('Edit Forcelogin') : __('New URL')
        );
        $resultPage->getConfig()->getTitle()->prepend(__('Forcelogins'));
        $resultPage->getConfig()->getTitle()->prepend($model->getId() ? $model->getTitle() : __('New URL'));
        return $resultPage;
    }
}
