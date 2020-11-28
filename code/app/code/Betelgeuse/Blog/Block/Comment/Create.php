<?php
namespace Betelgeuse\Blog\Block\Comment;

use Magento\Framework\App\RequestInterface;
use Magento\Framework\View\Element\Template;

class Create extends Template {

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
        $articleId = (int)$this->request->getParam('id');

        return '/blog/index/createComment?id=' . $articleId;
    }
}
