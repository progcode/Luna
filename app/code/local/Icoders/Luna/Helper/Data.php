<?php
/**
 * Icoders_Luna_Helper_Data
 *
 * @category  Icoders
 * @package   Icoders_Luna
 * @author    iCoders <support@icoders.co>
 * @copyright 2016 Icoders (http://www.icoders.co)
 * @license   http://icoders.co/license Icoders License
 * @link      http://www.icoders.co
 */

/**
 * Class Icoders_Luna_Helper_Data
 */
class Icoders_Luna_Helper_Data extends Mage_Core_Helper_Abstract
{
    /**
     * Path to store config if category view all enabled
     *
     * @var string
     */
    const XML_PATH_VIEW_ALL_ENABLED = 'luna/view/category_view_all';

    /**
     * Checks whether category view all enabled
     *
     * @param integer|string|Mage_Core_Model_Store $store store
     * @return boolean
     */
    public function isViewAllEnabled($store = null)
    {
        return Mage::getStoreConfigFlag(self::XML_PATH_VIEW_ALL_ENABLED, $store);
    }
}
