<?php

/**
 * Icoders_Slider_Block_Adminhtml_Slide_Edit_Tab_Form
 *
 * @category  Icoders
 * @package   Icoders_Slider
 * @author    iCoders <support@icoders.co>
 * @copyright 2013 Icoders (http://icoders.co)
 * @license   Icoders License http://icoders.co/licence
 * @link      http://www.icoders.co
 */
class Icoders_Slider_Block_Adminhtml_Slide_Edit_Tab_Form extends Mage_Adminhtml_Block_Widget_Form
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
            "icoders_slider_slide_form",
            array(
                "legend" => Mage::helper("icoders_slider")->__("Slide information")
            )
        );

        $fieldset->addField(
            "title",
            "text",
            array(
                "label" => Mage::helper("icoders_slider")->__("Title"),
                "name"  => "title",
            )
        );

        $fieldset->addField(
            'html',
            'editor',
            array(
                'name'     => 'html',
                'label'    => Mage::helper('icoders_slider')->__('HTML'),
                'title'    => Mage::helper('icoders_slider')->__('HTML'),
                'style'    => 'height:20em;width:50em;',
                'required' => true,
                'config'   => Mage::getSingleton('cms/wysiwyg_config')->getConfig()
            )
        );

        /** @var Icoders_Slider_Model_Resource_Banner_Collection $banners */
        $banners   = Mage::getModel('icoders_slider/banner')->getCollection();
        $bannerOpt = [];
        foreach ($banners as $banner) {
            $bannerOpt[$banner->getId()] = $banner->getTitle();
        }

        $fieldset->addField(
            'banner_id',
            'select',
            array(
                'label'    => Mage::helper('icoders_slider')->__('Banner'),
                'title'    => Mage::helper('icoders_slider')->__('Banner'),
                'name'     => 'banner_id',
                'required' => true,
                'options'  => $bannerOpt
            )
        );

        $fieldset->addField(
            "link",
            "text",
            array(
                "label"    => Mage::helper("icoders_slider")->__("Link"),
                "name"     => "link",
                'required' => true,
                "class"    => "required-entry validate-url"
            )
        );

        $fieldset->addField(
            "desktop_image",
            "image",
            array(
                "label" => Mage::helper("icoders_slider")->__("Desktop Image"),
                "name"  => "desktop_image",
            )
        );

        $fieldset->addField(
            "tablet_image",
            "image",
            array(
                "label" => Mage::helper("icoders_slider")->__("Tablet Image"),
                "name"  => "tablet_image",
            )
        );

        $fieldset->addField(
            "mobile_image",
            "image",
            array(
                "label" => Mage::helper("icoders_slider")->__("Mobile Image"),
                "name"  => "mobile_image",
            )
        );

        $fieldset->addField(
            "position",
            "text",
            array(
                'required' => true,
                "label"    => Mage::helper("icoders_slider")->__("Position"),
                "name"     => "position",
                "class"    => "validate-zero-or-greater"
            )
        );

        $form->setValues(Mage::registry('slide_item')->getData());

        return parent::_prepareForm();
    }
}
