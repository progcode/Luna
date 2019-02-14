<?php
/**
 * Icoders Luna
 *
 * @category  Icoders
 * @package   Icoders_Luna
 * @author    Kovacs Daniel Akos <kovacs.daniel@icoders.co>
 * @copyright 2019. Icoders (http://www.icoders.co)
 * @license   http://www.magentocommerce.com/license/enterprise-edition GNU General Public License
 * @link      http://www.icoders.co
 */

/* @var $installer Mage_Core_Model_Resource_Setup */

$installer = $this;
$installer->startSetup();

try {

    $installer->setConfigData('general/country/default','HU');
    $installer->setConfigData('general/locale/timezone','Europe/Budapest');
    $installer->setConfigData('general/locale/code','hu_HU');
    $installer->setConfigData('general/store_information/merchant_country','HU');
    $installer->setConfigData('general/store_information/phone','0611234567');
    $installer->setConfigData('general/general/store_information/address','1036 Budapest, Lajos utca 48-66');
    $installer->setConfigData('shipping/origin/country_id','HU');
    $installer->setConfigData('shipping/origin/postcode','1036');
    $installer->setConfigData('shipping/origin/city','Budapest');
    $installer->setConfigData('shipping/origin/street_line1','1036 Budapest, Lajos utca 48-66');
    $installer->setConfigData('design/header/welcome','Üdvözöljük webshopunkban!');

} catch (Exception $e) {
    Mage::throwException($e->getMessage());
}

$installer->endSetup();