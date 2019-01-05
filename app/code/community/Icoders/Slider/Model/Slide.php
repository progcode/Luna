<?php
/**
 * @category  Aion
 * @package   Aion_Rbanner
 * @author    Dombi István <istvan.dombi@aionhill.com>
 * @copyright 2017 AionNext Kft. (http://aionhill.com)
 * @license   http://aionhill.com/licence Aion License
 * @link      http://aionhill.com
 */

/**
 * Class Aion_Rbanner_Model_Slide
 * @method int getEntityId()
 * @method int getBannerId()
 * @method string getTitle()
 * @method string getDesktopImage()
 * @method string getTabletImage()
 * @method string getMobileImage()
 * @method string getLink()
 * @method string getHtml()
 * @method int getPosition()
 * @method Aion_Rbanner_Model_Slide setEntityId($value)
 * @method Aion_Rbanner_Model_Slide setBannerId($value)
 * @method Aion_Rbanner_Model_Slide setTitle($value)
 * @method Aion_Rbanner_Model_Slide setDesktopImage($value)
 * @method Aion_Rbanner_Model_Slide setTabletImage($value)
 * @method Aion_Rbanner_Model_Slide setMobileImage($value)
 * @method Aion_Rbanner_Model_Slide setLink($value)
 * @method Aion_Rbanner_Model_Slide setHtml($value)
 * @method Aion_Rbanner_Model_Slide setPosition($value)
 */
class Aion_Rbanner_Model_Slide extends Mage_Core_Model_Abstract
{
    /** @var string */
    const CACHE_TAG = 'rbanner_slide';
    /** @var string */
    const SLIDE_TYPE_DESKTOP = 'desktop';
    /** @var string */
    const SLIDE_TYPE_TABLET = 'tablet';
    /** @var string */
    const SLIDE_TYPE_MOBILE = 'mobile';
    /** @var string */
    const SLIDE_TYPE_DEFAULT = self::SLIDE_TYPE_DESKTOP;

    /**
     * Constructor
     *
     * @return void
     */
    protected function _construct()
    {
        $this->_init('aion_rbanner/slide');
    }

    /**
     * Get Image Url
     *
     * @param string $type type
     *
     * @return string|null
     */
    public function getImageUrl($type = self::SLIDE_TYPE_DEFAULT)
    {
        $types = [self::SLIDE_TYPE_DESKTOP, self::SLIDE_TYPE_TABLET, self::SLIDE_TYPE_MOBILE];
        if (in_array($type, $types)) {
            $key = "{$type}_image";
            $val = $this->getData($key);
            if (!$val && ($idx = array_search($key, $types)) > 0) {
                $idx--;
                return $this->getImageUrl($types[$idx]);
            }
            return Mage::getBaseUrl(Mage_Core_Model_Store::URL_TYPE_MEDIA) . $val;
        }
        return null;
    }

    /**
     * @return null|string
     */
    public function getMobileImageUrl()
    {
        return $this->getImageUrl(self::SLIDE_TYPE_MOBILE);
    }

    /**
     * @return null|string
     */
    public function getTabletImageUrl()
    {
        return $this->getImageUrl(self::SLIDE_TYPE_TABLET);
    }

    /**
     * @return null|string
     */
    public function getDesktopImageUrl()
    {
        return $this->getImageUrl(self::SLIDE_TYPE_DESKTOP);
    }

}
