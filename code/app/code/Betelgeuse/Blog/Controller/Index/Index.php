<?php
namespace Betelgeuse\Blog\Controller\Index;

use Magento\Framework\App\Action\Action;
use Magento\Framework\App\Action\Context;
use Magento\Framework\App\Action\HttpGetActionInterface;
use Magento\Framework\App\Action\HttpPostActionInterface;
use Magento\Framework\View\Result\PageFactory;
use Betelgeuse\Blog\Helper\Data;

/**
 * Class Index
 *
 * @package Betelgeuse\Blog\Controller\Index
 */
class Index extends Action implements HttpGetActionInterface, HttpPostActionInterface {

    /**
     * @var PageFactory
     */
    private $resultPageFactory;

    /**
     * @var Data
     */
    private $helper;

    /**
     * Index constructor.
     *
     * @param Context $context
     * @param PageFactory $resultPageFactory
     * @param Data $helper
     */
    public
    function __construct(Context $context, PageFactory $resultPageFactory, Data $helper) {
        parent::__construct($context);

        $this->resultPageFactory = $resultPageFactory;
        $this->helper = $helper;
    }

    /**
     * {@inheritdoc}
     */
    public
    function execute() { // https://magento2.dev/blog/index/index/ or https://magento2.dev/blog/
        // $urlList = $this->helper->getUrlList();

        $result = $this->resultPageFactory->create();
        $result->getConfig()->getTitle()->set('Index');

        return $result;
    }
}
