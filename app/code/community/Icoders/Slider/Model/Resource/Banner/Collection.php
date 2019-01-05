<?php
/**
 * @category  Aion
 * @package   Aion_Rbanner
 * @author    Dombi István <istvan.dombi@aionhill.com>
 * @copyright 2017 AionNext Kft. (http://aionhill.com)
 * @license   http://aionhill.com/licence Aion License
 * @link      http://aionhill.com
 */

/**
 * Class Aion_Rbanner_Model_Resource_Banner_Collection
 */
class Aion_Rbanner_Model_Resource_Banner_Collection extends Mage_Core_Model_Resource_Db_Collection_Abstract
{
    const STATUS_ENABLED = 1;
    const STATUS_DISABLED = 0;

    /**
     * Constructor
     *
     * @return void
     */
    protected function _construct()
    {
        $this->_init('aion_rbanner/banner');
    }

    /**
     * Add enabled filter
     *
     * @return Mage_Eav_Model_Entity_Collection_Abstract
     */
    public function addEnabledFilter()
    {
        return $this->addFieldToFilter('status', self::STATUS_ENABLED);
    }

    /**
     * Store filter
     *
     * @param int $store store id
     *
     * @return $this
     */
    public function addStoreFilter($store)
    {
        if (!Mage::app()->isSingleStoreMode()) {
            $this->getSelect()->where('(FIND_IN_SET(' . $store . ',main_table.stores) or main_table.stores in (0))');
            return $this;
        }
        return $this;
    }

    /**
     * Return [value=>title] formatted array
     *
     * @return array
     */
    public function toOptionArray()
    {
        $ret = [];
        foreach ($this as $banner) {
            $ret[$banner->getId()] = $banner->getTitle();
        }

        return $ret;
    }
}
