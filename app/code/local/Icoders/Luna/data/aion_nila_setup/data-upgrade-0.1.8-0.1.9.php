<?php
/**
 * Aion Nila - Disable Swatches on category list page
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

try {
    $installer->setConfigData('configswatches/general/product_list_attribute', '');
} catch (Exception $e) {
    Mage::throwException($e->getMessage());
}

$installer->endSetup();
