<?php
/**
 * @category  Icoders
 * @package   Icoders_Slider
 * @author    iCoders <support@icoders.co>
 * @copyright 2017 Icoders (http://icoders.co)
 * @license   http://icoders.co/licence Icoders License
 * @link      http://icoders.co
 */

/**
 * Class Icoders_Slider_Helper_Admin
 */
class Icoders_Slider_Helper_Admin extends Mage_Core_Helper_Abstract
{
    /**
     * Check permission for passed action
     *
     * @param string $action action
     *
     * @return bool
     */
    public function isActionAllowed($action)
    {
        return Mage::getSingleton('admin/session')->isAllowed('icoders/slider/manage/' . $action);
    }

}
