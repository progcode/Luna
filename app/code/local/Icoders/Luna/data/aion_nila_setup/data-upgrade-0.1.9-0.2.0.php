<?php
/**
 * Aion Nila - Default category layout
 *
 * @category  Aion
 * @package   Aion_Nila
 * @author    Kovacs Daniel Akos <kovacs.daniel@aion.hu>
 * @copyright 2002-2016. AionHill (http://www.aionhill.com)
 * @license   http://www.magentocommerce.com/license/enterprise-edition GNU General Public License
 * @link      http://www.aionhill.com
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

