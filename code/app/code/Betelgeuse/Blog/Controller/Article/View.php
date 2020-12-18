<?php
namespace Betelgeuse\Blog\Controller\Article;

use Magento\Framework\App\Action\Action;
use Magento\Framework\App\Action\HttpGetActionInterface;
use Magento\Framework\App\Action\HttpPostActionInterface;
use Magento\Framework\Controller\ResultFactory;
use Magento\Framework\View\Element\Template;
use Magento\Framework\View\Result\Page;

/**
 * Class View
 *
 * @package Betelgeuse\Blog\Controller\Article
 */
class View extends Action implements HttpGetActionInterface, HttpPostActionInterface {

    /**
     * {@inheritdoc}
     */
    public
    function execute() { // https://magento2.dev/blog/article/view?id=1
        /** @var Page $page */
        $page = $this->resultFactory->create(ResultFactory::TYPE_PAGE);
        $page->getConfig()->getTitle()->set('View Article');

        $articleId = (int)$this->getRequest()->getParam('id');

        /** @var Template $blockArticleView */
        $blockArticleView = $page->getLayout()->getBlock('blog.article.view');
        $blockArticleView->setData('article_id', $articleId);

        /** @var Template $blockArticleCommentListing */
        $blockArticleCommentListing = $page->getLayout()->getBlock('blog.article.comment.listing');
        $blockArticleCommentListing->setData('article_id', $articleId);

        /** @var Template $blockArticleCommentCreate */
        $blockArticleCommentCreate = $page->getLayout()->getBlock('blog.article.comment.create');
        $blockArticleCommentCreate->setData('article_id', $articleId);

        // Use Plugin
        $result = $this->plugin(1, 2,3);

        // Use Event
        $this->_eventManager->dispatch('view_article_after', ['action' => $this, 'page' => $page]);

        return $page;
    }

    public function plugin($a, $b, $c) {
        return $a + $b + $c;
    }
}
