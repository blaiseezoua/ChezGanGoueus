<?php

namespace Zemez\Parallax\Controller\Adminhtml\Block;

use Zemez\Parallax\Api\Data\BlockInterface;

/**
 * Block disable mass action.
 *
 * @package Zemez\Parallax\Controller\Adminhtml\Block
 */
class MassEnable extends MassStatus
{
    /**
     * Parallax block status.
     *
     * @var int
     */
    protected $_status = BlockInterface::STATUS_ENABLED;

    /**
     * Action success message.
     *
     * @var string
     */
    protected $_successMessage = 'A total of %1 record(s) have been enabled.';
}
