<?php
namespace Betelgeuse\Blog\Model;

use Magento\Framework\Api\SearchCriteriaInterface;
use Magento\Framework\Api\SortOrder;
use Magento\Framework\Exception\NoSuchEntityException;
use Betelgeuse\Blog\Api\Data\HamburgerInterface;
use Betelgeuse\Blog\Api\Data\HamburgerSearchResultInterface;
use Betelgeuse\Blog\Api\Data\HamburgerSearchResultInterfaceFactory;
use Betelgeuse\Blog\Api\HamburgerRepositoryInterface;
use Betelgeuse\Blog\Model\ResourceModel\Article\CollectionFactory as HamburgerCollectionFactory;
use Betelgeuse\Blog\Model\ResourceModel\Article\Collection;
use Betelgeuse\Blog\Model\ArticleFactory as HamburgerFactory;

class HamburgerRepository implements HamburgerRepositoryInterface
{
    /**
     * @var HamburgerFactory
     */
    private $hamburgerFactory;

    /**
     * @var HamburgerCollectionFactory
     */
    private $hamburgerCollectionFactory;

    /**
     * @var HamburgerSearchResultInterfaceFactory
     */
    private $searchResultFactory;

    public function __construct(
        HamburgerFactory $hamburgerFactory,
        HamburgerCollectionFactory $hamburgerCollectionFactory,
        HamburgerSearchResultInterfaceFactory $hamburgerSearchResultInterfaceFactory
    ) {
        $this->hamburgerFactory = $hamburgerFactory;
        $this->hamburgerCollectionFactory = $hamburgerCollectionFactory;
        $this->searchResultFactory = $hamburgerSearchResultInterfaceFactory;
    }

    // ... getById, save and delete methods listed above ...

    public function getList(SearchCriteriaInterface $searchCriteria)
    {
        $collection = $this->hamburgerCollectionFactory->create();

        $this->addFiltersToCollection($searchCriteria, $collection);
        $this->addSortOrdersToCollection($searchCriteria, $collection);
        $this->addPagingToCollection($searchCriteria, $collection);

        $collection->load();

        return $this->buildSearchResult($searchCriteria, $collection);
    }

    private function addFiltersToCollection(SearchCriteriaInterface $searchCriteria, Collection $collection)
    {
        foreach ($searchCriteria->getFilterGroups() as $filterGroup) {
            $fields = $conditions = [];
            foreach ($filterGroup->getFilters() as $filter) {
                $fields[] = $filter->getField();
                $conditions[] = [$filter->getConditionType() => $filter->getValue()];
            }
            $collection->addFieldToFilter($fields, $conditions);
        }
    }

    private function addSortOrdersToCollection(SearchCriteriaInterface $searchCriteria, Collection $collection)
    {
        foreach ((array) $searchCriteria->getSortOrders() as $sortOrder) {
            $direction = $sortOrder->getDirection() == SortOrder::SORT_ASC ? 'asc' : 'desc';
            $collection->addOrder($sortOrder->getField(), $direction);
        }
    }

    private function addPagingToCollection(SearchCriteriaInterface $searchCriteria, Collection $collection)
    {
        $collection->setPageSize($searchCriteria->getPageSize());
        $collection->setCurPage($searchCriteria->getCurrentPage());
    }

    private function buildSearchResult(SearchCriteriaInterface $searchCriteria, Collection $collection)
    {
        $searchResults = $this->searchResultFactory->create();

        $searchResults->setSearchCriteria($searchCriteria);
        $searchResults->setItems($collection->getItems());
        $searchResults->setTotalCount($collection->getSize());

        return $searchResults;
    }

    public function getById($id)
    {
        $hamburger = $this->hamburgerFactory->create();
        $hamburger->getResource()->load($hamburger, $id);
        if (! $hamburger->getId()) {
            throw new NoSuchEntityException(__('Unable to find hamburger with ID "%1"', $id));
        }
        return $hamburger;
    }

    public function save(HamburgerInterface $hamburger)
    {
        $hamburger->getResource()->save($hamburger);
        return $hamburger;
    }

    public function delete(HamburgerInterface $hamburger)
    {
        $hamburger->getResource()->delete($hamburger);
    }
}
