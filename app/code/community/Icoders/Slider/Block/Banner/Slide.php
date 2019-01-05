<?php

/**
 * Icoders_Slider_Block_Banner_Slide
 *
 * @category  Icoders
 * @package   Icoders_Slider
 * @author    Dombi István <istvan.dombi@icoders.co>
 * @copyright 2013 Icoders (http://icoders.co)
 * @license   Icoders License http://icoders.co/licence
 * @link      http://www.icoders.co
 */
class Icoders_Slider_Block_Banner_Slide extends Mage_Core_Block_Template
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
                'cache_tags'     => array(Icoders_Slider_Model_Slide::CACHE_TAG),
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
            Mage::throwException(Mage::exception('Icoders_Slider', 'The slide model has not been passed.'));
        }
        $this->addData(
            [
                'cache_key' => 'AIONRBANNER_SLIDE_ID_' . $this->getSlide()->getId()
            ]
        );

        return $this;
    }
}
