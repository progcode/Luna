<?php
/**
 * Class Icoders_Slider create icoders_slider table
 *
 * @category  Icoders
 * @package   Icoders_Slider
 * @author    iCoders <support@icoders.co>
 * @copyright 2017 Icoders (http://icoders.co)
 * @license   http://icoders.co/licence Icoders License
 * @link      http://icoders.co
 */
/** @var $installer Mage_Core_Model_Resource_Setup */

$installer = $this;

/**
 * Create icoders_slider_entity table
 */
$table = $installer->getConnection()->addColumn(
    $installer->getTable('icoders_slider/banner'),
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
