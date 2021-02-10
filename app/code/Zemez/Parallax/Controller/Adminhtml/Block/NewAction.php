<?php

namespace Zemez\Parallax\Controller\Adminhtml\Block;

use Zemez\Parallax\Controller\Adminhtml\Block;
use Magento\Framework\Controller\ResultFactory;

/**
 * New block action.
 */
class NewAction extends Block
{
    /**
     * {@inheritdoc}
     */
    public function execute()
    {
        $this->_forward('edit');
    }
}
