<?php
namespace Betelgeuse\Blog\Model\ResourceModel\Article;

use Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection;

/**
 * Class Collection
 *
 * @package Betelgeuse\Blog\Model\ResourceModel\Article
 */
class Collection extends AbstractCollection {

    /**
     * Resource collection initialization
     *
     * @return void
     */
    protected
    function _construct() {
        $this->_init(
            \Betelgeuse\Blog\Model\Article::class,
            \Betelgeuse\Blog\Model\ResourceModel\Article::class
        );
    }
}
