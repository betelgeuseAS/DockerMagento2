<?php
namespace Elogic\Anbis\Model;

use Magento\Quote\Model\Quote as QuoteEntity;
use Magento\Quote\Model\ResourceModel\Quote\Item;

/**
 * Class QuoteManagement
 * @package Elogic\Anbis\Model
 */
class QuoteManagement extends \Magento\Quote\Model\QuoteManagement {

    /**
     * {@inheritDoc}
     */
    protected
    function resolveItems(QuoteEntity $quote) {
        $orderItems = [];
        foreach ($quote->getAllItems() as $quoteItem) {
            $itemId = $quoteItem->getId();

            if (!empty($orderItems[$itemId])) {
                continue;
            }

            $parentItemId = $quoteItem->getParentItemId();
            /** @var Item $parentItem */
            if ($parentItemId && !isset($orderItems[$parentItemId])) {
                $orderItems[$parentItemId] = $this->quoteItemToOrderItem->convert(
                    $quoteItem->getParentItem(),
                    ['parent_item' => null]
                );
            }
            $parentItem = isset($orderItems[$parentItemId]) ? $orderItems[$parentItemId] : null;
            $orderItems[$itemId] = $this->quoteItemToOrderItem->convert($quoteItem, ['parent_item' => $parentItem]);

            // OVERRIDE set data
            $orderItems[$itemId]->setData('name1', $quoteItem->getData('name1'));
            $orderItems[$itemId]->setData('name2', $quoteItem->getData('name2'));
            // OVERRIDE END
        }
        return array_values($orderItems);
    }
}
