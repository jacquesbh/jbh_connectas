<?php
/**
 * This file is part of Jbh_ConnectAs for Magento.
 *
 * @license MIT (https://raw.github.com/jacquesbh/jbh_connectas/master/LICENSE)
 * @category Jbh
 * @package Jbh_ConnectAs
 * @copyright Copyright (c) 2012 Jacques Bodin-Hullin <jacques@bodin-hullin.net>
 */

try {

    /* @var $installer Mage_Core_Model_Resource_Setup */
    $installer = $this;
    $installer->startSetup();

    // Create the table with the requests
    $tableName = $installer->getTable('jbh_connectas/request');
    if (!$installer->tableExists($tableName)) {
        $table = $installer->getConnection()->newTable($tableName);
        $table
            ->addColumn('request_id', Varien_Db_Ddl_Table::TYPE_INTEGER, null, [
                'identity' => true,
                'unsigned' => true,
                'nullable' => false,
                'primary'  => true,
            ], 'Request ID')
            ->addColumn('customer_id', Varien_Db_Ddl_Table::TYPE_INTEGER, null, [
                'nullable' => false,
                'unsigned' => true,
            ], 'Customer ID')
            ->addColumn('hash', Varien_Db_Ddl_Table::TYPE_VARCHAR, 40, [
                'nullable' => false,
                'unsigned' => true,
            ], 'Customer ID')
            ->addColumn('created_at', Varien_Db_Ddl_Table::TYPE_DATETIME, null, [
                'nullable' => false,
            ], 'Creation date')
        ;
        $installer->getConnection()->createTable($table);
    }

    $installer->endSetup();

} catch (Exception $e) {
    // Silence is golden
}
