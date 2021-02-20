<?php
namespace Betelgeuse\Blog\Controller\Index;

use Exception;
use Zend_Http_Client;
use Zend_Uri_Http;

class ApiClient {

    const HTTP_200_OK                = 200;

    const MIME_JSON                  = 'application/json';
    const HEADER_AUTH                = 'Authorization';

    const URL_AUTH             = '/integration/admin/token';
    const URL_CREATE_CMS_BLOCK = '/cmsPage';

    protected $username;
    protected $password;

    protected $accessToken;

    public
    function __construct($username, $password) {
        $this->username = $username;
        $this->password = $password;
    }

    public
    function getAccessToken() {
        if (!$this->accessToken) {
            $data = array(
                'username' => $this->username,
                'password' => $this->password
            );

            $client = new Zend_Http_Client($this->getUrl(self::URL_AUTH));
            $client->setMethod(Zend_Http_Client::POST)
                ->setHeaders(Zend_Http_Client::CONTENT_TYPE, self::MIME_JSON)
                ->setRawData(json_encode($data), self::MIME_JSON);

            $response = $client->request();
            $body = json_decode($response->getBody());

            if ($response->getStatus() !== self::HTTP_200_OK) {
                throw new Exception('Cannot get access token');
            }

            $this->accessToken = $body;
        }

        return $this->accessToken;
    }

    public
    function createCmsBlock($data) {
        $data = json_encode($data);
        $response = $this->executeRequest(self::URL_CREATE_CMS_BLOCK, $data, Zend_Http_Client::POST);

        if ($response->getStatus() !== self::HTTP_200_OK) {
            throw new Exception('Cannot obtain tracking numbers.');
        }

        return json_decode($response->getBody());
    }

    protected
    function getUrl($path) {
        $baseUrl = Zend_Uri_Http::fromString('https://magento2.dev/rest/all/V1/');
        $baseUrl->setPath($path);

        return $baseUrl;
    }

    protected
    function executeRequest($url, $data = array(), $method = Zend_Http_Client::GET, $headers = array()) {
        $client = new Zend_Http_Client($this->getUrl($url));
        $client->setMethod($method)
            ->setHeaders(array_merge(array(self::HEADER_AUTH => $this->getAccessToken()), $headers));

        if ($method == Zend_Http_Client::GET && count($data)) {
            $client->setParameterGet($data);
        }
        if ($method == Zend_Http_Client::POST && count($data)) {
            $client->setRawData(json_encode($data), self::MIME_JSON);;
        }

        return $client->request();
    }
}
