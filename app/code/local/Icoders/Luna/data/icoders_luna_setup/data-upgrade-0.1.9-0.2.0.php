<?php
/**
 * Icoders Luna - Default category layout
 *
 * @category  Icoders
 * @package   Icoders_Luna
 * @author    Kovacs Daniel Akos <kovacs.daniel@icoders.co>
 * @copyright 2002-2016. Icoders (http://www.icoders.co)
 * @license   http://www.magentocommerce.com/license/enterprise-edition GNU General Public License
 * @link      http://www.icoders.co
 */

/* @var $installer Mage_Core_Model_Resource_Setup */

$installer = $this;
$installer->startSetup();
$currentStore = Mage::app()->getStore()->getId();
Mage::app()->getStore()->setId(Mage_Core_Model_App::ADMIN_STORE_ID);

try {
    $categories = Mage::getModel('catalog/category')->getCollection();

    foreach ($categories as $cat) {
        $parent = Mage::getModel("catalog/category")->load($cat->getId());
        $parent->setPageLayout("");
        $parent->save();
    }
} catch (Exception $e) {
    Mage::throwException($e->getMessage());
}

$installer->endSetup();

