<?php
/**
 * Aion_Rbanner_Block_Adminhtml_Banner_Grid_Renderer_Status
 *
 * @category  Aion
 * @package   Aion_Rbanner
 * @author    Dombi István <istvan.dombi@aionhill.com>
 * @copyright 2013 AionNext Kft. (http://aionhill.com)
 * @license   Aion License http://aionhill.com/licence
 * @link      http://www.aion.hu
 */
class Aion_Rbanner_Block_Adminhtml_Banner_Grid_Renderer_Status extends Mage_Adminhtml_Block_Widget_Grid_Column_Renderer_Abstract
{
    /**
     * Render column
     *
     * @param Varien_Object $row row data
     *
     * @return string
     */
    public function render(Varien_Object $row)
    {
        if ($row['status'] == Aion_Rbanner_Model_Resource_Banner_Collection::STATUS_ENABLED) {
            return Mage::helper('aion_rbanner')->__('Enabled');
        } else {
            return Mage::helper('aion_rbanner')->__('Disabled');
        }
    }
}
