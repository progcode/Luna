<?php
/**
 * Aion_Rbanner_Block_Adminhtml_Banner_Edit_Tab_Form
 *
 * @category  Aion
 * @package   Aion_Rbanner
 * @author    Dombi István <istvan.dombi@aionhill.com>
 * @copyright 2013 AionNext Kft. (http://aionhill.com)
 * @license   Aion License http://aionhill.com/licence
 * @link      http://www.aion.hu
 */

/**
 * Class Aion_Rbanner_Block_Adminhtml_Banner_Edit_Tab_Form
 */
class Aion_Rbanner_Block_Adminhtml_Banner_Edit_Tab_Form extends Mage_Adminhtml_Block_Widget_Form
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
            "aion_rbanner_banner_form",
            array(
                "legend" => Mage::helper("aion_rbanner")->__("Banner information")
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
            'status',
            'select',
            array(
                'label'  => Mage::helper('aion_rbanner')->__('Enabled'),
                'values' => [
                    Aion_Rbanner_Model_Resource_Banner_Collection::STATUS_DISABLED => Mage::helper('aion_rbanner')->__('Disabled'),
                    Aion_Rbanner_Model_Resource_Banner_Collection::STATUS_ENABLED  => Mage::helper('aion_rbanner')->__('Enabled'),
                ],
                'name'   => 'status',
            )
        );

        $fieldset->addField(
            'position',
            'select',
            array(
                'label'  => Mage::helper('aion_rbanner')->__('Position'),
                'name'   => 'position',
                'values' => Mage::getSingleton('aion_rbanner/config_source_position')->toOptionArray(),
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
