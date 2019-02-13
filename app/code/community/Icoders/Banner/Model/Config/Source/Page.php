<?php
/**
 * app/code/community/Icoders/Banner/Model/Config/Source/Page.php
 *
 * PHP Version 5
 *
 * @category  Icoders
 * @package   Icoders_Banner
 * @author    iCoders <support@icoders.co>
 * @copyright 2016 Icoders (http://www.icoders.co)
 * @license   http://icoders.co/license Icoders License
 * @link      http://www.icoders.co
 */

/**
 * Class Icoders_Banner_Model_Config_Source_Page
 */
class Icoders_Banner_Model_Config_Source_Page
{
    /**
     * Options getter
     *
     * @return array
     */
    public function toOptionArray()
    {
        $_collection = Mage::getSingleton('cms/page')
            ->getCollection()
            ->addFieldToFilter('is_active', 1);

        $_result = array();
        $_result[] = array(
            'value' => '',
            'label' => ''
        );
        $_result[] = array(
            'value' => '9999999',
            'label' => 'All Pages',
        );

        foreach ($_collection as $item) {
            $data = array(
                'value' => $item->getData('page_id'),
                'label' => $item->getData('title'));
            $_result[] = $data;
        }
        return $_result;
    }

}
