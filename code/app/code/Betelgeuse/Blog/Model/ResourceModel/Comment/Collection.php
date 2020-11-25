<?php
namespace Betelgeuse\Blog\Model\ResourceModel\Comment;

use Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection;

class Collection extends AbstractCollection {

    /**
     * Resource collection initialization
     *
     * @return void
     */
    protected
    function _construct() {
        $this->_init(
            \Betelgeuse\Blog\Model\Comment::class,
            \Betelgeuse\Blog\Model\ResourceModel\Comment::class
        );
    }
}
