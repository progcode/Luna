<?php

/**
 * Aion_Rbanner_Block_Adminhtml_Slide_Grid_Renderer_Banner
 *
 * @category  Aion
 * @package   Aion_Rbanner
 * @author    Dombi István <istvan.dombi@aionhill.com>
 * @copyright 2013 AionNext Kft. (http://aionhill.com)
 * @license   Aion License http://aionhill.com/licence
 * @link      http://www.aion.hu
 */
class Aion_Rbanner_Block_Adminhtml_Slide_Grid_Renderer_Banner extends Mage_Adminhtml_Block_Widget_Grid_Column_Renderer_Abstract
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
        if (null === $row['banner_id']) {
            return Mage::helper('aion_rbanner')->__('<strong>No Banner Connected</strong>');
        } else {
            $banner = Mage::getModel('aion_rbanner/banner')->load($row['banner_id']);
            if (!$banner) {
                return Mage::helper('aion_rbanner')->__('<strong>Banner does not exist</strong>');
            } else {
                $link = Mage::helper("adminhtml")->getUrl("*/banner/edit", ['id' => $row['banner_id']]);
                return "<a href=\"{$link}\">{$banner->getTitle()}</a>";
            }
        }
    }
}
