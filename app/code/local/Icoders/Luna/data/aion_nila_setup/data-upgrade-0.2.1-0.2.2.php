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

    $content = '<div class="icoders-small-banners">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <div class="small-banner banner-yellow text-center">
                <a href="{{config path="web/secure/base_url"}}" title="Home & Decor">
                Home & Decor
                </a>
                <div class="clearfix hidden-md hidden-lg"></div>
                <p>
                    Lorem ipsum si amet ipsum
                </p>
            </div>
        </div>
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <div class="small-banner banner-green text-center">
                <a href="{{config path="web/secure/base_url"}}" title="Home & Decor">
                Home & Decor
                </a>
                <div class="clearfix hidden-md hidden-lg"></div>
                <p>
                    Lorem ipsum si amet ipsum
                </p>
            </div>
        </div>
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <div class="small-banner banner-purple text-center">
                <a href="{{config path="web/secure/base_url"}}" title="Home & Decor">
                Home & Decor
                </a>
                <div class="clearfix hidden-md hidden-lg"></div>
                <p>
                    Lorem ipsum si amet ipsum
                </p>
            </div>
        </div>
    </div>';

    $staticBlock
        ->setContent($content)
        ->save();

} catch (Exception $e) {
    Mage::throwException($e->getMessage());
}

$installer->endSetup();