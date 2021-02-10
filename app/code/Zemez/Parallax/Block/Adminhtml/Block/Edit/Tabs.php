<?php

namespace Zemez\Parallax\Block\Adminhtml\Block\Edit;

use Magento\Backend\Block\Widget\Tabs as BaseTabs;

/**
 * Tabs
 *
 * @package Zemez\Parallax\Block\Adminhtml\Block\Edit
 */
class Tabs extends BaseTabs
{
    /**
     * @inheritdoc
     */
    protected function _construct()
    {
        parent::_construct();
        $this->setId('parallax_block_tabs');
        $this->setDestElementId('edit_form');
        $this->setTitle('Parallax blocks');
    }
}
