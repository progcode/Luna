<?php
/**
 * Icoders Luna - CMS Menu
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
    $content =
        '<div class="icoders-cms-menu">
			  <ul class="menu">
                    <li class="menu-item"><a href="{{store url="demo-cms-oldal"}}">Luna CMS Page</a></li>
					<li class="menu-item"><a href="{{store url="about-magento-demo-store"}}">About Us</a></li>
					<li class="menu-item"><a href="{{store url="contacts"}}">Contact us</a></li>
					<li class="menu-item"><a href="{{store url="customer-service"}}">Customer Service</a></li>
					<li class="menu-item"><a href="{{store url="privacy-policy-cookie-restriction-mode"}}">Privacy Policy</a></li>
			  </ul>
		</div>';

    Mage::getModel('cms/block')
        ->load('cms_menu', 'identifier')
        ->setData('content', $content)
        ->save();

} catch (Exception $e) {
    Mage::throwException($e->getMessage());
}

$installer->endSetup();
