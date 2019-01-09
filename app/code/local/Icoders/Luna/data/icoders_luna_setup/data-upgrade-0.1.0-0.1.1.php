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

$installer = $this;

$installer->startSetup();

/* SYSTEM / CONFIGURATION / GENERAL / GENERAL */
$installer->setConfigData('general/country/default','US');
$installer->setConfigData('general/locale/timezone','America/Los_Angeles');
$installer->setConfigData('general/locale/code','en_US');
$installer->setConfigData('general/locale/firstday', '1');
$installer->setConfigData('general/store_information/name','Luna Shop');
$installer->setConfigData('general/store_information/phone','479-769-5800');
$installer->setConfigData('general/store_information/hours','9-17.30');
$installer->setConfigData('general/store_information/merchant_country','US');
$installer->setConfigData('general/store_information/merchant_vat_number','');
$installer->setConfigData('general/general/store_information/address','Fort Smith, AR 72901 - 2542 Cambridge Court');

/* SYSTEM / CONFIGURATION / GENERAL / WEB */
$installer->setConfigData('web/seo/use_rewrites', '1');
$installer->setConfigData('web/default/show_cms_breadcrumbs','0');

/* SYSTEM / CONFIGURATION / GENERAL / DESIGN */
$installer->setConfigData('design/package/name','luna');
$installer->setConfigData('design/theme/locale','default');
$installer->setConfigData('design/theme/template','default');
$installer->setConfigData('design/theme/skin','default');
$installer->setConfigData('design/theme/layout','default');
$installer->setConfigData('design/theme/default','default');
$installer->setConfigData('design/head/default_title', 'Luna Shop');
$installer->setConfigData('design/head/title_prefix','');
$installer->setConfigData('design/head/title_suffix','');
$installer->setConfigData('design/head/default_description','Luna Shop');
$installer->setConfigData('design/head/default_keywords','Luna Shop');
$installer->setConfigData('design/head/default_robots','NOINDEX,NOFOLLOW');
$installer->setConfigData('design/head/demonotice','1');
$installer->setConfigData('design/head/shortcut_icon','luna/favicon.png');
$installer->setConfigData('design/header/logo_src','img/logo.png');
$installer->setConfigData('design/header/logo_alt','Luna Shop');
$installer->setConfigData('design/header/logo_src_small','img/logo-small.png');
$installer->setConfigData('design/header/welcome','Welcome to Our store!');
$installer->setConfigData('design/footer/copyright','2016. Luna Shop');

/* SYSTEM / CONFIGURATION / GENERAL / CURRENCY SETUP */
$installer->setConfigData('currency/options/base','USD');
$installer->setConfigData('currency/options/default','USD');
$installer->setConfigData('currency/options/allow','USD');

/* SYSTEM / CONFIGURATION / GENERAL / STORE EMAIL ADDRESSES */
$installer->setConfigData('trans_email/ident_general/name','Luna Shop');
$installer->setConfigData('trans_email/ident_general/email','luna@luna.luna');
$installer->setConfigData('trans_email/ident_sales/name','Luna Shop');
$installer->setConfigData('trans_email/ident_sales/email','luna@luna.luna');
$installer->setConfigData('trans_email/ident_support/name','Luna Shop');
$installer->setConfigData('trans_email/ident_support/email','luna@luna.luna');
$installer->setConfigData('trans_email/ident_custom1/name','Luna Shop');
$installer->setConfigData('trans_email/ident_custom1/email','luna@luna.luna');
$installer->setConfigData('trans_email/ident_custom2/name','Luna Shop');
$installer->setConfigData('trans_email/ident_custom2/email','luna@luna.luna');

/* SYSTEM / CONFIGURATION / GENERAL / CONTACTS */

/* SYSTEM / CONFIGURATION / GENERAL / REPORTS */

/* SYSTEM / CONFIGURATION / GENERAL / CONTENT MANAGEMENT */
$installer->setConfigData('cms/wysiwyg/enabled','hidden');

