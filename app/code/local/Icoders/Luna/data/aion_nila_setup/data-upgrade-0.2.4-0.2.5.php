<?php
/**
 * Aion Nila - Homepage small banners
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

    $content = '<div class="aion-small-banners">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <div class="small-banner banner-first banner-yellow">
                <a href="{{config path="web/secure/base_url"}}" title="Home & Decor">
                Homewear
                </a>
                <div class="clearfix hidden-md hidden-lg"></div>
                <p>
                   Comfy and trendy
                </p>
                <div class="clearfix"></div>
            </div>
        </div>
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <div class="small-banner banner-second banner-green">
                <a href="{{config path="web/secure/base_url"}}" title="Home & Decor">
                Sunglasses
                </a>
                <div class="clearfix hidden-md hidden-lg"></div>
                <p>
                    See in the light
                </p>
                <div class="clearfix"></div>
            </div>
        </div>
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <div class="small-banner banner-third banner-purple">
                <a href="{{config path="web/secure/base_url"}}" title="Home & Decor">
                Skirts again
                </a>
                <div class="clearfix hidden-md hidden-lg"></div>
                <p>
                   A new wave
                </p>
                <div class="clearfix"></div>
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