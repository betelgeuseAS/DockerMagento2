<?php
namespace Elogic\Anbis\Model;

use Magento\Catalog\Model\Product;
use Magento\Catalog\Model\Product\Type\AbstractType;

/**
 * Class Quote
 * @package Elogic\Anbis\Model
 */
class Quote extends \Magento\Quote\Model\Quote {

    /**
     * {@inheritDoc}
     */
    public
    function addProduct(
        Product $product,
        $request = null,
        $processMode = AbstractType::PROCESS_MODE_FULL
    ) {
        $parentItem = parent::addProduct($product, $request, $processMode);

        $parentItem->setData('name1', $request->getData('name1'));
        $parentItem->setData('name2', $request->getData('name2'));

        return $parentItem;
    }
}
