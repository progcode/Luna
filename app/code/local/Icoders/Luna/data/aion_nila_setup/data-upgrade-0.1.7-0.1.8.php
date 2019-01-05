<?php
/**
 * Icoders Luna - Transactional Emails Content
 *
 * @category  Icoders
 * @package   Icoders_Luna
 * @author    iCoders <support@icoders.co>
 * @copyright 2002-2016. Icoders (http://www.icoders.co)
 * @license   http://www.magentocommerce.com/license/enterprise-edition GNU General Public License
 * @link      http://www.icoders.co
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
