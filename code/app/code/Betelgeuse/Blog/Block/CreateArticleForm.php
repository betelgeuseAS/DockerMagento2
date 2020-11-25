<?php
namespace Betelgeuse\Blog\Block;

use Magento\Framework\App\RequestInterface;
use Magento\Framework\View\Element\Template;

class CreateArticleForm extends Template {

    /**
     * @var RequestInterface
     */
    private $request;

    public
    function __construct(Template\Context $context, RequestInterface $request, array $data = []) {
        parent::__construct($context, $data);
        $this->request = $request;
    }

    /**
     * Get form action URL for POST request
     *
     * @return string
     */
    public
    function getFormAction() {
        return '/blog/index/createArticle'; // '/module_name/controller_name/action_name'
    }
}
