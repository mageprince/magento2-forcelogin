<?php


namespace Prince\Forcelogin\Setup;

use Magento\Framework\Setup\ModuleContextInterface;
use Magento\Framework\Setup\InstallSchemaInterface;
use Magento\Framework\Setup\SchemaSetupInterface;

class InstallSchema implements InstallSchemaInterface
{

    /**
     * {@inheritdoc}
     */
    public function install(
        SchemaSetupInterface $setup,
        ModuleContextInterface $context
    ) {
        $installer = $setup;
        $installer->startSetup();

        $table_prince_forcelogin = $setup->getConnection()->newTable($setup->getTable('prince_forcelogin'));

        
        $table_prince_forcelogin->addColumn(
            'forcelogin_id',
            \Magento\Framework\DB\Ddl\Table::TYPE_INTEGER,
            null,
            array('identity' => true,'nullable' => false,'primary' => true,'unsigned' => true,),
            'Entity ID'
        );
        

        
        $table_prince_forcelogin->addColumn(
            'name',
            \Magento\Framework\DB\Ddl\Table::TYPE_TEXT,
            null,
            [],
            'name'
        );
        

        
        $table_prince_forcelogin->addColumn(
            'url',
            \Magento\Framework\DB\Ddl\Table::TYPE_TEXT,
            null,
            [],
            'url'
        );
        

        
        $table_prince_forcelogin->addColumn(
            'storeview',
            \Magento\Framework\DB\Ddl\Table::TYPE_TEXT,
            null,
            [],
            'storeview'
        );
        

        
        $table_prince_forcelogin->addColumn(
            'customer_group',
            \Magento\Framework\DB\Ddl\Table::TYPE_TEXT,
            null,
            [],
            'customer_group'
        );
        

        
        $table_prince_forcelogin->addColumn(
            'status',
            \Magento\Framework\DB\Ddl\Table::TYPE_BOOLEAN,
            null,
            [],
            'status'
        );
        

        $setup->getConnection()->createTable($table_prince_forcelogin);

        $setup->endSetup();
    }
}
