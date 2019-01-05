<?php

/**
 * Icoders_Slider_Block_Adminhtml_Slide_Grid_Renderer_Banner
 *
 * @category  Icoders
 * @package   Icoders_Slider
 * @author    Dombi István <istvan.dombi@icoders.co>
 * @copyright 2013 Icoders (http://icoders.co)
 * @license   Icoders License http://icoders.co/licence
 * @link      http://www.icoders.co
 */
class Icoders_Slider_Block_Adminhtml_Slide_Grid_Renderer_Banner extends Mage_Adminhtml_Block_Widget_Grid_Column_Renderer_Abstract
{
    /**
     * Render column
     *
     * @param Varien_Object $row row data
     *
     * @return string
     */
    public function render(Varien_Object $row)
    {
        if (null === $row['banner_id']) {
            return Mage::helper('icoders_slider')->__('<strong>No Banner Connected</strong>');
        } else {
            $banner = Mage::getModel('icoders_slider/banner')->load($row['banner_id']);
            if (!$banner) {
                return Mage::helper('icoders_slider')->__('<strong>Banner does not exist</strong>');
            } else {
                $link = Mage::helper("adminhtml")->getUrl("*/banner/edit", ['id' => $row['banner_id']]);
                return "<a href=\"{$link}\">{$banner->getTitle()}</a>";
            }
        }
    }
}
