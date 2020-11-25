<?php
namespace Betelgeuse\Blog\Model\ResourceModel;

use Magento\Framework\Model\ResourceModel\Db\AbstractDb;

class Article extends AbstractDb {

    /**
     * Initialize connection and define main table
     *
     * @return void
     */
    public
    function _construct() {
        $this->_init("betelgeuse_blog_articles","entity_id");
    }
}

