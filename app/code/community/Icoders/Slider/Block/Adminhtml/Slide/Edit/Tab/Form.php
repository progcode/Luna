<?php

/**
 * Aion_Rbanner_Block_Adminhtml_Slide_Edit_Tab_Form
 *
 * @category  Aion
 * @package   Aion_Rbanner
 * @author    Dombi István <istvan.dombi@aionhill.com>
 * @copyright 2013 AionNext Kft. (http://aionhill.com)
 * @license   Aion License http://aionhill.com/licence
 * @link      http://www.aion.hu
 */
class Aion_Rbanner_Block_Adminhtml_Slide_Edit_Tab_Form extends Mage_Adminhtml_Block_Widget_Form
{
    /**
     * Prepare the form
     *
     * @return Mage_Adminhtml_Block_Widget_Form
     */
    protected function _prepareForm()
    {
        $form = new Varien_Data_Form();
        $this->setForm($form);
        $fieldset = $form->addFieldset(
            "aion_rbanner_slide_form",
            array(
                "legend" => Mage::helper("aion_rbanner")->__("Slide information")
            )
        );

        $fieldset->addField(
            "title",
            "text",
            array(
                "label" => Mage::helper("aion_rbanner")->__("Title"),
                "name"  => "title",
            )
        );

        $fieldset->addField(
            'html',
            'editor',
            array(
                'name'     => 'html',
                'label'    => Mage::helper('aion_rbanner')->__('HTML'),
                'title'    => Mage::helper('aion_rbanner')->__('HTML'),
                'style'    => 'height:20em;width:50em;',
                'required' => true,
                'config'   => Mage::getSingleton('cms/wysiwyg_config')->getConfig()
            )
        );

        /** @var Aion_Rbanner_Model_Resource_Banner_Collection $banners */
        $banners   = Mage::getModel('aion_rbanner/banner')->getCollection();
        $bannerOpt = [];
        foreach ($banners as $banner) {
            $bannerOpt[$banner->getId()] = $banner->getTitle();
        }

        $fieldset->addField(
            'banner_id',
            'select',
            array(
                'label'    => Mage::helper('aion_rbanner')->__('Banner'),
                'title'    => Mage::helper('aion_rbanner')->__('Banner'),
                'name'     => 'banner_id',
                'required' => true,
                'options'  => $bannerOpt
            )
        );

        $fieldset->addField(
            "link",
            "text",
            array(
                "label"    => Mage::helper("aion_rbanner")->__("Link"),
                "name"     => "link",
                'required' => true,
                "class"    => "required-entry validate-url"
            )
        );

        $fieldset->addField(
            "desktop_image",
            "image",
            array(
                "label" => Mage::helper("aion_rbanner")->__("Desktop Image"),
                "name"  => "desktop_image",
            )
        );

        $fieldset->addField(
            "tablet_image",
            "image",
            array(
                "label" => Mage::helper("aion_rbanner")->__("Tablet Image"),
                "name"  => "tablet_image",
            )
        );

        $fieldset->addField(
            "mobile_image",
            "image",
            array(
                "label" => Mage::helper("aion_rbanner")->__("Mobile Image"),
                "name"  => "mobile_image",
            )
        );

        $fieldset->addField(
            "position",
            "text",
            array(
                'required' => true,
                "label"    => Mage::helper("aion_rbanner")->__("Position"),
                "name"     => "position",
                "class"    => "validate-zero-or-greater"
            )
        );

        $form->setValues(Mage::registry('slide_item')->getData());

        return parent::_prepareForm();
    }
}
