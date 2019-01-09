<?php
/**
 * Icoders Luna - Homepage small banners
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

    $identifier = 'demo-homepage-small-banners';
    $staticBlock = Mage::getModel('cms/block')
        ->load($identifier, 'identifier');

    if ($staticBlock->isObjectNew()) {
        $staticBlock
            ->setIdentifier($identifier)
            ->setStores(array(0))
            ->setIsActive(true)
            ->setTitle('Demo Homepage Small Banners');
    }

    $staticBlock
        ->setContent('1Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed faucibus mollis cursus. Aenean odio est, facilisis id lacus non, ullamcorper ornare est. Sed vitae eleifend augue. Aliquam ut pharetra quam. Integer non enim eget justo eleifend viverra. Duis tempor laoreet augue in porttitor. Ut eu est at enim consequat tempor id non ante.')
        ->save();

} catch (Exception $e) {
    Mage::throwException($e->getMessage());
}

$installer->endSetup();