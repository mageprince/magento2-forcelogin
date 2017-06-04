<?php


namespace Prince\Forcelogin\Controller\Adminhtml\Forcelogin;

class Delete extends \Prince\Forcelogin\Controller\Adminhtml\Forcelogin
{

    /**
     * Delete action
     *
     * @return \Magento\Framework\Controller\ResultInterface
     */
    public function execute()
    {
        /** @var \Magento\Backend\Model\View\Result\Redirect $resultRedirect */
        $resultRedirect = $this->resultRedirectFactory->create();
        // check if we know what should be deleted
        $id = $this->getRequest()->getParam('forcelogin_id');
        if ($id) {
            try {
                // init model and delete
                $model = $this->_objectManager->create('Prince\Forcelogin\Model\Forcelogin');
                $model->load($id);
                $model->delete();
                // display success message
                $this->messageManager->addSuccess(__('You deleted the URL.'));
                // go to grid
                return $resultRedirect->setPath('*/*/');
            } catch (\Exception $e) {
                // display error message
                $this->messageManager->addError($e->getMessage());
                // go back to edit form
                return $resultRedirect->setPath('*/*/edit', ['forcelogin_id' => $id]);
            }
        }
        // display error message
        $this->messageManager->addError(__('We can\'t find a URL to delete.'));
        // go to grid
        return $resultRedirect->setPath('*/*/');
    }
}
