<?php
namespace Betelgeuse\Blog\Helper;

use Betelgeuse\Blog\Model\ArticleFactory;
use \Magento\Framework\App\Helper\AbstractHelper;
use Magento\Framework\App\Helper\Context;

/**
 * Class Data
 *
 * @package Betelgeuse\Blog\Helper
 */
class Data extends AbstractHelper {

    /**
     * @var ArticleFactory
     */
    private $modelArticleFactory;

    /**
     * Data constructor.
     *
     * @param Context $context
     * @param ArticleFactory $modelArticleFactory
     */
    public
    function __construct(Context $context, ArticleFactory $modelArticleFactory) {
        parent::__construct($context);

        $this->modelArticleFactory = $modelArticleFactory;
    }

    /**
     * @return array
     */
    public
    function getUrlList() {
        $urlList = [];
        $articles = $this->modelArticleFactory
            ->create()
            ->getCollection()
            ->addFieldToFilter('url', ['neq' => 'NULL'])
            ->addFieldToSelect(['url','entity_id']);

        foreach ($articles as $article) {
            $urlList[$article->getUrl()] = $article->getEntityId();
        }

        return $urlList;
    }
}
