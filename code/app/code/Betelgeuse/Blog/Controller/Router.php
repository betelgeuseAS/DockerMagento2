<?php
namespace Betelgeuse\Blog\Controller;

use Betelgeuse\Blog\Helper\Data;
use Magento\Framework\App\RequestInterface;
use Magento\Framework\App\Action\Forward;
use Magento\Framework\App\ActionInterface;
use Magento\Framework\App\ActionFactory;
use Magento\Framework\App\RouterInterface;

/**
 * Class Router
 *
 * @package Betelgeuse\Blog\Controller
 */
class Router implements RouterInterface {

    /**
     * @var ActionFactory
     */
    protected $actionFactory;

    /**
     * @var Data
     */
    private $helper;

    /**
     * @param ActionFactory $actionFactory
     * @param Data $helper
     */
    public function __construct(ActionFactory $actionFactory, Data $helper) {
        $this->actionFactory = $actionFactory;
        $this->helper = $helper;
    }

    /**
     * @param RequestInterface $request
     * @return ActionInterface|null
     */
    public
    function match(RequestInterface $request) {
        // code/vendor/magento/module-cms/etc/frontend/di.xml
        // code/vendor/magento/module-cms/Controller/Router.php

        $identifier = trim($request->getPathInfo(), '/');
        $parts = explode('/', $identifier);

        if ((count($parts) != 2) || ($parts[0] != 'blog')) {
            return null;
        }

        $urlList = $this->helper->getUrlList();
        $id = $urlList[$parts[1]];

        $request->setModuleName('blog')->setControllerName('article')->setActionName('view')->setParam('id', $id);

        return $this->actionFactory->create(Forward::class);
    }
}
