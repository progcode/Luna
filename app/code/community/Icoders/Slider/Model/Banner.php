<?php
/**
 * @category  Aion
 * @package   Aion_Rbanner
 * @author    Dombi István <istvan.dombi@aionhill.com>
 * @copyright 2014 AionNext Kft. (http://aionhill.com)
 * @license   http://aionhill.com/licence Aion License
 * @link      http://aionhill.com
 */

/**
 * Class Aion_Rbanner_Model_Banner
 * @method int getEntityId()
 * @method string getTitle()
 * @method string getStores()
 * @method int getStatus()
 * @method string getPageId()
 * @method string getCategoryId()
 * @method Aion_Rbanner_Model_Banner setEntityId($value)
 * @method Aion_Rbanner_Model_Banner setTitle($value)
 * @method Aion_Rbanner_Model_Banner setStores($value)
 * @method Aion_Rbanner_Model_Banner setStatus($value)
 * @method Aion_Rbanner_Model_Banner setPageId($value)
 * @method Aion_Rbanner_Model_Banner setCategoryId($value)
 */
class Aion_Rbanner_Model_Banner extends Mage_Core_Model_Abstract
{
    /** @var string */
    const CACHE_TAG = 'rbanner';

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
     * Get banner images
     *
     * @return Aion_Rbanner_Model_Resource_Slide_Collection|null
     */
    public function getSlides()
    {
        if ($this->getId()) {
            return Mage::getModel('aion_rbanner/slide')->getCollection()
                ->addFieldToFilter('banner_id', $this->getId())
                ->setOrder('position', 'asc');
        }
        return null;
    }

    /**
     * Delete slides
     *
     * @return Mage_Core_Model_Abstract
     */
    protected function _beforeDelete()
    {
        $slides = $this->getSlides();
        foreach ($slides as $slide) {
            $slide->delete();
        }
        return parent::_beforeDelete();
    }
}
