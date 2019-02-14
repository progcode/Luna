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
    $content =
        '<div class="col-lg-12">
            <div class="text-center">
                <h1>404</h1>
                <p>Sajnáljuk, de a keresett tartalom nem található. Visszaléphetsz a <a href="{{config path="web/unsecure/base_url"}}">főoldalra</a>, vagy szétnézhetsz ajánlott termékeink között.</p>
            </div>
        </div>
        {{widget type="catalog/product_widget_new" display_type="new_products" products_count="5" template="catalog/product/widget/new/content/new_grid.phtml"}}';

    Mage::getModel('cms/page')
        ->load('no-route', 'identifier')
        ->setData('content', $content)
        ->save();


} catch (Exception $e) {
    Mage::throwException($e->getMessage());
}

$installer->endSetup();
