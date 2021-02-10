<?php

namespace Zemez\Parallax\Controller\Adminhtml\Block;

use Zemez\Parallax\Controller\Adminhtml\Block;

/**
 * Block index action.
 */
class Index extends Block
{
    /**
     * {@inheritdoc}
     */
    protected function _initAction()
    {
        $resultPage = parent::_initAction();
        $resultPage
            ->setActiveMenu('Zemez_Parallax::parallax_block')
            ->addBreadcrumb(__('Manage Parallax Blocks'), __('Manage Parallax Blocks'))
            ->getConfig()->getTitle()->prepend(__('Blocks'))
        ;

        return $resultPage;
    }

    /**
     * {@inheritdoc}
     */
    public function execute()
    {
        $resultPage = $this->_initAction();

        return $resultPage;
    }
}
