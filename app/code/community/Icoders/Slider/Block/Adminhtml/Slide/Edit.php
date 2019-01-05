<?php

/**
 * Icoders_Slider_Block_Adminhtml_Slide_Edit
 *
 * @category  Icoders
 * @package   Icoders_Slider
 * @author    iCoders <support@icoders.co>
 * @copyright 2013 Icoders (http://icoders.co)
 * @license   Icoders License http://icoders.co/licence
 * @link      http://www.icoders.co
 */
class Icoders_Slider_Block_Adminhtml_Slide_Edit extends Mage_Adminhtml_Block_Widget_Form_Container
{
    /**
     * Construct
     */
    public function __construct()
    {
        parent::__construct();
        $this->_objectId   = "id";
        $this->_blockGroup = "icoders_slider";
        $this->_controller = "adminhtml_slide";
        $this->_updateButton("save", "label", Mage::helper("icoders_slider")->__("Save Slide"));
        $this->_updateButton("delete", "label", Mage::helper("icoders_slider")->__("Delete Slide"));
        $this->_addButton(
            "saveandcontinue",
            array(
                "label"   => Mage::helper("icoders_slider")->__("Save And Continue Edit"),
                "onclick" => "saveAndContinueEdit()",
                "class"   => "save",
            ),
            -100
        );

        $this->_formScripts[] = "
            function saveAndContinueEdit(){
                editForm.submit($('edit_form').action+'back/edit/');
            }
        ";
    }

    /**
     * Get Header Text
     *
     * @return string
     */
    public function getHeaderText()
    {
        if ($this->_getSlide() && $this->_getSlide()->getId()) {
            return Mage::helper("icoders_slider")->__("Edit Slide '%s'", $this->htmlEscape($this->_getSlide()->getTitle()));
        } else {
            return Mage::helper("icoders_slider")->__("Add Slide");
        }
    }

    /**
     * @return Icoders_Slider_Model_Slide
     */
    protected function _getSlide()
    {
        if (Mage::registry('slide_item')) {
            return Mage::registry('slide_item');
        } else if (($id = $this->getRequest()->getParam('id'))) {
            return Mage::getModel('icoders_slider/slide')->load($id);
        }
    }
}
