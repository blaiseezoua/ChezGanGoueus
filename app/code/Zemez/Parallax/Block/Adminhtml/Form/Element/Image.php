<?php

namespace Zemez\Parallax\Block\Adminhtml\Form\Element;

use Zemez\Parallax\Helper\Data as ParallaxHelper;
use Magento\Framework\Data\Form\Element\Image as CoreImage;

/**
 * Image form type.
 *
 * @package Zemez\Parallax\Block\Adminhtml\Form\Element
 */
class Image extends CoreImage
{
    /**
     * @inheritdoc
     */
    protected function _getUrl()
    {
        return sprintf('%s/%s', ParallaxHelper::IMAGE_DIR, parent::_getUrl());
    }
}