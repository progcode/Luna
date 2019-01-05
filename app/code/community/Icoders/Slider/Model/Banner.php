<?php
/**
 * @category  Icoders
 * @package   Icoders_Slider
 * @author    iCoders <support@icoders.co>
 * @copyright 2014 Icoders (http://icoders.co)
 * @license   http://icoders.co/licence Icoders License
 * @link      http://icoders.co
 */

/**
 * Class Icoders_Slider_Model_Banner
 * @method int getEntityId()
 * @method string getTitle()
 * @method string getStores()
 * @method int getStatus()
 * @method string getPageId()
 * @method string getCategoryId()
 * @method Icoders_Slider_Model_Banner setEntityId($value)
 * @method Icoders_Slider_Model_Banner setTitle($value)
 * @method Icoders_Slider_Model_Banner setStores($value)
 * @method Icoders_Slider_Model_Banner setStatus($value)
 * @method Icoders_Slider_Model_Banner setPageId($value)
 * @method Icoders_Slider_Model_Banner setCategoryId($value)
 */
class Icoders_Slider_Model_Banner extends Mage_Core_Model_Abstract
{
    /** @var string */
    const CACHE_TAG = 'slider';

    /**
     * Constructor
     *
     * @return void
     */
    protected function _construct()
    {
        $this->_init('icoders_slider/banner');
    }

    /**
     * Get banner images
     *
     * @return Icoders_Slider_Model_Resource_Slide_Collection|null
     */
    public function getSlides()
    {
        if ($this->getId()) {
            return Mage::getModel('icoders_slider/slide')->getCollection()
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
