<?php
/**
 * Icoders Luna - OneStepCheckout Config
 *
 * @category  Icoders
 * @package   Icoders_Luna
 * @author    Toth Attila <toth.attila@icoders.co>
 * @copyright 2002-2016. Icoders (http://www.icoders.co)
 * @license   http://www.magentocommerce.com/license/enterprise-edition GNU General Public License
 * @link      http://www.icoders.co
 */

/* @var $installer Mage_Core_Model_Resource_Setup */
$installer = $this;
$installer->startSetup();

try {
    $installer->setConfigData('onestepcheckout/general/rewrite_checkout_links', 1);

    $installer->setConfigData('onestepcheckout/general/checkout_title', 'Pénztár');
    $installer->setConfigData('onestepcheckout/general/checkout_description', 'Üdvözöljük a pénztár oldalon. A vásárlás befejezéséhez töltse ki az alábbi mezőket.');
    $installer->setConfigData('onestepcheckout/general/show_custom_options', 1);

    $installer->setConfigData('onestepcheckout/sortordering_fields/firstname', 2);
    $installer->setConfigData('onestepcheckout/sortordering_fields/lastname', 1);
    $installer->setConfigData('onestepcheckout/sortordering_fields/email', 3);
    $installer->setConfigData('onestepcheckout/sortordering_fields/telephone', 12);
    $installer->setConfigData('onestepcheckout/sortordering_fields/street', 8);
    $installer->setConfigData('onestepcheckout/sortordering_fields/country_id', 9);
    $installer->setConfigData('onestepcheckout/sortordering_fields/region_id', 11);
    $installer->setConfigData('onestepcheckout/sortordering_fields/city', 7);
    $installer->setConfigData('onestepcheckout/sortordering_fields/postcode', 10);
    $installer->setConfigData('onestepcheckout/sortordering_fields/company', 14);
    $installer->setConfigData('onestepcheckout/sortordering_fields/fax', 13);
    $installer->setConfigData('onestepcheckout/sortordering_fields/taxvat', 15);
    $installer->setConfigData('onestepcheckout/sortordering_fields/dob', 16);
    $installer->setConfigData('onestepcheckout/sortordering_fields/gender', 17);
    $installer->setConfigData('onestepcheckout/sortordering_fields/create_account', 4);
    $installer->setConfigData('onestepcheckout/sortordering_fields/password', 5);
    $installer->setConfigData('onestepcheckout/sortordering_fields/confirm_password', 6);
    $installer->setConfigData('onestepcheckout/sortordering_fields/save_in_address_book', 18);

    $identifier = '\'footer_links_sm\'';
    $staticBlock = Mage::getModel('cms/block')
        ->load($identifier, 'identifier');

    if ($staticBlock->isObjectNew()) {
        $staticBlock
            ->setIdentifier($identifier)
            ->setStores(array(0))
            ->setIsActive(true)
            ->setTitle('Footer Links SM');
    }

    $content = '
        <div class="footer-col footer-col1 col-lg-3 col-md-3 col-sm-6 col-xs-12">
            <div class="footer-header">Menu (1)</div>
            <ul>
                <li><a href="/luna-cms-page">Example Page (1)</a></li>
                <li><a href="/luna-cms-page">Example Page (2)</a></li>
                <li><a href="/luna-cms-page">Example Page (3)</a></li>
                <li><a href="/luna-cms-page">Example Page (4)</a></li>
            </ul>
        </div>

        <div class="footer-col footer-col2 col-lg-3 col-md-3 col-sm-6 col-xs-12">
            <div class="footer-header">Menu (2)</div>
            <ul>
                <li><a href="/luna-cms-page">Luna CMS Page</a></li>
                <li><a href="/luna-cms-page">Luna CMS Page</a></li>
                <li><a href="/luna-cms-page">Luna CMS Page</a></li>
                <li><a href="/luna-cms-page">Luna CMS Page</a></li>
            </ul>
        </div>

        <div class="footer-col footer-col3 col-lg-3 col-md-3 col-sm-6 col-xs-12">
            <div class="footer-header">Menu (3)</div>
            <ul>
                <li><a href="/luna-cms-page">Luna CMS Page</a></li>
                <li><a href="/luna-cms-page">Luna CMS Page</a></li>
                <li><a href="/luna-cms-page">Luna CMS Page</a></li>
                <li><a href="/luna-cms-page">Luna CMS Page</a></li>
            </ul>
        </div>

        <div class="footer-col footer-col4 col-lg-3 col-md-3 col-sm-6 col-xs-12">
            <div class="footer-header">Menu (4)</div>
            <ul>
                <li>
                    <a title="Your Social Page Name - Facebook" href="https://www.facebook.com/your_social_page_name" target="_blank" rel="noopener">
                        <i class="fa fa-facebook-f"></i>
                        <span class="hidden-xs hidden-sm">Facebook</span>
                    </a>
                </li>
                <li>
                    <a title="Your Social Page Name - Twitter" href="https://twitter.com/your_social_page_name" target="_blank" rel="noopener">
                        <i class="fa fa-twitter"></i>
                        <span class="hidden-xs hidden-sm">Twitter</span>
                    </a>
                </li>
                <li>
                    <a title="Your Social Page Name - Youtube" href="https://youtube.com/channel/your_social_page_name" target="_blank" rel="noopener">
                        <i class="fa fa-youtube-play"></i>
                        <span class="hidden-xs hidden-sm">Youtube</span>
                    </a>
                </li>
                <li>
                    <a title="Your Social Page Name - Pinterest" href="https://www.pinterest.com/your_social_page_name/" target="_blank" rel="noopener">
                        <i class="fa fa-pinterest"></i>
                        <span class="hidden-xs hidden-sm">Pinterest</span>
                    </a>
                </li>

                <li>
                    <a title="RSS Feed" href="#" target="_blank" rel="noopener">
                        <i class="fa fa-rss"></i>
                        <span class="hidden-xs hidden-sm">RSS</span>
                    </a>
                </li>
            </ul>
        </div>';

    $staticBlock
        ->setContent($content)
        ->save();

} catch (Exception $e) {
    Mage::throwException($e->getMessage());
}

$installer->endSetup();

