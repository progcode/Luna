<?php
/**
 * app/code/community/Icoders/Banner/Model/Images.php
 *
 * @category  Icoders
 * @package   Icoders_Banner
 * @author    iCoders <support@icoders.co>
 * @copyright 2016 Icoders (http://www.icoders.co)
 * @license   http://icoders.co/license Icoders License
 * @link      http://www.icoders.co
 */

/**
 * Class Icoders_Banner_Model_Images
 *
 * @method int getEntityId()
 * @method int getBannerId()
 * @method string getLabel()
 * @method string getFile()
 * @method string getLink()
 * @method string getHtml()
 * @method int getPosition()
 * @method bool getExclude()
 * @method Icoders_Banner_Model_Images setEntityId($value)
 * @method Icoders_Banner_Model_Images setBannerId($value)
 * @method Icoders_Banner_Model_Images setLabel($value)
 * @method Icoders_Banner_Model_Images setFile($value)
 * @method Icoders_Banner_Model_Images setLink($value)
 * @method Icoders_Banner_Model_Images setHtml($value)
 * @method Icoders_Banner_Model_Images setPosition($value)
 * @method Icoders_Banner_Model_Images setExclude($value)
 */
class Icoders_Banner_Model_Images extends Mage_Core_Model_Abstract
{
    /**
     * Constructor
     *
     * @return void
     */
    protected function _construct()
    {
        $this->_init('icoders_banner/images');
    }

    /**
     * Get Image Url
     *
     * @param bool $resize resize image
     *
     * @return string
     */
    public function getImageUrl($resize = true)
    {
        if ($resize) {

            $banner = Mage::getModel('icoders_banner/banner')->load($this->getBannerId());

            $imagePath = Mage::helper('icoders_banner/image')->resize(
                $this->getFile(),
                $banner->getWidth(),
                $banner->getHeight()
            );

            if ($imagePath) {
                return $imagePath;
            }

        }

        return Mage::getBaseUrl(Mage_Core_Model_Store::URL_TYPE_MEDIA) .
        Icoders_Banner_Helper_Image::MEDIA_PATH . $this->getFile();
    }

}
