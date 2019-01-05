<?php

/**
 * Aion_Rbanner_Block_Banner
 *
 * @category  Aion
 * @package   Aion_Rbanner
 * @author    Dombi István <istvan.dombi@aionhill.com>
 * @copyright 2013 AionNext Kft. (http://aionhill.com)
 * @license   Aion License http://aionhill.com/licence
 * @link      http://www.aion.hu
 */
class Aion_Rbanner_Block_Banner extends Mage_Core_Block_Template
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
                'cache_tags'     => array(Aion_Rbanner_Model_Banner::CACHE_TAG),
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
     * @return Aion_Rbanner_Model_Banner
     * @throws Exception
     */
    public function getBanner($identifier = null)
    {
        if (is_null($identifier) && !($position = $this->getPosition())) {
            $identifier = $this->getData('banner_id');
            $e = Mage::exception('Aion_Rbanner', Mage::helper('aion_rbanner')->__('The banner has not been specified'));
            Mage::throwException($e);
        }

        $position = $this->getPosition();

        $constant = "Aion_Rbanner_Model_Config_Source_Position::{$position}";
        $posId   = defined($constant) ? constant($constant) : null;

        /** @var Aion_Rbanner_Model_Resource_Banner_Collection $banners */
        $banners = Mage::getModel('aion_rbanner/banner')->getCollection();
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
