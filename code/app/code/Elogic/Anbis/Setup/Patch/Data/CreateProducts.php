<?php
namespace Elogic\Anbis\Setup\Patch\Data;

use Magento\Framework\Setup\Patch\DataPatchInterface;
use Magento\Framework\View\Result\PageFactory;

/**
 * Class CreateProducts
 * @package Elogic\Anbis\Setup\Patch\Data
 */
class CreateProducts implements DataPatchInterface {

    /**
     * @var \Magento\Catalog\Model\ProductFactory
     */
    protected $productFactory;

    /**
     * @var \Magento\Catalog\Api\ProductRepositoryInterface
     */
    protected $productRepository;

    /**
     * @param \Magento\Catalog\Model\ProductFactory $productFactory
     * @param \Magento\Catalog\Api\ProductRepositoryInterface $productRepository
     */
    public function __construct(
        \Magento\Framework\App\State $state,
        \Magento\Catalog\Model\ProductFactory $productFactory,
        \Magento\Catalog\Api\ProductRepositoryInterface $productRepository
    ) {
        $state->setAreaCode(\Magento\Framework\App\Area::AREA_FRONTEND); // or \Magento\Framework\App\Area::AREA_ADMINHTML, depending on your needs

        $this->productFactory = $productFactory;
        $this->productRepository = $productRepository;
    }

    /**
     * {@inheritdoc}
     */
    public
    function apply() {
        $_product = $this->productFactory->create();

        $_product->setName('Test Product');
        $_product->setTypeId('Dome');
        $_product->setAttributeSetId(4);
        $_product->setSku('test-SKU');
        $_product->setWebsiteIds(array(1));
        $_product->setVisibility(4);
        $_product->setPrice(350);
        $_product->setStatus(\Magento\Catalog\Model\Product\Attribute\Source\Status::STATUS_ENABLED);
        $_product->setStockData(array(
                'use_config_manage_stock' => 0, //'Use config settings' checkbox
                'manage_stock' => 1, //manage stock
                'min_sale_qty' => 1, //Minimum Qty Allowed in Shopping Cart
                'max_sale_qty' => 2, //Maximum Qty Allowed in Shopping Cart
                'is_in_stock' => 1, //Stock Availability
                'qty' => 100 //qty
            )
        );

        $product = $this->productRepository->save($_product);
    }

    /**
     * {@inheritdoc}
     */
    public static
    function getDependencies() {
        return [];
    }

    /**
     * {@inheritdoc}
     */
    public
    function getAliases() {
        return [];
    }
}
