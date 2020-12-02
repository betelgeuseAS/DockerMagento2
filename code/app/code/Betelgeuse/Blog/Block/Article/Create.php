<?php
namespace Betelgeuse\Blog\Block\Article;

use Magento\Framework\View\Element\Template;

class Create extends Template {

    /**
     * Get form action URL for POST request
     *
     * @return string
     */
    public
    function getFormAction() {
        return '/blog/index/createArticle';
    }
}
