<?php
/**
 * app/code/community/Icoders/Banner/Block/Adminhtml/Grid/Edit.php
 *
 * @category  Icoders
 * @package   Icoders_Banner
 * @author    iCoders <support@icoders.co>
 * @copyright 2016 Icoders (http://www.icoders.co)
 * @license   http://icoders.co/license Icoders License
 * @link      http://www.icoders.co
 */

/**
 * Class Icoders_Banner_Block_Adminhtml_Grid_Edit
 */
class Icoders_Banner_Block_Adminhtml_Grid_Edit extends Mage_Adminhtml_Block_Widget_Form_Container
{
    /**
     * Constructor
     */
    public function __construct()
    {
        parent::__construct();
        $this->_blockGroup = 'icoders_banner';
        $this->_controller = 'adminhtml_grid';
        $this->_mode = 'edit';

        $modelTitle = $this->_getModelTitle();

        $this->_updateButton(
            'save',
            'label',
            $this->_getHelper()->__("Save $modelTitle")
        );

        $this->_addButton(
            'saveandcontinue',
            array(
                'label'   => $this->_getHelper()->__('Save and Continue Edit'),
                'onclick' => 'saveAndContinueEdit()',
                'class'   => 'save',
            ),
            -100
        );

        $this->_formScripts[] = "
            function saveAndContinueEdit(){
                editForm.submit($('edit_form').action+'back/edit/');
            }
        ";
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
     * Get model
     *
     * @return mixed
     */
    protected function _getModel()
    {
        return Mage::registry('current_banner');
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
     * Get header text
     *
     * @return string
     */
    public function getHeaderText()
    {
        $model = $this->_getModel();
        $modelTitle = $this->_getModelTitle();

        if ($model && $model->getId()) {
            return $this->_getHelper()
                ->__("Edit $modelTitle (ID: {$model->getId()})");
        } else {
            return $this->_getHelper()->__("New $modelTitle");
        }
    }


    /**
     * Get URL for back (reset) button
     *
     * @return string
     */
    public function getBackUrl()
    {
        return $this->getUrl('*/*/index');
    }

    /**
     * Get delete url
     *
     * @return string
     * @throws Exception
     */
    public function getDeleteUrl()
    {
        return $this->getUrl(
            '*/*/delete',
            array(
                $this->_objectId => $this->getRequest()->getParam($this->_objectId)
            )
        );
    }

    /**
     * Get form save URL
     *
     * @return string
     */
    public function getSaveUrl()
    {
        $this->setData('form_action_url', 'save');
        return $this->getFormActionUrl();
    }

}
