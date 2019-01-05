<?php
/**
 * @category  Aion
 * @package   Aion_Rbanner
 * @author    Dombi István <istvan.dombi@aionhill.com>
 * @copyright 2017 AionNext Kft. (http://aionhill.com)
 * @license   http://aionhill.com/licence Aion License
 * @link      http://aionhill.com
 */
class Aion_Rbanner_Model_Config_Source_Position
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
