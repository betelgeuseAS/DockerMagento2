<?php
namespace Betelgeuse\Blog\Block\Article;

use DateTime;
use Magento\Framework\View\Element\Template;
use Betelgeuse\Blog\Model\ArticleFactory;

class View extends Template {

    /**
     * @var ArticleFactory
     */
    private $modelArticleFactory;

    public
    function __construct(Template\Context $context, ArticleFactory $modelArticleFactory, array $data = []) {
        parent::__construct($context, $data);

        $this->modelArticleFactory = $modelArticleFactory;
    }

    public
    function getArticle() {
        $articleId = (int)$this->getData('article_id');

        return $this->modelArticleFactory->create()->load($articleId);
    }

    public
    function getFormatDate($stringDate) {
        $date = new DateTime($stringDate);

        return $date->format('M d, Y H:m:s');
    }
}
