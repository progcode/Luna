<?php
/**
 * app/code/community/Icoders/Banner/Block/Adminhtml/Grid/Edit/Form.php
 *
 * @category  Icoders
 * @package   Icoders_Banner
 * @author    iCoders <support@icoders.co>
 * @copyright 2016 Icoders (http://www.icoders.co)
 * @license   http://icoders.co/license Icoders License
 * @link      http://www.icoders.co
 */

/**
 * Class Icoders_Banner_Block_Adminhtml_Grid_Edit_Form
 */
class Icoders_Banner_Block_Adminhtml_Grid_Edit_Form extends Mage_Adminhtml_Block_Widget_Form
{

    /**
     * prepare form
     *
     * @return Mage_Adminhtml_Block_Widget_Form
     * @throws Exception
     */
    protected function _prepareForm()
    {
        if (Mage::registry('banner_data')) {
            $data = Mage::registry('banner_data')->getData();
        } else {
            $data = array();
        }

        $form = new Varien_Data_Form(
            array(
                'id'      => 'edit_form',
                'action'  => $this->getUrl(
                    '*/*/save',
                    array('id' => $this->getRequest()->getParam('id'))
                ),
                'method'  => 'post',
                'enctype' => 'multipart/form-data'
            )
        );

        $form->setUseContainer(true);
        $this->setForm($form);
        $form->setValues($data);
        return parent::_prepareForm();
    }

}
