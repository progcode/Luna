<?php
/**
 * Icoders Luna - Homepage Content
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
    $identifier = 'home';
    $staticBlock = Mage::getModel('cms/page')
        ->load($identifier, 'identifier');

    if ($staticBlock->isObjectNew()) {
        $staticBlock
            ->setIdentifier($identifier)
            ->setStores(array(0))
            ->setIsActive(true)
            ->setTitle('Demo Homepage');
    }

    $content = '{{widget type="catalog/product_widget_new" display_type="new_products" products_count="5" template="catalog/product/widget/new/content/new_grid.phtml"}}';

    $staticBlock
        ->setContent($content)
        ->save();

} catch (Exception $e) {
    Mage::throwException($e->getMessage());
}

$installer->endSetup();