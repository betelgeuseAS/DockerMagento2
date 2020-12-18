<?php
namespace Betelgeuse\Blog\Observer;

use Magento\Framework\Event\Observer;
use Magento\Framework\Event\ObserverInterface;

/***
 * Class ObserverOne
 *
 * @package Betelgeuse\Blog\Observer
 */
class ObserverOne implements ObserverInterface {

    /**
     * @param Observer $observer
     * @return $this|void
     */
    public
    function execute(Observer $observer) {
        $action = $observer->getData('action');
        $page = $observer->getData('page');

        $page->getConfig()->getTitle()->set('View Article (Event)');

        return $this;
    }
}