/* SYSTEM / CONFIGURATION / CATALOG */
$installer->setConfigData('catalog/frontend/list_mode','grid-list');
$installer->setConfigData('catalog/frontend/grid_per_page_values','12,24,36');
$installer->setConfigData('catalog/frontend/grid_per_page','24');
$installer->setConfigData('catalog/frontend/list_per_page_values','15,30,45');
$installer->setConfigData('catalog/frontend/list_per_page','30');
$installer->setConfigData('catalog/frontend/list_allow_all','0');
$installer->setConfigData('catalog/frontend/default_sort_by','name');
$installer->setConfigData('catalog/frontend/flat_catalog_category','1');
$installer->setConfigData('catalog/frontend/flat_catalog_product','1');
$installer->setConfigData('catalog/review/allow_guest','0');
$installer->setConfigData('catalog/price/scope',1);
$installer->setConfigData('catalog/navigation/max_depth', '2');
$installer->setConfigData('catalog/seo/product_url_suffix','');
$installer->setConfigData('catalog/seo/category_url_suffix','/');
$installer->setConfigData('catalog/seo/product_use_categories',0);
$installer->setConfigData('cataloginventory/item_options/max_sale_qty','10');
$installer->setConfigData('rss/config/active',1);
$installer->setConfigData('rss/catalog/category',1);

/* SYSTEM / CONFIGURATION / CUSTOMERS */
$installer->setConfigData('newsletter/subscription/un_email_identity','general');
$installer->setConfigData('newsletter/subscription/success_email_identity','general');
$installer->setConfigData('newsletter/subscription/confirm_email_identity','general');
$installer->setConfigData('customer/address/street_lines','1');

/* SYSTEM / CONFIGURATION / SALES */
$installer->setConfigData('sales/reorder/allow','1');
$installer->setConfigData('sales_email/order/identity','general');
$installer->setConfigData('sales_email/order_comment/identity','general');
$installer->setConfigData('sales_email/invoice/identity','general');
$installer->setConfigData('sales_email/invoice_comment/identity','general');
$installer->setConfigData('sales_email/shipment/identity','general');
$installer->setConfigData('sales_email/shipment_comment/identity','general');
$installer->setConfigData('sales_email/creditmemo/identity','general');
$installer->setConfigData('sales_email/creditmemo_comment/identity','general');
$installer->setConfigData('checkout/options/enable_agreements','1');
$installer->setConfigData('shipping/option/checkout_multiple','0');
$installer->setConfigData('shipping/origin/country_id','US');
$installer->setConfigData('shipping/origin/postcode','72901');
$installer->setConfigData('shipping/origin/city','AR');
$installer->setConfigData('shipping/origin/street_line1','Fort Smith - 2542 Cambridge Court');
$installer->setConfigData('carriers/freeshipping/active','1');
$installer->setConfigData('carriers/freeshipping/title','Free shipping');
$installer->setConfigData('carriers/freeshipping/name','Free shipping');
$installer->setConfigData('carriers/freeshipping/free_shipping_subtotal','20000');
$installer->setConfigData('carriers/freeshipping/specificerrmsg','Currently not available!');
$installer->setConfigData('carriers/freeshipping/sallowspecific','1');
$installer->setConfigData('carriers/freeshipping/specificcountry','US');
$installer->setConfigData('carriers/freeshipping/showmethod','0');
$installer->setConfigData('carriers/freeshipping/sort_order','10');
$installer->setConfigData('carriers/flatrate/active','1');
$installer->setConfigData('carriers/flatrate/title','Home delivery');
$installer->setConfigData('carriers/flatrate/name','Home delivery');
$installer->setConfigData('carriers/flatrate/type','0');
$installer->setConfigData('carriers/flatrate/price','999');
$installer->setConfigData('carriers/flatrate/handling_type','F');
$installer->setConfigData('carriers/flatrate/handling_fee','0');
$installer->setConfigData('carriers/flatrate/specificerrmsg','Currently not available!');
$installer->setConfigData('carriers/flatrate/sallowspecific','1');
$installer->setConfigData('carriers/flatrate/specificcountry','US');
$installer->setConfigData('carriers/flatrate/showmethod','0');
$installer->setConfigData('carriers/flatrate/sort_order','10');

/* SYSTEM / CONFIGURATION / ADVANCED */
$installer->setConfigData('advanced/modules_disable_output/Mage_AdminNotification','1');
$installer->setConfigData('advanced/modules_disable_output/Mage_GoogleCheckout','1');
$installer->setConfigData('advanced/modules_disable_output/Mage_Paypal','1');
$installer->setConfigData('advanced/modules_disable_output/Mage_PaypalUk','1');
$installer->setConfigData('advanced/modules_disable_output/Mage_Poll','1');
$installer->setConfigData('advanced/modules_disable_output/Mage_Tag','1');
$installer->setConfigData('advanced/modules_disable_output/Phoenix_Moneybookers','1');

$installer->endSetup();
