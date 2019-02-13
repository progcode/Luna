<?php
/**
 * app/code/community/Icoders/Banner/Model/Banner.php
 *
 * @category  Icoders
 * @package   Icoders_Banner
 * @author    iCoders <support@icoders.co>
 * @copyright 2016 Icoders (http://www.icoders.co)
 * @license   http://icoders.co/license Icoders License
 * @link      http://www.icoders.co
 */

/**
 * Class Icoders_Banner_Model_Banner
 *
 * @method int getEntityId()
 * @method string getTitle()
 * @method string getContent()
 * @method string getStores()
 * @method int getStatus()
 * @method string getCreatedAt()
 * @method string getUpdatedAt()
 * @method int getHeight()
 * @method int getWidth()
 * @method string getPageId()
 * @method string getCategoryId()
 * @method string getPosition()
 * @method string getAdvancedSettings()
 * @method Icoders_Banner_Model_Banner setEntityId($value)
 * @method Icoders_Banner_Model_Banner setTitle($value)
 * @method Icoders_Banner_Model_Banner setContent($value)
 * @method Icoders_Banner_Model_Banner setStores($value)
 * @method Icoders_Banner_Model_Banner setStatus($value)
 * @method Icoders_Banner_Model_Banner setCreatedAt($value)
 * @method Icoders_Banner_Model_Banner setUpdatedAt($value)
 * @method Icoders_Banner_Model_Banner setHeight($value)
 * @method Icoders_Banner_Model_Banner setWidth($value)
 * @method Icoders_Banner_Model_Banner setPageId($value)
 * @method Icoders_Banner_Model_Banner setCategoryId($value)
 * @method Icoders_Banner_Model_Banner setPosition($value)
 * @method Icoders_Banner_Model_Banner setAdvancedSettings($value)
 */
class Icoders_Banner_Model_Banner extends Mage_Core_Model_Abstract
{
    const CACHE_TAG = 'banner';

    /**
     * Constructor
     *
     * @return void
     */
    protected function _construct()
    {
        $this->_init('icoders_banner/banner');
    }

    /**
     * Get banner images
     *
     * @return Icoders_Banner_Model_Resource_Images_Collection|null
     */
    public function getImages()
    {
        if ($this->getId()) {
            return Mage::getModel('icoders_banner/images')->getCollection()
                ->addFieldToFilter('banner_id', $this->getId())
                ->addFieldToFilter('exclude', 0)
                ->setOrder('position', 'asc');
        }
        return null;
    }

    /**
     * Get banner links
     *
     * @return Icoders_Banner_Model_Resource_Links_Collection|null
     */
    public function getLinks()
    {
        if ($this->getId()) {
            return Mage::getModel('icoders_banner/links')->getCollection()
                       ->addFieldToFilter('banner_id', $this->getId());
        }
        return null;
    }

}
