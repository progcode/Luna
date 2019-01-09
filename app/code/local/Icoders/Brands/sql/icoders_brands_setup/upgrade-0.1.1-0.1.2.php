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
        'type'              => 'varchar',
        'label'             => 'Brand logo',
        'note'              => 'Upload brand logo',
        'input'             => 'image',
        'global'            => Mage_Catalog_Model_Resource_Eav_Attribute::SCOPE_STORE,
        'backend'           => 'catalog/category_attribute_backend_image',
        'required'          => false,
        'visible'           => true,
        'visible_on_front'  => true,
        'user_defined'      => true,
        'group'             => 'General Information'
    );
    $installer->addAttribute('catalog_category', 'brand_logo', $attribute);

} catch (Exception $e) {
    Mage::throwException($e->getMessage());
}

$installer->endSetup();
