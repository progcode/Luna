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
$table = $installer->getConnection()
    ->newTable($installer->getTable('aion_rbanner/banner'))
    ->addColumn(
        'entity_id',
        Varien_Db_Ddl_Table::TYPE_INTEGER,
        null,
        array(
            'unsigned' => true,
            'identity' => true,
            'nullable' => false,
            'primary'  => true,
        ),
        'Entity id'
    )
    ->addColumn(
        'title',
        Varien_Db_Ddl_Table::TYPE_TEXT,
        255,
        array(
            'nullable' => true,
        ),
        'Title'
    )
    ->addColumn(
        'stores',
        Varien_Db_Ddl_Table::TYPE_TEXT,
        63,
        array(
            'nullable' => true,
            'default'  => null,
        ),
        'Stores'
    )
    ->addColumn(
        'status',
        Varien_Db_Ddl_Table::TYPE_INTEGER,
        null,
        array(
            'unsigned' => true,
            'nullable' => false,
            'default'  => 0
        ),
        'Status'
    )
    ->addIndex(
        $installer->getIdxName(
            $installer->getTable('aion_rbanner/banner'),
            array('title'),
            Varien_Db_Adapter_Interface::INDEX_TYPE_INDEX
        ),
        array('title'),
        array('type' => Varien_Db_Adapter_Interface::INDEX_TYPE_INDEX)
    )
    ->setComment('Banner entity');

$installer->getConnection()->createTable($table);


/**
 * Create aion_rbanner_slide table
 */
$table = $installer->getConnection()
    ->newTable($installer->getTable('aion_rbanner/slide'))
    ->addColumn(
        'entity_id',
        Varien_Db_Ddl_Table::TYPE_INTEGER,
        null,
        array(
            'unsigned' => true,
            'identity' => true,
            'nullable' => false,
            'primary'  => true,
        ),
        'Entity id'
    )
    ->addColumn(
        'banner_id',
        Varien_Db_Ddl_Table::TYPE_INTEGER,
        null,
        array(
            'unsigned' => true,
            'nullable' => true,
            'default' => null
        ),
        'Banner id'
    )
    ->addColumn(
        'title',
        Varien_Db_Ddl_Table::TYPE_TEXT,
        255,
        array(
            'nullable' => true,
        ),
        'Title'
    )
    ->addColumn(
        'desktop_image',
        Varien_Db_Ddl_Table::TYPE_TEXT,
        255,
        array(
            'nullable' => true,
        ),
        'Desktop Image'
    )
    ->addColumn(
        'tablet_image',
        Varien_Db_Ddl_Table::TYPE_TEXT,
        255,
        array(
            'nullable' => true,
        ),
        'Tablet Image'
    )
    ->addColumn(
        'mobile_image',
        Varien_Db_Ddl_Table::TYPE_TEXT,
        255,
        array(
            'nullable' => true,
        ),
        'Mobile Image'
    )
    ->addColumn(
        'link',
        Varien_Db_Ddl_Table::TYPE_TEXT,
        255,
        array(
            'nullable' => true,
        ),
        'Link'
    )
    ->addColumn(
        'html',
        Varien_Db_Ddl_Table::TYPE_TEXT,
        '2M',
        array(
            'nullable' => true,
            'default'  => null,
        ),
        'Html'
    )
    ->addColumn(
        'position',
        Varien_Db_Ddl_Table::TYPE_INTEGER,
        null,
        array(
            'unsigned' => true,
            'nullable' => false,
            'default'  => 0
        ),
        'Position'
    )
    ->addIndex(
        $installer->getIdxName(
            $installer->getTable('aion_rbanner/slide'),
            array('banner_id'),
            Varien_Db_Adapter_Interface::INDEX_TYPE_INDEX
        ),
        array('banner_id'),
        array('type' => Varien_Db_Adapter_Interface::INDEX_TYPE_INDEX)
    )
    ->addForeignKey(
        $installer->getFkName(
            'aion_rbanner/banner',
            'entity_id',
            'aion_rbanner/slide',
            'banner_id'
        ),
        'banner_id',
        $installer->getTable('aion_rbanner/banner'),
        'entity_id',
        Varien_Db_Ddl_Table::ACTION_CASCADE,
        Varien_Db_Ddl_Table::ACTION_CASCADE
    )
    ->setComment('Banner Slides');

$installer->getConnection()->createTable($table);

$installer->endSetup();
