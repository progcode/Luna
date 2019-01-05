<?php
/**
 * Aion_Rbanner_Block_Adminhtml_Banner_Edit
 *
 * @category  Aion
 * @package   Aion_Rbanner
 * @author    Dombi István <istvan.dombi@aionhill.com>
 * @copyright 2013 AionNext Kft. (http://aionhill.com)
 * @license   Aion License http://aionhill.com/licence
 * @link      http://www.aion.hu
 */
class Aion_Rbanner_Block_Adminhtml_Banner_Edit extends Mage_Adminhtml_Block_Widget_Form_Container
{
    /**
     * Construct
     */
    public function __construct()
    {
        parent::__construct();
        $this->_objectId   = "id";
        $this->_blockGroup = "aion_rbanner";
        $this->_controller = "adminhtml_banner";
        $this->_updateButton("save", "label", Mage::helper("aion_rbanner")->__("Save Banner"));
        $this->_updateButton("delete", "label", Mage::helper("aion_rbanner")->__("Delete Banner"));
        $this->_addButton(
            "saveandcontinue",
            array(
                "label"   => Mage::helper("aion_rbanner")->__("Save And Continue Edit"),
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
                    "label"   => Mage::helper("aion_rbanner")->__("Add new Slide"),
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
            return Mage::helper("aion_rbanner")->__("Edit Banner '%s'", $this->htmlEscape($this->_getBanner()->getTitle()));
        } else {
            return Mage::helper("aion_rbanner")->__("Add Banner");
        }
    }

    /**
     * @return Aion_Rbanner_Model_Banner
     */
    protected function _getBanner()
    {
        if (Mage::registry('banner_item')) {
            return Mage::registry('banner_item');
        } else if (($id = $this->getRequest()->getParam('id'))) {
            return Mage::getModel('aion_rbanner/banner')->load($id);
        } else {
            return Mage::getModel('aion_rbanner/banner');
        }
    }
}
