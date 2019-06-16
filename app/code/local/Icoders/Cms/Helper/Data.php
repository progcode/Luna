<?php
/**
 * Icoders_Cms_Helper_Data
 *
 * @category  Icoders
 * @package   Icoders_MobileDetect
 * @author    Kovacs Daniel Akos <kovacs.daniel@icoders.co>
 * @copyright 2016 iCoders Ltd.. (http://www.icoders.co)
 * @license   http://www.magentocommerce.com/license/enterprise-edition GNU General Public License
 * @link      http://www.icoders.co
 *
 */

class Icoders_Cms_Helper_Data extends Mage_Core_Helper_Abstract {

    /**
     * Icoders_Cms_Helper_Data constructor.
     */
    public function __construct()
    {
    }

    /**
     * @return mixed
     */
    public function isInstagramEnabled() {
        return Mage::getStoreConfig('icoders_cms/config/instagram_enabled');
    }

    /**
     * @param $url
     * @return bool|string
     */
    public function getWpUrl($url) {
        $wpDomain = Mage::getStoreConfig('icoders_cms/config/wp_url');

        if($url) {
            return $wpDomain.'/'.$url;
        }

        return false;
    }

    /**
     * @return bool|SimpleXMLElement
     */
    public function getBlogPosts() {
        $wpFeed = Mage::getStoreConfig('icoders_cms/config/wp_feed');

        $rssFeed = simplexml_load_file($wpFeed);
        if($rssFeed)
            return $rssFeed;

        return false;
    }

    /**
     * @return bool|SimpleXMLElement
     */
    public function getInstaPosts() {
        $insta_feed = Mage::getStoreConfig('icoders_cms/config/insta_feed');

        $instaFeed = simplexml_load_file($insta_feed);
        if($instaFeed)
            return $instaFeed;

        return false;
    }

}