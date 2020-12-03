<?php
namespace Betelgeuse\Blog\Controller\Index;

use Magento\Framework\App\Action\Action;
use Magento\Framework\App\Action\Context;
use Magento\Framework\App\Action\HttpGetActionInterface;
use Magento\Framework\App\Action\HttpPostActionInterface;
use Magento\Framework\View\Result\PageFactory;
use Betelgeuse\Blog\Model\ArticleFactory;
use Betelgeuse\Blog\Model\Article;
use Betelgeuse\Blog\Model\Comment;

/**
 * Class CreateComment
 *
 * @package Betelgeuse\Blog\Controller\Index
 */
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
     * @param Context $context
     * @param PageFactory $resultPageFactory
     * @param ArticleFactory $articleFactory
     */
    public
    function __construct(Context $context, PageFactory $resultPageFactory, ArticleFactory $articleFactory) {
        parent::__construct($context);

        $this->resultPageFactory = $resultPageFactory;
        $this->articleFactory = $articleFactory;
    }

    /**
     * {@inheritdoc}
     */
    public
    function execute() {
        $post = $this->getRequest()->getPostValue();
        $articleId = (int)$this->getRequest()->getParam('id');

        if (!$post) {
            $this->_redirect('blog/article/listing');
            return;
        }

        $model = $this->_objectManager->create(Comment::class);
        $model->setArticleId($articleId);
        $model->setAuthor($post['author']);
        $model->setMessage($post['message']);
        $model->save();

        $this->_redirect('blog/article/view?id=' . $articleId);
    }
}
