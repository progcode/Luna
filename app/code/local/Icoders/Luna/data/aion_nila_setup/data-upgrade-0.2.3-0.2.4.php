<?php
/**
 * Aion Magento Basic Settings
 *
 * @category  Aion
 * @package   Aion_Nila
 * @copyright 2002-2016. AionHill (http://www.aionhill.com)
 * @license   http://www.magentocommerce.com/license/enterprise-edition GNU General Public License
 * @link      http://www.aionhill.com
 */
/* @var $installer Mage_Core_Model_Resource_Setup */

$this->startSetup();

$identifier = 'Nila-homepage-small-banners';
$contentCmsBlock = <<<EOT
<div class="row aion-promotional-banners">
        <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
            <div class="small-banner banner-first banner-yellow text-center">
                <a href="{{config path="web/secure/base_url"}}" title="Home & Decor">
                New Shoe Collection
                </a>
                <div class="clearfix hidden-md hidden-lg"></div>
                <p>
                   Brand New for summer
                </p>
            </div>
        </div>
        <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
            <div class="small-banner banner-second banner-green text-center">
                <a href="{{config path="web/secure/base_url"}}" title="Home & Decor">
                Limited handbags
                </a>
                <div class="clearfix hidden-md hidden-lg"></div>
                <p>
                    With great designs from Italy
                </p>
            </div>
        </div>
        <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
            <div class="small-banner banner-third banner-purple text-center">
                <a href="{{config path="web/secure/base_url"}}" title="Home & Decor">
                Womens beachwear
                </a>
                <div class="clearfix hidden-md hidden-lg"></div>
                <p>
                    Bring fashion to the sea
                </p>
            </div>
        </div>
    </div>
EOT;
$cmsBlock = Mage::getModel('cms/block')->load($identifier);
if ($cmsBlock->isObjectNew()) {
    $cmsBlock->setTitle($title)
        ->setContent($contentCmsBlock)
        ->setIdentifier($identifier)
        ->setStores(0)
        ->setIsActive(true);
} else {
    $cmsBlock->setContent($contentCmsBlock)
        ->setStores(0)
        ->setIsActive(true);
}
$cmsBlock->save();
$this->endSetup();