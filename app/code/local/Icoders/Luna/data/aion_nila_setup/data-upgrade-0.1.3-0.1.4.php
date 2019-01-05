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
    $identifier = 'default-homepage-small-banners';
    $staticBlock = Mage::getModel('cms/block')
        ->load($identifier, 'identifier');

    if ($staticBlock->isObjectNew()) {
        $staticBlock
            ->setIdentifier($identifier)
            ->setStores(array(0))
            ->setIsActive(true)
            ->setTitle('Default Homepage Small Banners');
    }

    $content = '<div class="row aion-small-banners">
        <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
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
        <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
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
        <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
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