<?php
/**
 * Class Aion_Rbanner create aion_rbanner table
 *
 * @category  Aion
 * @package   Aion_Rbanner
 * @author    Dombi István <istvan.dombi@aionhill.com>
 * @copyright 2017 AionNext Kft. (http://aionhill.com)
 * @license   http://aionhill.com/licence Aion License
 * @link      http://aionhill.com
 */
/** @var $installer Mage_Core_Model_Resource_Setup */

$installer = $this;

/**
 * Create aion_rbanner_entity table
 */
$table = $installer->getConnection()->addColumn(
    $installer->getTable('aion_rbanner/banner'),
    'position',
    [
        'type'     => Varien_Db_Ddl_Table::TYPE_INTEGER,
        'length' => 1,
        'unsigned' => true,
        'nullable' => false,
        'default'  => 0,
        'comment' => 'Position'
    ]
);

$installer->endSetup();
