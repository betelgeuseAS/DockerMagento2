<?php
namespace Betelgeuse\Blog\Controller\Index;

use Magento\Framework\App\Action\Action;
use Magento\Framework\App\Action\Context;
use Magento\Framework\App\Action\HttpGetActionInterface;
use Magento\Framework\App\Action\HttpPostActionInterface;
use Magento\Framework\DB\Adapter\AdapterInterface;
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

    protected $_resourceConnection;
    protected $_connection;

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
        \Magento\Framework\Api\SearchCriteriaBuilder $searchCriteriaBuilder,
        \Magento\Framework\App\ResourceConnection $resourceConnection
    ) {
        parent::__construct($context);

        $this->resultPageFactory = $resultPageFactory;
        $this->helper = $helper;
        $this->_testReporitory = $testReporitory;
        $this->filterBuilder = $filterBuilder;
        $this->searchCriteriaBuilder = $searchCriteriaBuilder;
        $this->_resourceConnection = $resourceConnection;
    }

    /**
     * {@inheritdoc}
     */
    public
    function execute() { // https://magento2.dev/blog/index/index/ or https://magento2.dev/blog/
        // $urlList = $this->helper->getUrlList();



        // Filters:
//        $filter = $this->filterBuilder
//            ->setField('author')
//            ->setValue('Author2')
//            ->create();
//        $searchCriteria = $this->searchCriteriaBuilder->addFilters([$filter])->create();
//        $searchResults = $this->_testReporitory->getList($searchCriteria);
//        try {
//            $testId = 1;//any id
//            $data = $this->_testReporitory->getById($testId);
//            die($data->getData('title'));
//        } catch (\Exception $e) {
//            $this->messageManager->addException($e, $e->getMessage());
//        }



        // Zend DB
//        $this->_connection = $this->_resourceConnection->getConnection();
//        $query = "SELECT * FROM test WHERE id = 2";
//        $collection = $this->_connection->fetchAll($query);

//        $select = $this->_resourceConnection->getConnection()
//            ->select()
////            ->from(['main_table' => 'test'], 'COUNT(*)')
//            ->from(['main_table' => 'test'], 'name')
//            ->where('main_table.id = ?', 2);
//        $data = $this->_resourceConnection->getConnection()->fetchAll($select);

        $connection = $this->_resourceConnection->getConnection();
//        $subQuery = $connection->select()
//            ->from('test', new \Zend_Db_Expr('company, avg(salary) as average_salary'))
//            ->group('company');
//        $query = $connection->select()
//            ->from(['t1' => 'test'], new \Zend_Db_Expr('t1.name, t2.company'))
//            ->joinInner(['t2' => new \Zend_Db_Expr('('.$subQuery.')')], 't1.company = t2.company')
//            ->where('t1.salary > t2.average_salary');
//        $data = $connection->fetchAll($query);

//        $subQuery1 = $connection->select()
//            ->from('test', new \Zend_Db_Expr('avg(salary)'))
//            ->where("company = 'Company1'");
//        $subQuery2 = $connection->select()
//            ->from('test', new \Zend_Db_Expr('avg(salary)'))
//            ->where("company = 'Company2'");
//        $query = $connection->select()
//            ->from('test', ['company', 'name', 'salary'])
//            ->where('salary > ' . new \Zend_Db_Expr('('.$subQuery1.')') . 'and company = :com1')
//            ->orWhere('salary > ' . new \Zend_Db_Expr('('.$subQuery2.')') . 'and company = :com2');
//        $data = $this->_resourceConnection->getConnection()->fetchAll($query, ['com1' => 'Company1', 'com2' => 'Company2']);



        // Client
//        $apiClient = new ApiClient('betelgeuse', 'Idialiy1');
//        $data = '{
//            "page": {
//                "identifier": "mage-2-blog",
//                "title": "Mage 2 Blog Example",
//                "page_layout": "2columns-right",
//                "meta_keywords": "Page keywords",
//                "meta_description": "Page description",
//                "content_heading": "A New Page for the blog",
//                "content": "A New Page for the blog - with some new content",
//                "sort_order": "0",
//                "active": true
//            }
//        }';
//        $cmsBlock = $apiClient->createCmsBlock(json_decode($data));



        $result = $this->resultPageFactory->create();
        $result->getConfig()->getTitle()->set('Index');

        return $result;
    }
}
