<?php

namespace Zemez\SocialLogin\Model\Checkout;

use Magento\Checkout\Model\ConfigProviderInterface;
use Magento\Framework\UrlInterface;
use Magento\Framework\Data\Helper\PostHelper as PostDataHelper;
use Zemez\SocialLogin\Helper\Data as SocialLoginHelper;
use Zemez\SocialLogin\Model\ResourceModel\Provider\Collection as ProviderCollection;
use Zemez\SocialLogin\Model\ProviderInterface;

class ConfigProvider implements ConfigProviderInterface
{
    /**
     * @var SocialLoginHelper
     */
    protected $_helper;

    /**
     * @var ProviderCollection
     */
    protected $_providerCollection;

    /**
     * @var PostDataHelper
     */
    protected $_postDataHelper;

    /**
     * @var UrlInterface
     */
    protected $_urlBuilder;

    /**
     * ConfigProvider constructor.
     *
     * @param SocialLoginHelper  $socialLoginHelper
     * @param ProviderCollection $providerCollection
     * @param PostDataHelper     $postDataHelper
     * @param UrlInterface       $urlBuilder
     */
    public function __construct(
        SocialLoginHelper $socialLoginHelper,
        ProviderCollection $providerCollection,
        PostDataHelper $postDataHelper,
        UrlInterface $urlBuilder
    )
    {
        $this->_helper = $socialLoginHelper;
        $this->_providerCollection = $providerCollection;
        $this->_postDataHelper = $postDataHelper;
        $this->_urlBuilder = $urlBuilder;
    }

    /**
     * {@inheritdoc}
     */
    public function getConfig()
    {
        $config = [
            'socialLogin' => [
                'isEnabled' => $this->_helper->isEnabled(),
                'providers' => $this->_getProviders()
            ]
        ];

        return $config;
    }

    /**
     * Get providers.
     *
     * @return array
     */
    protected function _getProviders()
    {
        $providers = [];
        /** @var \Zemez\SocialLogin\Model\Provider $provider */
        foreach ($this->_providerCollection as $provider) {
            $providers[] = [
                'code'     => $this->getProviderCode($provider),
                'label'    => $this->getProviderLabel($provider),
                'dataPost' => $this->getDataPost($provider)
            ];
        }

        return $providers;
    }
    /**
     * Get provider cod for font icon.
     *
     * @param ProviderInterface $provider
     *
     * @return string
     */
    public function getProviderCode(ProviderInterface $provider)
    {
        return $this->_helper->getProviderCode($provider);
    }

    /**
     * Get provider label.
     *
     * @param ProviderInterface $provider
     *
     * @return string
     */
    public function getProviderLabel(ProviderInterface $provider)
    {
        return $this->_helper->getProviderLabel($provider);
    }

    /**
     * @param ProviderInterface $provider
     *
     * @return string
     */
    protected function getDataPost(ProviderInterface $provider)
    {
        return $this->_postDataHelper->getPostData(
            $this->_urlBuilder->getUrl('social/login/grant'),
            [
                'provider' => $provider->getCode(),
            ]
        );
    }
}
