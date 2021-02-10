<?php

/**
 * Copyright © 2015 Zemez. All rights reserved.
 * See COPYING.txt for license details.
 */
namespace Zemez\QuickView\Plugin\ProductList;

use Zemez\QuickView\Helper\Data;

class Toolbar
{
    /**
     * @var HelperData
     */
    protected $_helper;

    public function __construct(Data $helper)
    {
        $this->_helper = $helper;
    }

    /**
     * Add custom options for ToolBar widget.
     *
     * @param \Magento\Catalog\Block\Product\ProductList\Toolbar $subject
     * @param $result
     *
     * @return mixed
     */
    public function afterGetWidgetOptionsJson(\Magento\Catalog\Block\Product\ProductList\Toolbar $subject, $result)
    {

        $addResult['buttonText'] = $this->_helper->getButtonText();
        $addResult['buttonCssClass'] = $this->_helper->getButtonCssClass();

        if (!$addResult) {
            return $result;
        }

        $options = json_decode($result, true);

        if (!array_key_exists('productListToolbarForm', $options)) {
            return $result;
        }

        $productListToolbarForm = $options['productListToolbarForm'];
        $productListToolbarForm['quickView'] = $addResult;

        return json_encode(['productListToolbarForm' => $productListToolbarForm]);

    }
}
