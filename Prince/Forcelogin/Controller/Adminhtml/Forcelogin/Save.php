<?php


namespace Prince\Forcelogin\Controller\Adminhtml\Forcelogin;

use Magento\Framework\Exception\LocalizedException;

class Save extends \Magento\Backend\App\Action
{

    /**
     * @var \Magento\Framework\App\Request\DataPersistorInterface
     */
    private $dataPersistor;

    /**
     * @var \Prince\Forcelogin\Model\Forcelogin
     */
    private $forceLoginModel;

    /**
     * @param \Magento\Backend\App\Action\Context $context
     * @param \Magento\Framework\App\Request\DataPersistorInterface $dataPersistor
     */
    public function __construct(
        \Magento\Backend\App\Action\Context $context,
        \Magento\Framework\App\Request\DataPersistorInterface $dataPersistor,
        \Prince\Forcelogin\Model\Forcelogin $forceLoginModel
    ) {
        $this->dataPersistor = $dataPersistor;
        $this->forceLoginModel = $forceLoginModel;
        parent::__construct($context);
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
        $cGroup = $data['customer_group'];
        if (isset($cGroup)) {
            $customerGroup = implode(',', $data['customer_group']);
            $data['customer_group'] = $customerGroup;
        }
        $stores = $data['storeview'];
        if (isset($stores)) {
            $store = implode(',', $data['storeview']);
            $data['storeview'] = $store;
        }
        $dUrl = $data['url'];
        if (isset($dUrl)) {
            $url = ltrim($data['url'], '/');
            $finalUrl = rtrim($url, '/');
            $data['url'] = $finalUrl;
        }
        if ($data) {
            $id = $this->getRequest()->getParam('forcelogin_id');
            $model = $this->forceLoginModel->load($id);

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
            return $resultRedirect->setPath(
                '*/*/edit',
                [
                    'forcelogin_id' => $this->getRequest()->getParam('forcelogin_id')
                ]
            );
        }
        return $resultRedirect->setPath('*/*/');
    }
}
