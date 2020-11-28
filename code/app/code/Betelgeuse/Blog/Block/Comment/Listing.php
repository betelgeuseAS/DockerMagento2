<?php
namespace Betelgeuse\Blog\Block\Comment;

use DateTime;
use Magento\Framework\App\RequestInterface;
use Magento\Framework\View\Element\Template;
use Betelgeuse\Blog\Model\CommentFactory;

class Listing extends Template {

    /**
     * @var CommentFactory
     */
    private $modelCommentFactory;

    /**
     * @var RequestInterface
     */
    private $request;

    public
    function __construct(Template\Context $context, CommentFactory $modelCommentFactory, RequestInterface $request, array $data = []) {
        parent::__construct($context, $data);

        $this->modelCommentFactory = $modelCommentFactory;
        $this->request = $request;
    }

    public
    function getCommentCollection() {
        $articleId = (int)$this->request->getParam('id');

        return $this->modelCommentFactory
            ->create()
            ->getCollection()
            ->addFieldToFilter('article_id', $articleId);
    }

    public
    function getFormatDate($stringDate) {
        $date = new DateTime($stringDate);

        return $date->format('M d, Y');
    }
}
