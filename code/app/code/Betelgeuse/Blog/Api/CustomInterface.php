<?php
namespace Betelgeuse\Blog\Api;

use Magento\Tests\NamingConvention\true\object;

interface CustomInterface {

    // sudo rm -rf code/generated/
    // bin/magento ca:fl
    // bin/magento setup:di:compile

    /**
     * GET articles
     * @return string
     */
    public function getArticles();

//    /**
//     * UPDATE article by id
//     * @param $data
//     * @return string
//     */
//    public function updateArticle($data);

//    /**
//    * GET for Post api
//    * @param string $value
//    * @return string
//    */
//    public function getPost($value);
}
