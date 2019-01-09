<?php
/**
 * Icoders Magento Basic Settings
 *
 * @category  Icoders
 * @package   Icoders_Luna
 * @copyright 2002-2016. Icoders (http://www.icoders.co)
 * @license   http://www.magentocommerce.com/license/enterprise-edition GNU General Public License
 * @link      http://www.icoders.co
 */
/* @var $installer Mage_Core_Model_Resource_Setup */

$this->startSetup();

$identifier = 'icoders-icon-banners';
$title = 'Icoders Icon Banners';
$contentCmsBlock = <<<EOT
<div class="icoders-icon-banners">
        <div class="icon-banner col-xs-12 col-md-4">
            <div class="icon-banner-icon">
                <i class="icoders-icon icoders-icon-badge-freedelivery"></i>
            </div>
            <div class="icon-banner-text">
                <a href="{{config path="web/secure/base_url"}}" title="Trusted Delivery">
                    Trusted Delivery
                </a>
                <div>
                   For orders above 90,00 EUR
                </div>
            </div>
        </div>
        <div class="icon-banner col-xs-12 col-md-4">
            <div class="icon-banner-icon">
                <i class="icoders-icon icoders-icon-badge-hotline"></i>
            </div>
            <div class="icon-banner-text">
                <a href="{{config path="web/secure/base_url"}}" title="Trusted Service">
                    Trusted Service
                </a>
                <div>
                   Hotline and online service
                </div>
            </div>
        </div>
        <div class="icon-banner col-xs-12 col-md-4">
            <div class="icon-banner-icon">
                <i class="icoders-icon icoders-icon-badge-moneyback"></i>
            </div>
            <div class="icon-banner-text">
                <a href="{{config path="web/secure/base_url"}}" title="Trusted Payment">
                    Trusted Payment
                </a>
                <div>
                   14 day money back guarantee
                </div>
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
        ->setTitle($title)
        ->setStores(0)
        ->setIsActive(true);
}
$cmsBlock->save();
$this->endSetup();