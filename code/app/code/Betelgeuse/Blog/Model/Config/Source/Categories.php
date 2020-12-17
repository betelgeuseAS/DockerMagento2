<?php
namespace Betelgeuse\Blog\Model\Config\Source;

use Betelgeuse\Blog\Helper\Data;
use Magento\Framework\Option\ArrayInterface;

/**
 * Class Categories
 *
 * @package Betelgeuse\Blog\Model\Config\Source
 */
class Categories implements ArrayInterface {

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
        return [
            [
                'value' => 1,
                'label' => 'Category 1'
            ],
            [
                'value' => 2,
                'label' => 'Category 2'
            ],
            [
                'value' => 3,
                'label' => 'Category 3'
            ],
            [
                'value' => 4,
                'label' => 'Category 4'
            ],
            [
                'value' => 5,
                'label' => 'Category 5'
            ],
        ];
    }
}
