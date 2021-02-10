<?php

namespace Zemez\SocialLogin\Plugin\Checkout\Block\Cart;

use Magento\Checkout\Block\Cart\Sidebar as CartSidebar;
use Zemez\SocialLogin\Model\Checkout\ConfigProvider;

/**
 * Class Sidebar
 *
 * @package Zemez\SocialLogin\Plugin\Checkout\Block\Cart
 */
class Sidebar
{
    /**
     * @var ConfigProvider
     */
    protected $_configProvider;

    /**
     * Sidebar constructor.
     *
     * @param ConfigProvider $configProvider
     */
    public function __construct(ConfigProvider $configProvider)
    {
        $this->_configProvider = $configProvider;
    }

    /**
     * @param CartSidebar $subject
     * @param array $result
     * @return array
     *
     * @SuppressWarnings(PHPMD.UnusedFormalParameter)
     */
    function afterGetConfig(CartSidebar $subject, array $result)
    {
        return array_merge_recursive($result, $this->_configProvider->getConfig());
    }
}
