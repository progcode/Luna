<?php
/**
 * app/code/community/Icoders/Banner/Model/Config/Source/Position.php
 *
 * PHP Version 5
 *
 * @category  Icoders
 * @package   Icoders_Banner
 * @author    iCoders <support@icoders.co>
 * @copyright 2016 Icoders (http://www.icoders.co)
 * @license   http://icoders.co/license Icoders License
 * @link      http://www.icoders.co
 */

/**
 * Class Icoders_Banner_Model_Config_Source_Position
 */
class Icoders_Banner_Model_Config_Source_Position
{
    const CONTENT_TOP     = 1;
    const CONTENT_BOTTOM  = 2;
    const CONTENT_WIDGET  = 3;
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
                'value' => self::CONTENT_WIDGET,
                'label' => Mage::helper('adminhtml')->__('Anywhere by CMS Widget')
            ),
            array(
                'value' => self::BODY_BACKGROUND,
                'label' => Mage::helper('adminhtml')->__('Page Background')
            )
        );
    }

}
