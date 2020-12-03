<?php
namespace Betelgeuse\Blog\Model;

use Magento\Framework\Model\AbstractModel;

/**
 * Class Article
 *
 * @package Betelgeuse\Blog\Model
 */
class Article extends AbstractModel {

    /**
     * Initialize resource
     *
     * @return void
     */
    public
    function _construct() {
        $this->_init(\Betelgeuse\Blog\Model\ResourceModel\Article::class);
    }
}
