<?php

namespace Prince\Adminlogs\Ui\Component\Listing\Column;

use Magento\Framework\Escaper;
use Magento\Framework\View\Element\UiComponent\ContextInterface;
use Magento\Framework\View\Element\UiComponentFactory;
use Magento\Ui\Component\Listing\Columns\Column;

/**
 * Shows status message in admin grids instead of boolean value
 */
class Status extends Column
{
    /**
     * Escaper
     *
     * @var \Magento\Framework\Escaper
     */
    private $escaper;

    /**
     * System store
     *
     * @var SystemStore
     */
    private $systemStore;

    /**
     * @var \Magento\Catalog\Model\ProductFactory
     */
    private $productFactory;

    /**
     * Constructor
     *
     * @param ContextInterface $context
     * @param UiComponentFactory $uiComponentFactory
     * @param SystemStore $systemStore
     * @param Escaper $escaper
     * @param array $components
     * @param array $data
     */
    public function __construct(
        ContextInterface $context,
        UiComponentFactory $uiComponentFactory,
        Escaper $escaper,
        \Magento\Catalog\Model\ProductFactory $productFactory,
        array $components = [],
        array $data = []
    ) {
        $this->productFactory = $productFactory;
        $this->escaper = $escaper;
        parent::__construct($context, $uiComponentFactory, $components, $data);
    }

    /**
     * Prepare Data Source
     *
     * @param array $dataSource
     * @return array
     */
    public function prepareDataSource(array $dataSource)
    {
        if (isset($dataSource['data']['items'])){
            foreach ($dataSource['data']['items'] as & $item) {
                if ($item['status']) {
                    $item['status'] = "Success";
                } else {
                    $item['status'] = "Fail";
                }
            }
        }
        return $dataSource;
    }
}
