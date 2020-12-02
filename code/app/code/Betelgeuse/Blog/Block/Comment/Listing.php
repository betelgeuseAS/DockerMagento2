<?php
namespace Betelgeuse\Blog\Block\Comment;

use DateTime;
use Magento\Framework\View\Element\Template;
use Betelgeuse\Blog\Model\CommentFactory;

class Listing extends Template {

    /**
     * @var CommentFactory
     */
    private $modelCommentFactory;

    public
    function __construct(Template\Context $context, CommentFactory $modelCommentFactory, array $data = []) {
        parent::__construct($context, $data);

        $this->modelCommentFactory = $modelCommentFactory;
    }

    public
    function getCommentCollection() {
        $articleId = (int)$this->getData('article_id');

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
