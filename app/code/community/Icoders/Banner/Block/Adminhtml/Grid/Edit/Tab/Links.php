<?php
/**
 * app/code/community/Icoders/Banner/Block/Adminhtml/Grid/Edit/Tab/Links.php
 *
 * PHP Version 5
 *
 * @category  Icoders
 * @package   Icoders_Banner
 * @author    iCoders <support@icoders.co>
 * @copyright 2016 Icoders (http://www.icoders.co)
 * @license   http://icoders.co/license Icoders License
 * @link      http://www.icoders.co
 *
 */

/**
 * Class Icoders_Banner_Block_Adminhtml_Grid_Edit_Tab_Links
 */
class Icoders_Banner_Block_Adminhtml_Grid_Edit_Tab_Links
    extends Mage_Adminhtml_Block_Abstract
    implements Varien_Data_Form_Element_Renderer_Interface
{

    /**
     * Initialize block
     */
    public function __construct()
    {
        parent::__construct();
        $this->setTemplate('icoders/banner/edit/tab/links.phtml');
    }

    /**
     * Render HTML
     *
     * @param Varien_Data_Form_Element_Abstract $element element
     *
     * @return string
     */
    public function render(Varien_Data_Form_Element_Abstract $element)
    {
        $this->setElement($element);
        return $this->toHtml();
    }

    /**
     * Get link(s) data
     *
     * @return mixed
     */
    public function getOptions()
    {
        $banner = Mage::registry('banner_item');

        if ($banner->getId()) {
            $collection = Mage::getModel('icoders_banner/links')->getCollection()
                              ->addFieldToFilter('banner_id', $banner->getId());

            return $collection;
        }

        return null;
    }

}
