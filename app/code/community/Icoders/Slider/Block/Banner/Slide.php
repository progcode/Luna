<?php

/**
 * Aion_Rbanner_Block_Banner_Slide
 *
 * @category  Aion
 * @package   Aion_Rbanner
 * @author    Dombi István <istvan.dombi@aionhill.com>
 * @copyright 2013 AionNext Kft. (http://aionhill.com)
 * @license   Aion License http://aionhill.com/licence
 * @link      http://www.aion.hu
 */
class Aion_Rbanner_Block_Banner_Slide extends Mage_Core_Block_Template
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
                'cache_tags'     => array(Aion_Rbanner_Model_Slide::CACHE_TAG),
            )
        );
    }

    /**
     * @return $this
     */
    protected function _beforeToHtml()
    {
        parent::_beforeToHtml();
        if (!$this->getSlide()) {
            Mage::throwException(Mage::exception('Aion_Rbanner', 'The slide model has not been passed.'));
        }
        $this->addData(
            [
                'cache_key' => 'AIONRBANNER_SLIDE_ID_' . $this->getSlide()->getId()
            ]
        );

        return $this;
    }
}
