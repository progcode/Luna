<?php
/**
 * app/code/community/Icoders/Banner/Block/Adminhtml/Grid.php
 *
 * @category  Icoders
 * @package   Icoders_Banner
 * @author    iCoders <support@icoders.co>
 * @copyright 2016 Icoders (http://www.icoders.co)
 * @license   http://icoders.co/license Icoders License
 * @link      http://www.icoders.co
 */

/**
 * Class Icoders_Banner_Block_Adminhtml_Grid
 */
class Icoders_Banner_Block_Adminhtml_Grid extends Mage_Adminhtml_Block_Widget_Grid_Container
{

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->_blockGroup = 'icoders_banner';
        $this->_controller = 'adminhtml_grid';
        $this->_headerText = $this->__('Manage Banners');
        $this->_addButtonLabel = $this->__('Add new banner');
        parent::__construct();

        if (Mage::helper('icoders_banner/admin')->isActionAllowed('save')) {
            $this->_updateButton('add', 'label', Mage::helper('icoders_banner')->__('Add New Banner'));
        } else {
            $this->_removeButton('add');
        }
        $this->addButton(
            'banner_flush_images_cache',
            array(
                'label'   => Mage::helper('icoders_banner')->__('Flush Images Cache'),
                'onclick' => 'setLocation(\'' . $this->getUrl('*/*/flush') . '\')',
            )
        );
    }

    /**
     * Get create url
     *
     * @return string
     */
    public function getCreateUrl()
    {
        return $this->getUrl('*/*/new');
    }

}
