<?php
/**
 * Aion_Rbanner_Block_Adminhtml_Banner
 *
 * @category  Aion
 * @package   Aion_Rbanner
 * @author    Dombi István <istvan.dombi@aionhill.com>
 * @copyright 2013 AionNext Kft. (http://aionhill.com)
 * @license   Aion License http://aionhill.com/licence
 * @link      http://www.aion.hu
 */
class Aion_Rbanner_Block_Adminhtml_Banner extends Mage_Adminhtml_Block_Widget_Grid_Container
{
    /**
     * Construct
     */
    public function __construct()
    {
        $this->_controller = "adminhtml_banner";
        $this->_blockGroup = "aion_rbanner";
        $this->_headerText = Mage::helper("aion_rbanner")->__("Banner Manager");
        $this->_addButtonLabel = $this->__('Add new banner');

        parent::__construct();
    }

}
