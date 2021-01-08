<?php
namespace Elogic\Anbis\Setup;

use Magento\Framework\DB\Ddl\Table;
use Magento\Framework\Setup\ModuleContextInterface;
use Magento\Framework\Setup\SchemaSetupInterface;
use Magento\Framework\Setup\UpgradeSchemaInterface;

/**
 * Class UpgradeSchema
 * @package Elogic\Anbis\Setup
 */
class UpgradeSchema implements UpgradeSchemaInterface {

    /**
     * {@inheritdoc}
     */
    public
    function upgrade(SchemaSetupInterface $setup, ModuleContextInterface $context) { // If you want launch upgrade one more time you should delete recorde from setup_module table - SELECT * FROM magento2.setup_module where module like '%elogic%';
        $installer = $setup;
        $installer->startSetup();

        if (version_compare($context->getVersion(), '1.0.1') < 0) {
            $connection = $installer->getConnection();

            $tableNameQuoteItem = $installer->getTable('quote_item'); // $connection->getTableName('quote_item');
            $tableNameSalesOrder = $installer->getTable('sales_order_item');

            $columnNameName1 = 'name1';
            $columnNameName2 = 'name2';

            if ($connection->isTableExists($tableNameQuoteItem)) {
                if ($connection->tableColumnExists($tableNameQuoteItem, $columnNameName1) === false) {
                    $connection->addColumn($tableNameQuoteItem, $columnNameName1, [
                        'type'     => Table::TYPE_TEXT,
                        'length'   => 255,
                        'nullable' => true,
                        'default'  => '',
                        'after'    => null, // column name to insert new column after
                        'comment'  => 'Add New Filed'
                    ]);
                }

                if ($connection->tableColumnExists($tableNameQuoteItem, $columnNameName2) === false) {
                    $connection->addColumn($tableNameQuoteItem, $columnNameName2, [
                        'type'     => Table::TYPE_TEXT,
                        'length'   => 255,
                        'nullable' => true,
                        'default'  => '',
                        'after'    => null, // column name to insert new column after
                        'comment'  => 'Add New Filed'
                    ]);
                }
            }

            if ($connection->isTableExists($tableNameSalesOrder)) {
                if ($connection->tableColumnExists($tableNameSalesOrder, $columnNameName1) === false) {
                    $connection->addColumn($tableNameSalesOrder, $columnNameName1, [
                        'type'     => Table::TYPE_TEXT,
                        'length'   => 255,
                        'nullable' => true,
                        'default'  => '',
                        'after'    => null, // column name to insert new column after
                        'comment'  => 'Add New Filed'
                    ]);
                }

                if ($connection->tableColumnExists($tableNameSalesOrder, $columnNameName2) === false) {
                    $connection->addColumn($tableNameSalesOrder, $columnNameName2, [
                        'type'     => Table::TYPE_TEXT,
                        'length'   => 255,
                        'nullable' => true,
                        'default'  => '',
                        'after'    => null, // column name to insert new column after
                        'comment'  => 'Add New Filed'
                    ]);
                }
            }
        }

        $installer->endSetup();
    }
}
