<?php
namespace Betelgeuse\Blog\Block\Article;

use DateTime;
use Magento\Framework\App\RequestInterface;
use Magento\Framework\View\Element\Template;
use Betelgeuse\Blog\Model\ArticleFactory;

class View extends Template {

    /**
     * @var ArticleFactory
     */
    private $modelArticleFactory;

    /**
     * @var RequestInterface
     */
    private $request;

    public
    function __construct(Template\Context $context, ArticleFactory $modelArticleFactory, RequestInterface $request, array $data = []) {
        parent::__construct($context, $data);

        $this->modelArticleFactory = $modelArticleFactory;
        $this->request = $request;
    }

    public
    function getArticle() {
        $articleId = (int)$this->request->getParam('id');

        return $this->modelArticleFactory->create()->load($articleId);
    }

    public
    function getFormatDate($stringDate) {
        $date = new DateTime($stringDate);

        return $date->format('M d, Y H:m:s');
    }
}
