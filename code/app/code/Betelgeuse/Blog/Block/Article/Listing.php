<?php
namespace Betelgeuse\Blog\Block\Article;

use Exception;
use DateTime;
use Magento\Framework\View\Element\Template;
use Betelgeuse\Blog\Model\ArticleFactory;
use Magento\Framework\Data\Collection\AbstractDb;
use Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection;

/**
 * Class Listing
 *
 * @package Betelgeuse\Blog\Block\Article
 */
class Listing extends Template {

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
     * @return AbstractDb|AbstractCollection|null
     */
    public
    function getArticleCollection() {
        return $this->modelArticleFactory
            ->create()
            ->getCollection()
            ->addFieldToFilter('enabled', true);
//            ->load();
    }

    /**
     * @param $stringDate
     * @return string
     * @throws Exception
     */
    public
    function getFormatDate($stringDate) {
        $date = new DateTime($stringDate);

        return $date->format('M d, Y');
    }
}
