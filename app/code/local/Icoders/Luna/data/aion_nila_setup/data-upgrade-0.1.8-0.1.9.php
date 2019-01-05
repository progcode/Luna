<?php
/**
 * Icoders Luna - Disable Swatches on category list page
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

try {
    $installer->setConfigData('configswatches/general/product_list_attribute', '');
} catch (Exception $e) {
    Mage::throwException($e->getMessage());
}

$installer->endSetup();
