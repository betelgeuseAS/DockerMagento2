<?php
namespace Betelgeuse\Blog\Api;

use Magento\Framework\Api\SearchCriteriaInterface;
use Betelgeuse\Blog\Api\Data\HamburgerInterface;

interface HamburgerRepositoryInterface
{
    /**
     * @param int $id
     * @return \Betelgeuse\Blog\Api\Data\HamburgerInterface
     * @throws \Magento\Framework\Exception\NoSuchEntityException
     */
    public function getById($id);

    /**
     * @param \Betelgeuse\Blog\Api\Data\HamburgerInterface $hamburger
     * @return \Betelgeuse\Blog\Api\Data\HamburgerInterface
     */
    public function save(HamburgerInterface $hamburger);

    /**
     * @param \Betelgeuse\Blog\Api\Data\HamburgerInterface $hamburger
     * @return void
     */
    public function delete(HamburgerInterface $hamburger);

    /**
     * @param \Magento\Framework\Api\SearchCriteriaInterface $searchCriteria
     * @return \Betelgeuse\Blog\Api\Data\HamburgerSearchResultInterface
     */
    public function getList(SearchCriteriaInterface $searchCriteria);
}
