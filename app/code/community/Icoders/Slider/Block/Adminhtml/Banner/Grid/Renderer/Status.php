<?php
/**
 * Icoders_Slider_Block_Adminhtml_Banner_Grid_Renderer_Status
 *
 * @category  Icoders
 * @package   Icoders_Slider
 * @author    iCoders <support@icoders.co>
 * @copyright 2013 Icoders (http://icoders.co)
 * @license   Icoders License http://icoders.co/licence
 * @link      http://www.icoders.co
 */
class Icoders_Slider_Block_Adminhtml_Banner_Grid_Renderer_Status extends Mage_Adminhtml_Block_Widget_Grid_Column_Renderer_Abstract
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
        if ($row['status'] == Icoders_Slider_Model_Resource_Banner_Collection::STATUS_ENABLED) {
            return Mage::helper('icoders_slider')->__('Enabled');
        } else {
            return Mage::helper('icoders_slider')->__('Disabled');
        }
    }
}
