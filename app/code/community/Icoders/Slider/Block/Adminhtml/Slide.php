<?php

/**
 * Aion_Rbanner_Block_Adminhtml_Slide
 *
 * @category  Aion
 * @package   Aion_Rbanner
 * @author    Dombi István <istvan.dombi@aionhill.com>
 * @copyright 2013 AionNext Kft. (http://aionhill.com)
 * @license   Aion License http://aionhill.com/licence
 * @link      http://www.aion.hu
 */
class Aion_Rbanner_Block_Adminhtml_Slide extends Mage_Adminhtml_Block_Widget_Grid_Container
{
    /**
     * Construct
     */
    public function __construct()
    {
        $this->_controller     = "adminhtml_slide";
        $this->_blockGroup     = "aion_rbanner";
        $this->_headerText     = Mage::helper("aion_rbanner")->__("Manage Slides");
        $this->_addButtonLabel = Mage::helper("aion_rbanner")->__("Add New Slide");
        parent::__construct();

    }
}
