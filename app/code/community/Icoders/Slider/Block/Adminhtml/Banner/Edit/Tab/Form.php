<?php
/**
 * Icoders_Slider_Block_Adminhtml_Banner_Edit_Tab_Form
 *
 * @category  Icoders
 * @package   Icoders_Slider
 * @author    Dombi István <istvan.dombi@icoders.co>
 * @copyright 2013 Icoders (http://icoders.co)
 * @license   Icoders License http://icoders.co/licence
 * @link      http://www.icoders.co
 */

/**
 * Class Icoders_Slider_Block_Adminhtml_Banner_Edit_Tab_Form
 */
class Icoders_Slider_Block_Adminhtml_Banner_Edit_Tab_Form extends Mage_Adminhtml_Block_Widget_Form
{
    /**
     * Prepare the form
     *
     * @return Mage_Adminhtml_Block_Widget_Form
     */
    protected function _prepareForm()
    {
        $form = new Varien_Data_Form();
        $model = Mage::registry('banner_item');
        $this->setForm($form);
        $fieldset = $form->addFieldset(
            "icoders_slider_banner_form",
            array(
                "legend" => Mage::helper("icoders_slider")->__("Banner information")
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
            'status',
            'select',
            array(
                'label'  => Mage::helper('icoders_slider')->__('Enabled'),
                'values' => [
                    Icoders_Slider_Model_Resource_Banner_Collection::STATUS_DISABLED => Mage::helper('icoders_slider')->__('Disabled'),
                    Icoders_Slider_Model_Resource_Banner_Collection::STATUS_ENABLED  => Mage::helper('icoders_slider')->__('Enabled'),
                ],
                'name'   => 'status',
            )
        );

        $fieldset->addField(
            'position',
            'select',
            array(
                'label'  => Mage::helper('icoders_slider')->__('Position'),
                'name'   => 'position',
                'values' => Mage::getSingleton('icoders_slider/config_source_position')->toOptionArray(),
                'value'  => $model->getPosition()
            )
        );

        if (!Mage::app()->isSingleStoreMode()) {
            $field = $fieldset->addField(
                'stores',
                'multiselect',
                array(
                    'name'     => 'stores[]',
                    'label'    => Mage::helper('cms')->__('Store View'),
                    'title'    => Mage::helper('cms')->__('Store View'),
                    'required' => true,
                    'values'   => Mage::getSingleton('adminhtml/system_store')->getStoreValuesForForm(false, true),
                )
            );

            $renderer = $this->getLayout()->createBlock('adminhtml/store_switcher_form_renderer_fieldset_element');
            $field->setRenderer($renderer);

        } else {
            $fieldset->addField(
                'stores',
                'hidden',
                array(
                    'name'  => 'stores[]',
                    'value' => Mage::app()->getStore(true)->getId()
                )
            );

            $model->setStoreId(Mage::app()->getStore(true)->getId());
        }

        $form->setValues($model->getData());

        return parent::_prepareForm();
    }
}
