<?php
/**
 * Icoders Luna
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

    /* SYSTEM / CONFIGURATION / GENERAL / DESIGN */
    $installer->setConfigData('design/package/name','luna');
    $installer->setConfigData('design/theme/locale','luna');
    $installer->setConfigData('design/theme/template','luna');
    $installer->setConfigData('design/theme/skin','luna');
    $installer->setConfigData('design/theme/layout','luna');
    $installer->setConfigData('design/theme/default','luna');

} catch (Exception $e) {
    Mage::throwException($e->getMessage());
}

$installer->endSetup();

