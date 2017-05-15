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
            ['value' => 0, 'label' => __('Enterd URL\'s not allowed without login')],
            ['value' => 1, 'label' => __('Entered URL\'s Allowed without login')],
        ];
    }

}
