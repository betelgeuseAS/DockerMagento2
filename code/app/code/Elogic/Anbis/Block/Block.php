<?php
namespace Elogic\Anbis\Block;

use Magento\Framework\App\Config\ScopeConfigInterface;
use Magento\Framework\View\Element\Template;

/**
 * Class Block
 * @package Elogic\Anbis\Block
 */
class Block extends Template {

    /**
     * Core store config
     *
     * @var ScopeConfigInterface
     */
    protected $scopeConfig;

    /**
     * Block constructor.
     * @param Template\Context $context
     * @param ScopeConfigInterface $scopeConfig
     * @param array $data
     */
    public
    function __construct(Template\Context $context, ScopeConfigInterface $scopeConfig, array $data = []) {
        parent::__construct($context, $data);

        $this->scopeConfig = $scopeConfig;
    }

    public
    function getConfigBlock1() {
        return $this->scopeConfig->getValue('elogic/anbis/block1', \Magento\Store\Model\ScopeInterface::SCOPE_STORE);
    }
}
