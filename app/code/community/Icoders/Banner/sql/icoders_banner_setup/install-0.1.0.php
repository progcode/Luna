<?php
/**
 * Class Icoders_Banner create icoders_banner table
 *
 * @category  Icoders
 * @package   Icoders_Banner
 * @author    iCoders <support@icoders.co>
 * @copyright 2016 Icoders (http://www.icoders.co)
 * @license   http://icoders.co/license Icoders License
 * @link      http://www.icoders.co
 */
/** @var $installer Mage_Core_Model_Resource_Setup */

$installer = $this;

/**
 * Create icoders_banner table
 */
$table = $installer->getConnection()
    ->newTable($installer->getTable('icoders_banner/banner'))
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
        'content',
        Varien_Db_Ddl_Table::TYPE_TEXT,
        '2M',
        array(
           'nullable' => true,
           'default'  => null,
        ),
        'Content'
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
    ->addColumn(
        'height',
        Varien_Db_Ddl_Table::TYPE_INTEGER,
        null,
        array(
           'unsigned' => true,
           'nullable' => false,
           'default'  => 0
        ),
        'Height'
    )
    ->addColumn(
        'width',
        Varien_Db_Ddl_Table::TYPE_INTEGER,
        null,
        array(
           'unsigned' => true,
           'nullable' => false,
           'default'  => 0
        ),
        'Width'
    )
    ->addColumn(
        'page_id',
        Varien_Db_Ddl_Table::TYPE_TEXT,
        63,
        array(
           'nullable' => true,
           'default'  => null,
        ),
        'Page Id'
    )
    ->addColumn(
        'category_id',
        Varien_Db_Ddl_Table::TYPE_TEXT,
        63,
        array(
           'nullable' => true,
           'default'  => null,
        ),
        'Category Id'
    )
    ->addColumn(
        'advanced_settings',
        Varien_Db_Ddl_Table::TYPE_TEXT,
        '2M',
        array(
           'nullable' => true,
           'default'  => null,
        ),
        'Advanced Settings'
    )
    ->addColumn(
        'created_at',
        Varien_Db_Ddl_Table::TYPE_TIMESTAMP,
        null,
        array(
           'nullable' => true,
           'default'  => null,
        ),
        'Created At'
    )
    ->addColumn(
        'updated_at',
        Varien_Db_Ddl_Table::TYPE_TIMESTAMP,
        null,
        array(
           'nullable' => true,
           'default'  => null,
        ),
        'Updated At'
    )
    ->addIndex(
        $installer->getIdxName(
            $installer->getTable('icoders_banner/banner'),
            array( 'title' ),
            Varien_Db_Adapter_Interface::INDEX_TYPE_INDEX
        ),
        array( 'title' ),
        array( 'type' => Varien_Db_Adapter_Interface::INDEX_TYPE_INDEX )
    )
    ->setComment('Banner entity');

$installer->getConnection()->createTable($table);


/**
 * Create icoders_banner_images table
 */
$table = $installer->getConnection()
    ->newTable($installer->getTable('icoders_banner/images'))
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
           'nullable' => false,
        ),
        'Banner id'
    )
    ->addColumn(
        'label',
        Varien_Db_Ddl_Table::TYPE_TEXT,
        255,
        array(
           'nullable' => true,
        ),
        'Label'
    )
    ->addColumn(
        'file',
        Varien_Db_Ddl_Table::TYPE_TEXT,
        255,
        array(
            'nullable' => true,
        ),
        'File'
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
    ->addColumn(
        'exclude',
        Varien_Db_Ddl_Table::TYPE_BOOLEAN,
        null,
        array(
           'nullable' => false,
           'default'  => 0
        ),
        'Exclude'
    )
    ->addIndex(
        $installer->getIdxName(
            $installer->getTable('icoders_banner/images'),
            array('banner_id'),
            Varien_Db_Adapter_Interface::INDEX_TYPE_INDEX
        ),
        array('banner_id'),
        array('type' => Varien_Db_Adapter_Interface::INDEX_TYPE_INDEX )
    )
    ->addForeignKey(
        $installer->getFkName(
            'icoders_banner/banner',
            'entity_id',
            'icoders_banner/images',
            'banner_id'
        ),
        'banner_id', $installer->getTable('icoders_banner/banner'), 'entity_id',
        Varien_Db_Ddl_Table::ACTION_CASCADE, Varien_Db_Ddl_Table::ACTION_CASCADE
    )
    ->setComment('Banner images');

$installer->getConnection()->createTable($table);


/**
 * Create icoders_banner_link table
 */
$table = $installer->getConnection()
    ->newTable($installer->getTable('icoders_banner/links'))
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
           'nullable' => false,
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
        'link',
        Varien_Db_Ddl_Table::TYPE_TEXT,
        255,
        array(
           'nullable' => true,
        ),
        'Link'
    )
    ->addColumn(
        'target',
        Varien_Db_Ddl_Table::TYPE_TEXT,
        20,
        array(
           'nullable' => true,
           'default'  => null,
        ),
        'Target'
    )
    ->addIndex(
        $installer->getIdxName(
            $installer->getTable('icoders_banner/links'),
            array('banner_id'),
            Varien_Db_Adapter_Interface::INDEX_TYPE_INDEX
        ),
        array('banner_id'),
        array('type' => Varien_Db_Adapter_Interface::INDEX_TYPE_INDEX )
    )
    ->addForeignKey(
        $installer->getFkName(
            'icoders_banner/banner',
            'entity_id',
            'icoders_banner/links',
            'banner_id'
        ),
        'banner_id', $installer->getTable('icoders_banner/banner'), 'entity_id',
        Varien_Db_Ddl_Table::ACTION_CASCADE, Varien_Db_Ddl_Table::ACTION_CASCADE
    )
    ->setComment('Banner links');

$installer->getConnection()->createTable($table);

$installer->endSetup();
