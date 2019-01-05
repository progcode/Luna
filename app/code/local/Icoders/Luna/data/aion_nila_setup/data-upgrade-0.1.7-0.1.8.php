<?php
/**
 * Aion Nila - Transactional Emails Content
 *
 * @category  Aion
 * @package   Aion_Nila
 * @author    Tóth Attila <attila.toth@aion.hu>
 * @copyright 2002-2016. AionHill (http://www.aionhill.com)
 * @license   http://www.magentocommerce.com/license/enterprise-edition GNU General Public License
 * @link      http://www.aionhill.com
 */

/* @var $installer Mage_Core_Model_Resource_Setup */

$installer = $this;
$installer->startSetup();

try {
	Mage::getConfig()
		->saveConfig("design/email/logo_width",        "")
		->saveConfig("design/email/logo_height",       "")
		->saveConfig("design/email/css_non_inline",    "")
		->saveConfig("design/email/logo",              "default/logo.png")
		->saveConfig("design/email/logo_alt",          "");

} catch (Exception $e) {
	Mage::throwException($e->getMessage());
}

$installer->endSetup();
