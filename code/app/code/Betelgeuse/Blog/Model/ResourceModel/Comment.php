<?php
namespace Betelgeuse\Blog\Model\ResourceModel;

use Magento\Framework\Model\ResourceModel\Db\AbstractDb;

/**
 * Class Comment
 *
 * @package Betelgeuse\Blog\Model\ResourceModel
 */
class Comment extends AbstractDb {

    /**
     * Initialize connection and define main table
     *
     * @return void
     */
    public
    function _construct() {
        $this->_init("betelgeuse_blog_comments","entity_id");
    }
}

