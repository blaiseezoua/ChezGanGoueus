<?php

namespace Zemez\Parallax\Controller\Adminhtml\Block;

use Zemez\Parallax\Api\Data\BlockInterface;
use Zemez\Parallax\Api\BlockRepositoryInterface;
use Zemez\Parallax\Controller\Adminhtml\Block;
use Magento\Framework\Controller\ResultFactory;
use Magento\Backend\App\Action\Context;

/**
 * Block inline edit controller.
 *
 * @package Zemez\Parallax\Controller\Adminhtml\Block
 */
class InlineEdit extends Block
{
    /** @var BlockRepositoryInterface */
    protected $blockRepository;

    /**
     * InlineEdit constructor.
     *
     * @param BlockRepositoryInterface $blockRepository
     * @param Context                  $context
     */
    public function __construct(
        BlockRepositoryInterface $blockRepository,
        Context $context
    ) {
        $this->blockRepository = $blockRepository;
        parent::__construct($context);
    }

    /**
     * @inheritdoc
     */
    public function execute()
    {
        /** @var \Magento\Framework\Controller\Result\Json $result */
        $result = $this->resultFactory->create(ResultFactory::TYPE_JSON);
        $error = false;
        $messages = [];

        if ($this->getRequest()->isAjax()) {
            $postItems = $this->getRequest()->getParam('items', []);
            if (!count($postItems)) {
                $messages[] = __('Please correct the data sent.');
                $error = true;
            } else {
                foreach (array_keys($postItems) as $blockId) {
                    /** @var \Zemez\Parallax\Model\Block $block */
                    $block = $this->blockRepository->getById($blockId);
                    try {
                        $block->setData(array_merge($block->getData(), $postItems[$blockId]));
                        $this->blockRepository->save($block);
                    } catch (\Exception $e) {
                        $messages[] = $this->_getErrorWithBlockId(
                            $block,
                            __($e->getMessage())
                        );
                        $error = true;
                    }
                }
            }
        }

        return $result->setData([
            'messages' => $messages,
            'error' => $error
        ]);
    }

    /**
     * Add block title to error message.
     *
     * @param BlockInterface $block
     * @param string         $errorText
     *
     * @return string
     */
    protected function _getErrorWithBlockId(BlockInterface $block, $errorText)
    {
        return '[Block ID: ' . $block->getId() . '] ' . $errorText;
    }

    /**
     * @inheritdoc
     */
    protected function _isAllowed()
    {
        return $this->_authorization->isAllowed('Zemez_Parallax::block_save');
    }
}
