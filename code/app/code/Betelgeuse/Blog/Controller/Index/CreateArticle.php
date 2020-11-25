<?php
namespace Betelgeuse\Blog\Controller\Index;

use Magento\Framework\App\Action\Action;
use Magento\Framework\App\Action\Context;
use Magento\Framework\App\Action\HttpGetActionInterface;
use Magento\Framework\App\Action\HttpPostActionInterface;
use Magento\Framework\View\Result\PageFactory;

class CreateArticle extends Action implements HttpGetActionInterface, HttpPostActionInterface {

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
        $post = $this->getRequest()->getPostValue();
//        $post = (array) $this->getRequest()->getPost();
        if (!$post) {
            $this->_redirect('blog/*/');
            return;
        }

//        $article = $this->articleFactory->create();
//        $article->setData($post);
        $model = $this->_objectManager->create(\Betelgeuse\Blog\Model\Article::class);
        $model->setAuthor($post['author']);
        $model->setTitle($post['title']);
        $model->setDescription($post['description']);
        if (isset($post['content']))
            $model->setContent($post['content']);
        if (isset($post['status']))
            $model->setStatus($post['status']);
        if (isset($post['enabled']))
            $model->setEnabled($post['enabled']);
        $model->save();

//        if (!\Zend_Validate::is(trim($post['author']), 'NotEmpty')) {
//            $error = true;
//        }

        $this->_redirect('blog/*/');
    }
}
