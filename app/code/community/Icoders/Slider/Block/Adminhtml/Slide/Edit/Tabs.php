<?php
/**
 * Aion_Rbanner_Block_Adminhtml_Slide_Edit_Tabs
 *
 * @category  Aion
 * @package   Aion_Rbanner
 * @author    Dombi István <istvan.dombi@aionhill.com>
 * @copyright 2013 AionNext Kft. (http://aionhill.com)
 * @license   Aion License http://aionhill.com/licence
 * @link      http://www.aion.hu
 */
class Aion_Rbanner_Block_Adminhtml_Slide_Edit_Tabs extends Mage_Adminhtml_Block_Widget_Tabs
{
    /**
     * Construct function
     */
    public function __construct()
    {
        parent::__construct();
        $this->setId("aion_rbanner_slide_tabs");
        $this->setDestElementId("edit_form");
        $this->setTitle(Mage::helper("aion_rbanner")->__("Slide Information"));
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
                "label" => Mage::helper("aion_rbanner")->__("Slide Information"),
                "title" => Mage::helper("aion_rbanner")->__("Slide Information"),
                "content" => $this->getLayout()->createBlock("aion_rbanner/adminhtml_slide_edit_tab_form")->toHtml(),
            )
        );

        return parent::_beforeToHtml();
    }
}
