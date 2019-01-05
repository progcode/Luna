<?php
/**
 * Aion Nila
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

    /* SYSTEM / CONFIGURATION / GENERAL / DESIGN */
    $installer->setConfigData('design/package/name','nila');
    $installer->setConfigData('design/theme/locale','nila2');
    $installer->setConfigData('design/theme/template','nila2');
    $installer->setConfigData('design/theme/skin','nila2');
    $installer->setConfigData('design/theme/layout','nila2');
    $installer->setConfigData('design/theme/default','nila2');

} catch (Exception $e) {
    Mage::throwException($e->getMessage());
}

$installer->endSetup();

