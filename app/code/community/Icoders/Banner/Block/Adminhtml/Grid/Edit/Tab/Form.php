<?php
/**
 * app/code/community/Icoders/Banner/Block/Adminhtml/Grid/Edit/Tab/Form.php
 *
 * @category  Icoders
 * @package   Icoders_Banner
 * @author    iCoders <support@icoders.co>
 * @copyright 2016 Icoders (http://www.icoders.co)
 * @license   http://icoders.co/license Icoders License
 * @link      http://www.icoders.co
 */

/**
 * Class Icoders_Banner_Block_Adminhtml_Grid_Edit_Tab_Form
 */
class Icoders_Banner_Block_Adminhtml_Grid_Edit_Tab_Form
    extends Mage_Adminhtml_Block_Widget_Form
    implements Mage_Adminhtml_Block_Widget_Tab_Interface
{

    /**
     * Get tab label
     *
     * @return Icoders_Banner_Helper_Data
     */
    public function getTabLabel()
    {
        return $this->_getHelper()->__('Banner Information');
    }

    /**
     * Get tab title
     *
     * @return Icoders_Banner_Helper_Data
     */
    public function getTabTitle()
    {
        return $this->_getHelper()->__('Banner Information');
    }

    /**
     * Can show tab
     *
     * @return bool
     */
    public function canShowTab()
    {
        return true;
    }

    /**
     * Is hidden
     *
     * @return bool
     */
    public function isHidden()
    {
        return false;
    }

    /**
     * Get model
     *
     * @return mixed
     */
    protected function _getModel()
    {
        return Mage::registry('banner_item');
    }

    /**
     * Get helper
     *
     * @return Icoders_Banner_Helper_Data
     */
    protected function _getHelper()
    {
        return Mage::helper('icoders_banner');
    }

    /**
     * Get model title
     *
     * @return string
     */
    protected function _getModelTitle()
    {
        return 'Banner';
    }

    /**
     * Prepare form
     *
     * @return Mage_Adminhtml_Block_Widget_Form
     */
    protected function _prepareForm()
    {
        $model = $this->_getModel();
        $modelTitle = $this->_getModelTitle();
        $form = new Varien_Data_Form(
            array(
                'id'     => 'edit_form',
                'action' => $this->getUrl('*/*/save'),
                'method' => 'post'
            )
        );

        $fieldSet = $form->addFieldset(
            'base_fieldset',
            array(
                'legend' => $this->_getHelper()->__("$modelTitle Information"),
                'class'  => 'fieldset-wide',
            )
        );

        if ($model && $model->getId()) {
            $modelPk = $model->getResource()->getIdFieldName();
            $fieldSet->addField(
                $modelPk,
                'hidden',
                array(
                    'name' => $modelPk,
                )
            );
        }

        $fieldSet->addField(
            'title',
            'text',
            array(
                'name'     => 'title',
                'label'    => $this->_getHelper()->__('Title'),
                'required' => true,
                'class'    => 'required-entry',
            )
        );

        $fieldSet->addField(
            'status',
            'select',
            array(
                'name'     => 'status',
                'label'    => $this->_getHelper()->__('Status'),
                'required' => true,
                'options'  => array(
                    1 => Mage::helper('adminhtml')->__('Enable'),
                    0 => Mage::helper('adminhtml')->__('Disable'),
                ),
                'value'    => 1
            )
        );

        $fieldSet->addField(
            'position',
            'select',
            array(
                'label'  => $this->_getHelper()->__('Position'),
                'name'   => 'position',
                'values' => Mage::getSingleton('icoders_banner/config_source_position')->toOptionArray(),
                'value'  => $model->getPosition()
            )
        );

        $fieldSet->addField(
            'height',
            'text',
            array(
                'label'    => $this->_getHelper()->__('Height'),
                'required' => false,
                'name'     => 'height',
                'class'    => 'validate-number',
                'note'     => $this->_getHelper()->__('E.g you want to height 100px then need to only 100 into textbox')
            )
        );

        $fieldSet->addField(
            'width',
            'text',
            array(
                'label'    => $this->_getHelper()->__('Width'),
                'required' => false,
                'name'     => 'width',
                'class'    => 'validate-number',
                'note'     => $this->_getHelper()->__('E.g you want to width 100px then need to only 100 into textbox')
            )
        );

        if (!Mage::app()->isSingleStoreMode()) {
            $field = $fieldSet->addField(
                'stores',
                'multiselect',
                array(
                    'name'     => 'stores[]',
                    'label'    => Mage::helper('cms')->__('Store View'),
                    'title'    => Mage::helper('cms')->__('Store View'),
                    'required' => true,
                    'values'   => Mage::getSingleton('adminhtml/system_store')->getStoreValuesForForm(false, true),
                    'value'    => $model->getStores()
                )
            );

            $renderer = $this->getLayout()->createBlock('adminhtml/store_switcher_form_renderer_fieldset_element');
            $field->setRenderer($renderer);

        } else {

            $fieldSet->addField(
                'stores',
                'hidden',
                array(
                    'name'  => 'stores[]',
                    'value' => Mage::app()->getStore(true)->getId()
                )
            );

            $model->setStoreId(Mage::app()->getStore(true)->getId());
        }


        $fieldSet->addField(
            'advanced_settings',
            'textarea',
            array(
                'label'    => $this->_getHelper()->__('Advanced Settings'),
                'required' => false,
                'name'     => 'advanced_settings',
                'note'     => $this->_getHelper()->__('Bootstrap-carousel options. Default : {}')
            )
        );


        $linkFields = $fieldSet->addField(
            'links',
            'editor',
            array(
                'name'     => 'links',
                'label'    => $this->_getHelper()->__('Links'),
                'required' => false,
            )
        );

        $links = array();

        $linkBlock = $this->getLayout()
            ->createBlock('icoders_banner/adminhtml_grid_edit_tab_links')
            ->setData(
                array(
                    'name'     => 'links',
                    'label'    => $this->_getHelper()->__('Links'),
                    'required' => false,
                    'value'    => $links
                )
            );

        $linkFields->setRenderer($linkBlock);

        if ($model->getId()) {
            $form->setValues($model->getData());
        }

        $this->setForm($form);

        return parent::_prepareForm();
    }

}
