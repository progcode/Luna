<?php
/**
 * app/code/community/Icoders/Banner/Model/Links.php
 *
 * @category  Icoders
 * @package   Icoders_Banner
 * @author    iCoders <support@icoders.co>
 * @copyright 2016 Icoders (http://www.icoders.co)
 * @license   http://icoders.co/license Icoders License
 * @link      http://www.icoders.co
 */

/**
 * Class Icoders_Banner_Model_Links
 *
 * @method int getEntityId()
 * @method int getBannerId()
 * @method string getTitle()
 * @method string getLink()
 * @method string getTarget()
 * @method Icoders_Banner_Model_Links setEntityId($value)
 * @method Icoders_Banner_Model_Links setBannerId($value)
 * @method Icoders_Banner_Model_Links setTitle($value)
 * @method Icoders_Banner_Model_Links setLink($value)
 * @method Icoders_Banner_Model_Links setTarget($value)
 */
class Icoders_Banner_Model_Links extends Mage_Core_Model_Abstract
{

    /**
     * Constructor
     *
     * @return void
     */
    protected function _construct()
    {
        $this->_init('icoders_banner/links');
    }

}
