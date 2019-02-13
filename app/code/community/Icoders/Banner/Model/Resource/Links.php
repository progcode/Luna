<?php
/**
 * app/code/community/Icoders/Banner/Model/Resource/Links.php
 *
 * @category  Icoders
 * @package   Icoders_Banner
 * @author    iCoders <support@icoders.co>
 * @copyright 2016 Icoders (http://www.icoders.co)
 * @license   http://icoders.co/license Icoders License
 * @link      http://www.icoders.co
 */

/**
 * Class Icoders_Banner_Model_Resource_Links
 */
class Icoders_Banner_Model_Resource_Links extends Mage_Core_Model_Resource_Db_Abstract
{

    /**
     * Constructor
     *
     * @return void
     */
    protected function _construct()
    {
        $this->_init('icoders_banner/links', 'entity_id');
    }

}
