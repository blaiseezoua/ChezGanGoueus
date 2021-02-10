<?php

namespace Zemez\Parallax\Controller\Adminhtml\BlockItem;

use Zemez\Parallax\Controller\Adminhtml\BlockItem;
use Magento\Framework\Controller\ResultFactory;

/**
 * Class NewAction.
 */
class NewAction extends BlockItem
{
    /**
     * {@inheritdoc}
     */
    public function execute()
    {
        /** @var \Magento\Backend\Model\View\Result\Forward $resultPage */
        $resultPage = $this->resultFactory->create(ResultFactory::TYPE_FORWARD);
        $resultPage->forward('edit');

        return $resultPage;
    }
}
