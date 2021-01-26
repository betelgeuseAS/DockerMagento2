<?php
namespace Betelgeuse\Blog\Controller\Index;

use Magento\Framework\App\Action\Action;
use Magento\Framework\App\Action\Context;
use Magento\Framework\App\Action\HttpGetActionInterface;
use Magento\Framework\App\Action\HttpPostActionInterface;
use Magento\Framework\View\Result\PageFactory;
use Betelgeuse\Blog\Helper\Data;
use Betelgeuse\Blog\Api\HamburgerRepositoryInterface;
use Magento\Tax\Api\TaxClassManagementInterface;
use Magento\Tax\Model\ClassModel;

//filterBuilder

/**
 * Class Index
 *
 * @package Betelgeuse\Blog\Controller\Index
 */
class Index extends Action implements HttpGetActionInterface, HttpPostActionInterface {

    /**
     * @var PageFactory
     */
    private $resultPageFactory;

    /**
     * @var Data
     */
    private $helper;

    protected $_testReporitory;

    /**
     * @var \Magento\Framework\Api\FilterBuilder
     */
    protected $filterBuilder;

    /**
     * @var \Magento\Framework\Api\SearchCriteriaBuilder
     */
    protected $searchCriteriaBuilder;

    /**
     * Index constructor.
     *
     * @param Context $context
     * @param PageFactory $resultPageFactory
     * @param Data $helper
     */
    public
    function __construct(
        Context $context,
        PageFactory $resultPageFactory,
        HamburgerRepositoryInterface $testReporitory,
        Data $helper,
        \Magento\Framework\Api\FilterBuilder $filterBuilder,
        \Magento\Framework\Api\SearchCriteriaBuilder $searchCriteriaBuilder
    ) {
        parent::__construct($context);

        $this->resultPageFactory = $resultPageFactory;
        $this->helper = $helper;
        $this->_testReporitory = $testReporitory;
        $this->filterBuilder = $filterBuilder;
        $this->searchCriteriaBuilder = $searchCriteriaBuilder;
    }

    /**
     * {@inheritdoc}
     */
    public
    function execute() { // https://magento2.dev/blog/index/index/ or https://magento2.dev/blog/
        // $urlList = $this->helper->getUrlList();

        $filter = $this->filterBuilder
            ->setField('author')
            ->setValue('Author2')
            ->create();
        $searchCriteria = $this->searchCriteriaBuilder->addFilters([$filter])->create();
        $searchResults = $this->_testReporitory->getList($searchCriteria);

        $result = $this->resultPageFactory->create();
        $result->getConfig()->getTitle()->set('Index');

        try {
            $testId = 1;//any id
            $data = $this->_testReporitory->getById($testId);
            die($data->getData('title'));
        } catch (\Exception $e) {
            $this->messageManager->addException($e, $e->getMessage());
        }

        return $result;
    }
}
