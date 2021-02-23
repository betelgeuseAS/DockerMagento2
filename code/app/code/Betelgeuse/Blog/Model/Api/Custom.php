<?php
namespace Betelgeuse\Blog\Model\Api;

use Psr\Log\LoggerInterface;

class Custom {

    protected $logger;

    protected $_resourceConnection;

    public function __construct(
        LoggerInterface $logger,
        \Magento\Framework\App\ResourceConnection $resourceConnection
    ) {
        $this->logger = $logger;
        $this->_resourceConnection = $resourceConnection;
    }

    /**
     * @inheritdoc
     */
    public
    function getArticles() {
        $connection = $this->_resourceConnection->getConnection();

        $select = $connection
            ->select()
            ->from(['main_table' => 'betelgeuse_blog_articles'], '*'); // ->from(['main_table' => 'betelgeuse_blog_articles'], 'entity_id');

        return $connection->fetchAll($select);
    }

//    /**
//     * @inheritdoc
//     */
//    public
//    function updateArticle($data) {
//        $connection = $this->_resourceConnection->getConnection();
//
////        $data = [
////            'logdate' => (new \DateTime())->format(\Magento\Framework\Stdlib\DateTime::DATETIME_PHP_FORMAT),
////            'title' => $user->getLognum() + 1,
////        ];
//
//        $condition = ['entity_id = ?' => (int)1];
//
//        $connection->update('betelgeuse_blog_articles', $data, $condition);
//    }

//    /**
//     * @inheritdoc
//     */
//    public function getPost($value) {
//        $response = ['success' => false];
//
//        try {
//            // Your Code here
//
//            $response = ['success' => true, 'message' => $value];
//        } catch (\Exception $e) {
//            $response = ['success' => false, 'message' => $e->getMessage()];
//            $this->logger->info($e->getMessage());
//        }
//        $returnArray = json_encode($response);
//        return $returnArray;
//    }
}
