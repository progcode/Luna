<?php
/**
 * app/code/community/Icoders/Banner/Block/Adminhtml/Grid/Edit/Tabs.php
 *
 * @category  Icoders
 * @package   Icoders_Banner
 * @author    iCoders <support@icoders.co>
 * @copyright 2016 Icoders (http://www.icoders.co)
 * @license   http://icoders.co/license Icoders License
 * @link      http://www.icoders.co
 */

/**
 * Class Icoders_Banner_Block_Adminhtml_Grid_Edit_Tabs
 */
class Icoders_Banner_Block_Adminhtml_Grid_Edit_Tabs extends Mage_Adminhtml_Block_Widget_Tabs
{

    /**
     * Constructor
     */
    public function __construct()
    {
        parent::__construct();

        $this->setId('banner_tabs');
        $this->setName('banner_tabs');
        $this->setDestElementId('edit_form');
        $this->setTitle(Mage::helper('icoders_banner')->__('Banner Information'));
    }

}
