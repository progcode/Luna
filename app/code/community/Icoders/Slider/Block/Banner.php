<?php

/**
 * Icoders_Slider_Block_Banner
 *
 * @category  Icoders
 * @package   Icoders_Slider
 * @author    iCoders <support@icoders.co>
 * @copyright 2013 Icoders (http://icoders.co)
 * @license   Icoders License http://icoders.co/licence
 * @link      http://www.icoders.co
 */
class Icoders_Slider_Block_Banner extends Mage_Core_Block_Template
{
    /**
     * Construct
     *
     * @return void
     */
    protected function _construct()
    {
        parent::_construct();
        $this->addData(
            array(
                'cache_lifetime' => 120,
                'cache_tags'     => array(Icoders_Slider_Model_Banner::CACHE_TAG),
                'cache_key'      => 'AIONRBANNER_STORE_' .
                    Mage::app()->getStore()->getId() .
                    '_ID_' . $this->getRequest()->getRequestUri()
            )
        );
    }

    /**
     * Get banner
     *
     * @param int|string $identifier banner id or title
     *
     * @return Icoders_Slider_Model_Banner
     * @throws Exception
     */
    public function getBanner($identifier = null)
    {
        if (is_null($identifier) && !($position = $this->getPosition())) {
            $identifier = $this->getData('banner_id');
            $e = Mage::exception('Icoders_Slider', Mage::helper('icoders_slider')->__('The banner has not been specified'));
            Mage::throwException($e);
        }

        $position = $this->getPosition();

        $constant = "Icoders_Slider_Model_Config_Source_Position::{$position}";
        $posId   = defined($constant) ? constant($constant) : null;

        /** @var Icoders_Slider_Model_Resource_Banner_Collection $banners */
        $banners = Mage::getModel('icoders_slider/banner')->getCollection();
        $banners->addEnabledFilter();

        if (!Mage::app()->isSingleStoreMode()) {
            $banners->addStoreFilter(Mage::app()->getStore()->getId());
        }

        if ($posId) {
            $banners->addFieldToFilter('position', $posId);
        }

        if ($identifier) {
            if (is_numeric($identifier)) {
                $banners->addFieldToFilter('entity_id', $identifier);
            } else {
                $banners->addFieldToFilter('title', $identifier);
            }
        }

        return $banners->getFirstItem();
    }
}
