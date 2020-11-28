<?php
namespace Betelgeuse\Blog\Controller\Index;

use Magento\Framework\App\Action\Action;
use Magento\Framework\App\Action\Context;
use Magento\Framework\App\Action\HttpGetActionInterface;
use Magento\Framework\App\Action\HttpPostActionInterface;
use Magento\Framework\App\RequestInterface;
use Magento\Framework\View\Result\PageFactory;
use Betelgeuse\Blog\Model\ArticleFactory;
use Betelgeuse\Blog\Model\Article;

class CreateComment extends Action implements HttpGetActionInterface, HttpPostActionInterface {

    /**
     * @var PageFactory
     */
    private $resultPageFactory;

    /**
     * @var Article
     */
    private $articleFactory;

    /**
     * @var RequestInterface
     */
    private $request;

    public
    function __construct(Context $context, PageFactory $resultPageFactory, ArticleFactory $articleFactory, RequestInterface $request) {
        parent::__construct($context);

        $this->resultPageFactory = $resultPageFactory;
        $this->articleFactory = $articleFactory;
        $this->request = $request;
    }

    public
    function execute() {
        $post = $this->getRequest()->getPostValue();
        $articleId = (int)$this->request->getParam('id');

        if (!$post) {
            $this->_redirect('blog/article/listing');
            return;
        }

        $model = $this->_objectManager->create(\Betelgeuse\Blog\Model\Comment::class);
        $model->setArticleId($articleId);
        $model->setAuthor($post['author']);
        $model->setMessage($post['message']);
        $model->save();

        $this->_redirect('blog/article/view?id=' . $articleId);
    }
}
