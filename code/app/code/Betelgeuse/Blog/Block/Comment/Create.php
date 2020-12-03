<?php
namespace Betelgeuse\Blog\Block\Comment;

use Magento\Framework\View\Element\Template;

/**
 * Class Create
 *
 * @package Betelgeuse\Blog\Block\Comment
 */
class Create extends Template {

    /**
     * Get form action URL for POST request
     *
     * @return string
     */
    public
    function getFormAction() {
        $articleId = $articleId = (int)$this->getData('article_id');

        return '/blog/index/createComment?id=' . $articleId;
    }
}
