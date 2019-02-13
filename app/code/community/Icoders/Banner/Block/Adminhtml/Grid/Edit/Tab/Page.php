<?php
/**
 * app/code/community/Icoders/Banner/Block/Adminhtml/Grid/Edit/Tab/Page.php
 *
 * @category  Icoders
 * @package   Icoders_Banner
 * @author    iCoders <support@icoders.co>
 * @copyright 2016 Icoders (http://www.icoders.co)
 * @license   http://icoders.co/license Icoders License
 * @link      http://www.icoders.co
 */

/**
 * Class Icoders_Banner_Block_Adminhtml_Grid_Edit_Tab_Page
 */
class Icoders_Banner_Block_Adminhtml_Grid_Edit_Tab_Page
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
        return $this->_getHelper()->__('Visible on pages');
    }

    /**
     * Get tab title
     *
     * @return Icoders_Banner_Helper_Data
     */
    public function getTabTitle()
    {
        return $this->_getHelper()->__('Visible on pages');
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
     * Prepare form
     *
     * @return Mage_Adminhtml_Block_Widget_Form
     */
    protected function _prepareForm()
    {
        /** @var Icoders_Banner_Model_Banner $_model */
        $_model = Mage::registry('banner_item');

        if ($_model->getPageId()) {
            $_model->setPageId(explode(',', $_model->getPageId()));
        }

        $form = new Varien_Data_Form();
        $this->setForm($form);

        $fieldSet = $form->addFieldset(
            'banner_form',
            array(
                'legend' => Mage::helper('icoders_banner')->__('Banner Pages')
            )
        );

        $fieldSet->addField(
            'pages',
            'multiselect',
            array(
                'label'  => Mage::helper('icoders_banner')->__('Visible In'),
                'name'   => 'pages[]',
                'values' => Mage::getSingleton('icoders_banner/config_source_page')->toOptionArray(),
                'value'  => $_model->getPageId()
            )
        );

        return parent::_prepareForm();
    }

    /**
     * Get element
     *
     * @return Icoders_Banner_Model_Banner
     */
    public function getElement()
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

}
