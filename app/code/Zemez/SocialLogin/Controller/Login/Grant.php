<?php

namespace Zemez\SocialLogin\Controller\Login;

use Zemez\SocialLogin\Model\Exception;
use Zemez\SocialLogin\Controller\Login;

/**
 * Grant login action.
 */
class Grant extends Login
{
    /**
     * @return \Magento\Framework\Controller\Result\Redirect
     */
    public function execute()
    {
        $code = $this->getRequest()->getParam('provider');

        $redirect = $this->resultRedirectFactory->create();
        try {
            $provider = $this->_collection->getItemById($code);
            $redirect->setPath($provider->getAuthorizationUrl());
        } catch (Exception $e) {
            $this->messageManager->addError($e->getMessage());
            $redirect->setRefererOrBaseUrl();
        }

        return $redirect;
    }
}
