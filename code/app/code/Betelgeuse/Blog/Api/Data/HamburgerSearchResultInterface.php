<?php
namespace Betelgeuse\Blog\Api\Data;

use Magento\Framework\Api\SearchResultsInterface;

interface HamburgerSearchResultInterface extends SearchResultsInterface
{
    /**
     * @return \Betelgeuse\Blog\Api\Data\HamburgerInterface[]
     */
    public function getItems();

    /**
     * @param \Betelgeuse\Blog\Api\Data\HamburgerInterface[] $items
     * @return void
     */
    public function setItems(array $items);
}
