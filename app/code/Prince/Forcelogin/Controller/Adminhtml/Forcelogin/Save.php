<?php


namespace Prince\Forcelogin\Controller\Adminhtml\Forcelogin;

use Magento\Framework\Exception\LocalizedException;

class Save extends \Magento\Backend\App\Action
{

    protected $dataPersistor;

    /**
     * @param \Magento\Backend\App\Action\Context $context
     * @param \Magento\Framework\Registry $coreRegistry
     * @param \Magento\Framework\App\Request\DataPersistorInterface $dataPersistor
     */
    public function __construct(
        \Magento\Backend\App\Action\Context $context,
        \Magento\Framework\Registry $coreRegistry,
        \Magento\Framework\App\Request\DataPersistorInterface $dataPersistor
    ) {
        $this->dataPersistor = $dataPersistor;
        parent::__construct($context, $coreRegistry);
    }

    /**
     * Save action
     *
     * @return \Magento\Framework\Controller\ResultInterface
     */
    public function execute()
    {
        /** @var \Magento\Backend\Model\View\Result\Redirect $resultRedirect */
        $resultRedirect = $this->resultRedirectFactory->create();
        $data = $this->getRequest()->getPostValue();

        if(isset($data['customer_group']))
        {
            $customerGroup = implode(',', $data['customer_group']);
            $data['customer_group'] = $customerGroup;
        }

        if(isset($data['storeview']))
        {
            $store = implode(',', $data['storeview']);
            $data['storeview'] = $store;
        }

        if(isset($data['url']))
        {
            $url = ltrim($data['url'], '/');
            $finalUrl = rtrim($url, '/');
            $data['url'] = $finalUrl;
        }
        
        if ($data) {
            $id = $this->getRequest()->getParam('forcelogin_id');
        
            $model = $this->_objectManager->create('Prince\Forcelogin\Model\Forcelogin')->load($id);
            if (!$model->getId() && $id) {
                $this->messageManager->addError(__('This URL no longer exists.'));
                return $resultRedirect->setPath('*/*/');
            }
        
            $model->setData($data);
        
            try {
                $model->save();
                $this->messageManager->addSuccess(__('You saved the URL.'));
                $this->dataPersistor->clear('prince_forcelogin_forcelogin');
        
                if ($this->getRequest()->getParam('back')) {
                    return $resultRedirect->setPath('*/*/edit', ['forcelogin_id' => $model->getId()]);
                }
                return $resultRedirect->setPath('*/*/');
            } catch (LocalizedException $e) {
                $this->messageManager->addError($e->getMessage());
            } catch (\Exception $e) {
                $this->messageManager->addException($e, __('Something went wrong while saving the URL.'));
            }
        
            $this->dataPersistor->set('prince_forcelogin_forcelogin', $data);
            return $resultRedirect->setPath('*/*/edit', ['forcelogin_id' => $this->getRequest()->getParam('forcelogin_id')]);
        }
        return $resultRedirect->setPath('*/*/');
    }
}
