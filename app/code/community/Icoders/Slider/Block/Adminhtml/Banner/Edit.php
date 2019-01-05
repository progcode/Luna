<?php
/**
 * Icoders_Slider_Block_Adminhtml_Banner_Edit
 *
 * @category  Icoders
 * @package   Icoders_Slider
 * @author    iCoders <support@icoders.co>
 * @copyright 2013 Icoders (http://icoders.co)
 * @license   Icoders License http://icoders.co/licence
 * @link      http://www.icoders.co
 */
class Icoders_Slider_Block_Adminhtml_Banner_Edit extends Mage_Adminhtml_Block_Widget_Form_Container
{
    /**
     * Construct
     */
    public function __construct()
    {
        parent::__construct();
        $this->_objectId   = "id";
        $this->_blockGroup = "icoders_slider";
        $this->_controller = "adminhtml_banner";
        $this->_updateButton("save", "label", Mage::helper("icoders_slider")->__("Save Banner"));
        $this->_updateButton("delete", "label", Mage::helper("icoders_slider")->__("Delete Banner"));
        $this->_addButton(
            "saveandcontinue",
            array(
                "label"   => Mage::helper("icoders_slider")->__("Save And Continue Edit"),
                "onclick" => "saveAndContinueEdit()",
                "class"   => "save",
            ),
            -100
        );

        if ($this->_getBanner()->getId()) {
            $link = Mage::helper("adminhtml")->getUrl("*/slide/new", ['banner_id' => $this->_getBanner()->getId()]);
            $this->_addButton(
                "addslide",
                array(
                    "label"   => Mage::helper("icoders_slider")->__("Add new Slide"),
                    "onclick" => "setLocation('$link')",
                    "class"   => "save",
                ),
                300
            );
        }

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
        if ($this->_getBanner() && $this->_getBanner()->getId()) {
            return Mage::helper("icoders_slider")->__("Edit Banner '%s'", $this->htmlEscape($this->_getBanner()->getTitle()));
        } else {
            return Mage::helper("icoders_slider")->__("Add Banner");
        }
    }

    /**
     * @return Icoders_Slider_Model_Banner
     */
    protected function _getBanner()
    {
        if (Mage::registry('banner_item')) {
            return Mage::registry('banner_item');
        } else if (($id = $this->getRequest()->getParam('id'))) {
            return Mage::getModel('icoders_slider/banner')->load($id);
        } else {
            return Mage::getModel('icoders_slider/banner');
        }
    }
}
