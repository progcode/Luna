<?php
/**
 * Aion_Rbanner_Block_Adminhtml_Banner_Edit_Tabs
 *
 * @category  Aion
 * @package   Aion_Rbanner
 * @author    Dombi István <istvan.dombi@aionhill.com>
 * @copyright 2013 AionNext Kft. (http://aionhill.com)
 * @license   Aion License http://aionhill.com/licence
 * @link      http://www.aion.hu
 */
class Aion_Rbanner_Block_Adminhtml_Banner_Edit_Tabs extends Mage_Adminhtml_Block_Widget_Tabs
{
    /**
     * Construct function
     */
    public function __construct()
    {
        parent::__construct();
        $this->setId("aion_rbanner_banner_tabs");
        $this->setDestElementId("edit_form");
        $this->setTitle(Mage::helper("aion_rbanner")->__("Banner Information"));
    }

    /**
     * Before to html
     *
     * @return Mage_Core_Block_Abstract
     */
    protected function _beforeToHtml()
    {
        $this->addTab(
            "form_section",
            array(
                "label" => Mage::helper("aion_rbanner")->__("Banner Information"),
                "title" => Mage::helper("aion_rbanner")->__("Banner Information"),
                "content" => $this->getLayout()->createBlock("aion_rbanner/adminhtml_banner_edit_tab_form")->toHtml(),
            )
        );

        $this->addTab(
            "slides",
            array(
                "label" => Mage::helper("aion_rbanner")->__("Slides"),
                "title" => Mage::helper("aion_rbanner")->__("Slides"),
                "content" => $this->getLayout()->createBlock("aion_rbanner/adminhtml_banner_edit_tab_Slides")->toHtml(),
            )
        );

        return parent::_beforeToHtml();
    }
}
