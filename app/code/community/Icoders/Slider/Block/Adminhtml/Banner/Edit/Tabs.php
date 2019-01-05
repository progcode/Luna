<?php
/**
 * Icoders_Slider_Block_Adminhtml_Banner_Edit_Tabs
 *
 * @category  Icoders
 * @package   Icoders_Slider
 * @author    iCoders <support@icoders.co>
 * @copyright 2013 Icoders (http://icoders.co)
 * @license   Icoders License http://icoders.co/licence
 * @link      http://www.icoders.co
 */
class Icoders_Slider_Block_Adminhtml_Banner_Edit_Tabs extends Mage_Adminhtml_Block_Widget_Tabs
{
    /**
     * Construct function
     */
    public function __construct()
    {
        parent::__construct();
        $this->setId("icoders_slider_banner_tabs");
        $this->setDestElementId("edit_form");
        $this->setTitle(Mage::helper("icoders_slider")->__("Banner Information"));
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
                "label" => Mage::helper("icoders_slider")->__("Banner Information"),
                "title" => Mage::helper("icoders_slider")->__("Banner Information"),
                "content" => $this->getLayout()->createBlock("icoders_slider/adminhtml_banner_edit_tab_form")->toHtml(),
            )
        );

        $this->addTab(
            "slides",
            array(
                "label" => Mage::helper("icoders_slider")->__("Slides"),
                "title" => Mage::helper("icoders_slider")->__("Slides"),
                "content" => $this->getLayout()->createBlock("icoders_slider/adminhtml_banner_edit_tab_Slides")->toHtml(),
            )
        );

        return parent::_beforeToHtml();
    }
}
