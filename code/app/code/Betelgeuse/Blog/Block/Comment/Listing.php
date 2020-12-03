<?php
namespace Betelgeuse\Blog\Block\Comment;

use Exception;
use DateTime;
use Magento\Framework\View\Element\Template;
use Betelgeuse\Blog\Model\CommentFactory;
use Magento\Framework\Data\Collection\AbstractDb;
use Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection;

/**
 * Class Listing
 *
 * @package Betelgeuse\Blog\Block\Comment
 */
class Listing extends Template {

    /**
     * @var CommentFactory
     */
    private $modelCommentFactory;

    /**
     * @param Template\Context $context
     * @param CommentFactory $modelCommentFactory
     * @param array $data
     */
    public
    function __construct(Template\Context $context, CommentFactory $modelCommentFactory, array $data = []) {
        parent::__construct($context, $data);

        $this->modelCommentFactory = $modelCommentFactory;
    }

    /**
     * @return AbstractDb|AbstractCollection|null
     */
    public
    function getCommentCollection() {
        $articleId = (int)$this->getData('article_id');

        return $this->modelCommentFactory
            ->create()
            ->getCollection()
            ->addFieldToFilter('article_id', $articleId);
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
