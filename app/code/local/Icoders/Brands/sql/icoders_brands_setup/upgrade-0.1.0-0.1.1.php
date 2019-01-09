<?php
/**
 * AION Brands
 *
 * @category  Icoders
 * @package   Icoders_Brands
 * @copyright 2002-2016. Icoders (http://www.icoders.co)
 * @license   http://www.magentocommerce.com/license/enterprise-edition GNU General Public License
 * @link      http://www.icoders.co
 */

/* @var $installer Mage_Eav_Model_Entity_Setup */

$installer = $this;
$installer->startSetup();

try {

    $attribute  = array(
        'type'              => 'int',
        'label'             => 'Is Featured Brand',
        'input'             => 'select',
        'global'            => Mage_Catalog_Model_Resource_Eav_Attribute::SCOPE_GLOBAL,
        'default'           => array(0),
        'source'            => 'eav/entity_attribute_source_boolean',
        'visible'           => true,
        'visible_on_front'  => true,
        'required'          => false,
        'user_defined'      => true,
        'group'             => "General Information"
    );
    $installer->addAttribute('catalog_category', 'is_featured_brand', $attribute);

} catch (Exception $e) {
    Mage::throwException($e->getMessage());
}

$installer->endSetup();
