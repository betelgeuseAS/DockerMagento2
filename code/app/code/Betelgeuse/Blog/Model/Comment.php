<?php
namespace Betelgeuse\Blog\Model;

use Magento\Framework\Model\AbstractModel;

/**
 * Class Comment
 *
 * @package Betelgeuse\Blog\Model
 */
class Comment extends AbstractModel {

    /**
     * Initialize resource
     *
     * @return void
     */
    public
    function _construct() {
        $this->_init(\Betelgeuse\Blog\Model\ResourceModel\Comment::class);
    }
}
