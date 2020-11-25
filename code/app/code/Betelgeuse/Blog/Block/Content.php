<?php
namespace Betelgeuse\Blog\Block;

use Magento\Framework\App\RequestInterface;
use Magento\Framework\View\Element\Template;

class Content extends Template {

    /**
     * @var RequestInterface
     */
    private $request;

    public
    function __construct(Template\Context $context, RequestInterface $request, array $data = []) {
        parent::__construct($context, $data);
        $this->request = $request;
    }

    public
    function getAlias() {
        return $this->request->getParam('alias');
    }
}
