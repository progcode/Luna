<?php

/**
 * Aion_Rbanner_Block_Adminhtml_Slide_Edit
 *
 * @category  Aion
 * @package   Aion_Rbanner
 * @author    Dombi István <istvan.dombi@aionhill.com>
 * @copyright 2013 AionNext Kft. (http://aionhill.com)
 * @license   Aion License http://aionhill.com/licence
 * @link      http://www.aion.hu
 */
class Aion_Rbanner_Block_Adminhtml_Slide_Edit extends Mage_Adminhtml_Block_Widget_Form_Container
{
    /**
     * Construct
     */
    public function __construct()
    {
        parent::__construct();
        $this->_objectId   = "id";
        $this->_blockGroup = "aion_rbanner";
        $this->_controller = "adminhtml_slide";
        $this->_updateButton("save", "label", Mage::helper("aion_rbanner")->__("Save Slide"));
        $this->_updateButton("delete", "label", Mage::helper("aion_rbanner")->__("Delete Slide"));
        $this->_addButton(
            "saveandcontinue",
            array(
                "label"   => Mage::helper("aion_rbanner")->__("Save And Continue Edit"),
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
            return Mage::helper("aion_rbanner")->__("Edit Slide '%s'", $this->htmlEscape($this->_getSlide()->getTitle()));
        } else {
            return Mage::helper("aion_rbanner")->__("Add Slide");
        }
    }

    /**
     * @return Aion_Rbanner_Model_Slide
     */
    protected function _getSlide()
    {
        if (Mage::registry('slide_item')) {
            return Mage::registry('slide_item');
        } else if (($id = $this->getRequest()->getParam('id'))) {
            return Mage::getModel('aion_rbanner/slide')->load($id);
        }
    }
}
