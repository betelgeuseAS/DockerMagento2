<?php
namespace Betelgeuse\Blog\Block\Article;

use DateTime;
use Magento\Framework\View\Element\Template;
use Betelgeuse\Blog\Model\ArticleFactory;

class Listing extends Template {

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
    function getArticleCollection() {
//        $article = $this->articleFactory->create();
//        $article->getCollection()
//            ->addFieldToFilter('author', 'Author2')
//            ->load();

        return $this->modelArticleFactory->create()->getCollection();
    }

    public
    function getFormatDate($stringDate) {
        $date = new DateTime($stringDate);

        return $date->format('M d, Y');
    }
}
