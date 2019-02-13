<?php
/**
 * app/code/community/Icoders/Banner/Model/Resource/Banner/Collection.php
 *
 * @category  Icoders
 * @package   Icoders_Banner
 * @author    iCoders <support@icoders.co>
 * @copyright 2016 Icoders (http://www.icoders.co)
 * @license   http://icoders.co/license Icoders License
 * @link      http://www.icoders.co
 */

/**
 * Class Icoders_Banner_Model_Resource_Banner_Collection
 */
class Icoders_Banner_Model_Resource_Banner_Collection extends Mage_Core_Model_Resource_Db_Collection_Abstract
{
    /**
     * Constructor
     *
     * @return void
     */
    protected function _construct()
    {
        $this->_init('icoders_banner/banner');
    }

    /**
     * Add enabled filter
     *
     * @return Mage_Eav_Model_Entity_Collection_Abstract
     */
    public function addEnabledFilter()
    {
        return $this->addFieldToFilter('status', 1);
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
     * Page filter
     *
     * @param int $page page id
     *
     * @return $this
     */
    public function addPageFilter($page)
    {
        $this->getSelect()->where('FIND_IN_SET(' . $page . ',main_table.page_id) or FIND_IN_SET(9999999,main_table.page_id)');
        return $this;
    }

    /**
     * Position filter
     *
     * @param int $position position
     *
     * @return $this
     */
    public function addPositionFilter($position)
    {
        $this->getSelect()->where('main_table.position = ?', $position);
        return $this;
    }

    /**
     * Category filter
     *
     * @param int $category category id
     *
     * @return $this
     */
    public function addCategoryFilter($category)
    {
        $this->getSelect()->where('FIND_IN_SET(' . $category . ',main_table.category_id)');
        return $this;
    }

}