<?php


namespace Prince\Forcelogin\Model\Config\Source;

class Condition implements \Magento\Framework\Option\ArrayInterface
{
    /**
     * @return array
     */
    public function toOptionArray()
    {

        return [
            ['value' => 0, 'label' => __('Not Access Entered URL\'s without login')],
            ['value' => 1, 'label' => __('Only Access Entered URL\'s without login')],
        ];
    }
}
