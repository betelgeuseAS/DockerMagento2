<?php
namespace Betelgeuse\Blog\Model\Config\Source;

use Betelgeuse\Blog\Helper\Data;
use Magento\Framework\Option\ArrayInterface;

/**
 * Class Articles
 *
 * @package Magento\Config\Model\Config\Source
 */
class Articles implements ArrayInterface {

    /**
     * @var Data
     */
    private $helper;

    /**
     * @param Data $helper
     */
    public
    function __construct(Data $helper) {
        $this->helper = $helper;
    }

    /**
     * @return array
     */
    public
    function toOptionArray() {
        $articles = $this->helper->getArticles();
        $value = [];

        foreach ($articles as $article) {
            $value[] = [
                'value' => $article->getEntityId(),
                'label' => $article->getTitle()
            ];
        }

        return $value;
    }
}
