<?php
namespace Betelgeuse\Blog\Block\Article;

use Exception;
use DateTime;
use Magento\Framework\View\Element\Template;
use Betelgeuse\Blog\Model\ArticleFactory;
use Betelgeuse\Blog\Model\Article;

/**
 * Class View
 *
 * @package Betelgeuse\Blog\Block\Article
 */
class View extends Template {

    /**
     * @var ArticleFactory
     */
    private $modelArticleFactory;

    /**
     * @param Template\Context $context
     * @param ArticleFactory $modelArticleFactory
     * @param array $data
     */
    public
    function __construct(Template\Context $context, ArticleFactory $modelArticleFactory, array $data = []) {
        parent::__construct($context, $data);

        $this->modelArticleFactory = $modelArticleFactory;
    }

    /**
     * @return Article
     */
    public
    function getArticle() {
        $articleId = (int)$this->getData('article_id');

        return $this->modelArticleFactory->create()->load($articleId);
    }

    /**
     * @param $stringDate
     * @return string
     * @throws Exception
     */
    public
    function getFormatDate($stringDate) {
        $date = new DateTime($stringDate);

        return $date->format('M d, Y H:m:s');
    }
}
