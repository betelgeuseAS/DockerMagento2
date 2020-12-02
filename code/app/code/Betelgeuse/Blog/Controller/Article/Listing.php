<?php
namespace Betelgeuse\Blog\Controller\Article;

use Magento\Framework\App\Action\Action;
use Magento\Framework\App\Action\Context;
use Magento\Framework\App\Action\HttpGetActionInterface;
use Magento\Framework\App\Action\HttpPostActionInterface;
use Magento\Framework\View\Result\PageFactory;

class Listing extends Action implements HttpGetActionInterface, HttpPostActionInterface {

    /**
     * @var PageFactory
     */
    private $resultPageFactory;

    public
    function __construct(Context $context, PageFactory $resultPageFactory) {
        parent::__construct($context);

        $this->resultPageFactory = $resultPageFactory;
    }

    public
    function execute() { // https://magento2.dev/blog/article/listing
        $result = $this->resultPageFactory->create();
        $result->getConfig()->getTitle()->set('List of Articles');

        return $result;
    }
}
