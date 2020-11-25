<?php
namespace Betelgeuse\Blog\Controller\Index;

use Magento\Framework\App\Action\Action;
use Magento\Framework\App\Action\Context;
use Magento\Framework\App\Action\HttpGetActionInterface;
use Magento\Framework\App\Action\HttpPostActionInterface;
use Magento\Framework\View\Result\PageFactory;

class Index extends Action implements HttpGetActionInterface, HttpPostActionInterface {

    /**
     * @var PageFactory
     */
    private $resultPageFactory;

    /**
     * @var \Betelgeuse\Blog\Model\Article
     */
    private $articleFactory;

    public
    function __construct(Context $context, PageFactory $resultPageFactory, \Betelgeuse\Blog\Model\ArticleFactory $articleFactory) {
        parent::__construct($context);
        $this->resultPageFactory = $resultPageFactory;
        $this->articleFactory = $articleFactory;
    }

    public
    function execute() {
//        $article = $this->articleFactory->create();
//        $article->getCollection()
//            ->addFieldToFilter('author', 'Author2')
//            ->load();

        $result = $this->resultPageFactory->create();
        $result->getConfig()->getTitle()->set('Create Article');

        return $result;

        // die('Betelgeuse / Blog / Controller / Index / Index'); // https://magento2.dev/blog/index/index/?alias=blog or https://magento2.dev/blog or https://magento2.dev/blog/?alias=blog
    }
}
