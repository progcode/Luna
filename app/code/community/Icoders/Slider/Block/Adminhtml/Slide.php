<?php

/**
 * Icoders_Slider_Block_Adminhtml_Slide
 *
 * @category  Icoders
 * @package   Icoders_Slider
 * @author    Dombi István <istvan.dombi@icoders.co>
 * @copyright 2013 Icoders (http://icoders.co)
 * @license   Icoders License http://icoders.co/licence
 * @link      http://www.icoders.co
 */
class Icoders_Slider_Block_Adminhtml_Slide extends Mage_Adminhtml_Block_Widget_Grid_Container
{
    /**
     * Construct
     */
    public function __construct()
    {
        $this->_controller     = "adminhtml_slide";
        $this->_blockGroup     = "icoders_slider";
        $this->_headerText     = Mage::helper("icoders_slider")->__("Manage Slides");
        $this->_addButtonLabel = Mage::helper("icoders_slider")->__("Add New Slide");
        parent::__construct();

    }
}
