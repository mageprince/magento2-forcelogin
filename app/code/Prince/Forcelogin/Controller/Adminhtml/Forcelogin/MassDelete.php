<?php


namespace Prince\Forcelogin\Controller\Adminhtml\Forcelogin;

class MassDelete extends \Magento\Backend\App\Action {

    protected $_filter;

    protected $_collectionFactory;
    
    /**
     * Constructor
     *
     * @param \Magento\Ui\Component\MassAction\Filter $filter
     * @param \Prince\Forcelogin\Model\ResourceModel\Forcelogin\CollectionFactory $collectionFactory
     * @param \Magento\Backend\App\Action\Context $context
     */
    public function __construct(
        \Magento\Ui\Component\MassAction\Filter $filter,
        \Prince\Forcelogin\Model\ResourceModel\Forcelogin\CollectionFactory $collectionFactory,
        \Magento\Backend\App\Action\Context $context
        ) {
        $this->_filter            = $filter;
        $this->_collectionFactory = $collectionFactory;
        parent::__construct($context);
    }

    public function execute() {
        try{ 
            $logCollection = $this->_filter->getCollection($this->_collectionFactory->create());

            $itemsDeleted = 0;
            foreach ($logCollection as $item) {
                $item->delete();
                $itemsDeleted++;
            }
            $this->messageManager->addSuccess(__('A total of %1 URL(s) were deleted.', $itemsDeleted));
        }catch(Exception $e){
            $this->messageManager->addError($e->getMessage());
        }
        $resultRedirect = $this->resultRedirectFactory->create();
        return $resultRedirect->setPath('prince_forcelogin/forcelogin/index');
    }
}