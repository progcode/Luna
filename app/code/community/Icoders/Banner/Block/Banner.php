<?php
/**
 * app/code/community/Icoders/Banner/Block/Banner.php
 *
 * @category  Icoders
 * @package   Icoders_Banner
 * @author    iCoders <support@icoders.co>
 * @copyright 2016 Icoders (http://www.icoders.co)
 * @license   http://icoders.co/license Icoders License
 * @link      http://www.icoders.co
 */

/**
 * Class Icoders_Banner_Block_Banner
 */
class Icoders_Banner_Block_Banner extends Mage_Core_Block_Template
{

    /**
     * Constructor
     *
     * @throws Exception
     *
     * @return void
     */
    protected function _construct()
    {
        $this->addData(
            array(
                'cache_lifetime' => 120,
                'cache_tags'     => array(Icoders_Banner_Model_Banner::CACHE_TAG),
                'cache_key'      => 'AIONBANNER_STORE_' .
                    Mage::app()->getStore()->getId() .
                    '_ID_' . $this->getRequest()->getRequestUri()
            )
        );

        $this->setTemplate('icoders/banner/banner.phtml');
    }


    /**
     * Get banner
     *
     * @param int|string $identifier banner id or title
     *
     * @return Icoders_Banner_Model_Banner
     */
    public function getBanner($identifier = null)
    {
        if (is_null($identifier)) {
            $identifier = $this->getData('banner_id');
        }

        $position = $this->getPosition();

        $constant = "Icoders_Banner_Model_Config_Source_Position::{$position}";
        $_posId = defined($constant) ? constant($constant) : null;

        $banners = Mage::getModel('icoders_banner/banner')->getCollection()
            ->addEnabledFilter();

        if (!Mage::app()->isSingleStoreMode()) {
            $banners->addStoreFilter(Mage::app()->getStore()->getId());
        }

        if ($_posId) {
            $banners->addFieldToFilter('position', $_posId);
        }

        if (Mage::registry('current_category')) {
            $banners->addCategoryFilter(
                Mage::registry('current_category')->getId()
            );
        } elseif (Mage::app()->getFrontController()->getRequest()->getRouteName() == 'cms') {
            $banners->addPageFilter(
                Mage::getBlockSingleton('cms/page')->getPage()->getPageId()
            );
        }

        if ($identifier) {

            if (is_numeric($identifier)) {
                $banners->addFieldToFilter('entity_id', $identifier);
            } else {
                $banners->addFieldToFilter('title', $identifier);
            }
        }

        return $banners->getFirstItem();
    }

}
