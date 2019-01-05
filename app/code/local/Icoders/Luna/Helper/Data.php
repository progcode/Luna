<?php
/**
 * Aion_Nila_Helper_Data
 *
 * @category  Aion
 * @package   Aion_Nila
 * @author    Sági Attila <sagi.attila@aionhill.hu>
 * @copyright 2016 AionNext Kft. (http://www.aionhill.hu)
 * @license   http://aionhill.hu/license Aion License
 * @link      http://www.aionhill.hu
 */

/**
 * Class Aion_Nila_Helper_Data
 */
class Aion_Nila_Helper_Data extends Mage_Core_Helper_Abstract
{
    /**
     * Path to store config if category view all enabled
     *
     * @var string
     */
    const XML_PATH_VIEW_ALL_ENABLED = 'nila/view/category_view_all';

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
