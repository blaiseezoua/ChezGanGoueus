<?php

namespace Zemez\Parallax\Controller\Adminhtml\BlockItem;

use Magento\Framework\Exception\CouldNotDeleteException;
use Magento\Framework\Exception\LocalizedException;
use Zemez\Parallax\Api\BlockItemRepositoryInterface;
use Zemez\Parallax\Controller\Adminhtml\BlockItem;
use Magento\Backend\App\Action;
use Magento\Framework\Exception\NoSuchEntityException;
use Magento\Framework\Registry;
use Magento\Framework\Controller\ResultFactory;

/**
 * Block item delete action.
 */
class Delete extends BlockItem
{
    /**
     * @var BlockItemRepositoryInterface
     */
    protected $_blockItemRepository;

    /**
     * @var Registry
     */
    protected $_coreRegistry;

    /**
     * Delete constructor.
     *
     * @param BlockItemRepositoryInterface $blockRepository
     * @param Registry                     $registry
     * @param Action\Context               $context
     */
    public function __construct(
        BlockItemRepositoryInterface $blockRepository,
        Registry $registry,
        Action\Context $context
    ) {
        $this->_blockItemRepository = $blockRepository;
        $this->_coreRegistry = $registry;
        parent::__construct($context);
    }

    /**
     * {@inheritdoc}
     */
    public function execute()
    {
        $id = $this->getRequest()->getParam('item_id');

        try {
            $this->_blockItemRepository->deleteById($id);
            $this->messageManager->addSuccessMessage(
                __('Block item has been successfully deleted.')
            );
        } catch (LocalizedException $e) {
            $this->messageManager->addErrorMessage($e->getMessage());
        } catch (\Exception $e) {
            $this->messageManager->addErrorMessage(
                __('There is an unknown error occurred while deleting the item.')
            );
        }

        /** @var \Magento\Framework\Controller\Result\Redirect$result */
        $result = $this->resultFactory->create(ResultFactory::TYPE_REDIRECT);
        $result->setPath('*/block/edit', [
            'block_id' => $this->getRequest()->getParam('block_id')
        ]);

        return $result;
    }

    /**
     * @inheritdoc
     */
    protected function _isAllowed()
    {
        return $this->_authorization->isAllowed('Zemez_Parallax::item_delete');
    }


}
