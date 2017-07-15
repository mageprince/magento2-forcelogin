<?php


namespace Prince\Adminlogs\Helper;

use Magento\Backend\Model\Auth\Session;

/**
 * Class Data
 * @package Prince\Adminlogs\Helper
 */
class Data extends \Magento\Framework\App\Helper\AbstractHelper
{
    /**
     * @var Session
     */
    private $authSession;

    /**
     * Constructor
     *
     * @param \Magento\Framework\App\Helper\Context $context
     * @param Session $authSession
     */
    public function __construct(
        \Magento\Framework\App\Helper\Context $context,
        Session $authSession
    ) {
        $this->authSession = $authSession;
        parent::__construct($context);
    }

    /**
     * Get User
     *
     * @return array
     */
    public function getUser()
    {
        return $this->authSession->getUser();
    }
}
