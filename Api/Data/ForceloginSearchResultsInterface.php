<?php


namespace Prince\Forcelogin\Api\Data;

interface ForceloginSearchResultsInterface extends \Magento\Framework\Api\SearchResultsInterface
{
    /**
     * Get forcelogin list.
     * @return \Prince\Forcelogin\Api\Data\ForceloginInterface[]
     */
    
    public function getItems();

    /**
     * Set name list.
     * @param \Prince\Forcelogin\Api\Data\ForceloginInterface[] $items
     * @return $this
     */
    
    public function setItems(array $items);
}
