<?php
/**
 * @category  Icoders
 * @package   Icoders_Slider
 * @author    Dombi István <istvan.dombi@icoders.co>
 * @copyright 2017 Icoders (http://icoders.co)
 * @license   http://icoders.co/licence Icoders License
 * @link      http://icoders.co
 */
class Icoders_Slider_Model_Config_Source_Position
{
    /** @var integer */
    const CONTENT_TOP     = 1;
    /** @var integer */
    const CONTENT_BOTTOM  = 2;
    /** @var integer */
    const BODY_BACKGROUND = 4;

    /**
     * Options getter
     *
     * @return array
     */
    public function toOptionArray()
    {
        return array(
            array(
                'value' => self::CONTENT_TOP,
                'label' => Mage::helper('adminhtml')->__('Content Top')
            ),
            array(
                'value' => self::CONTENT_BOTTOM,
                'label' => Mage::helper('adminhtml')->__('Content Bottom')
            ),
            array(
                'value' => self::BODY_BACKGROUND,
                'label' => Mage::helper('adminhtml')->__('Page Background')
            )
        );
    }

}
