<?php
/**
 * app/code/community/Icoders/Banner/Helper/Data.php
 *
 * @category  Icoders
 * @package   Icoders_Banner
 * @author    iCoders <support@icoders.co>
 * @copyright 2016 Icoders (http://www.icoders.co)
 * @license   http://icoders.co/license Icoders License
 * @link      http://www.icoders.co
 */

/**
 * Class Icoders_Banner_Helper_Data
 */
class Icoders_Banner_Helper_Data extends Mage_Core_Helper_Abstract
{

    /**
     * Is enabled module on frontend
     *
     * @return bool
     */
    public function isEnabled()
    {
        return Mage::getStoreConfig('icoders_banner/config/enabled');
    }

    /**
     * is no flash uploader
     *
     * @return bool
     */
    public function isNoFlashUploader()
    {
        return class_exists('Mage_Uploader_Block_Abstract');
    }

    /**
     * get flow min
     *
     * @return null|string
     */
    public function getFlowMin()
    {
        return $this->isNoFlashUploader() ? 'lib/uploader/flow.min.js' : null;
    }

    /**
     * get fusty flow
     *
     * @return null|string
     */
    public function getFustyFlow()
    {
        return $this->isNoFlashUploader() ? 'lib/uploader/fusty-flow.js' : null;
    }

    /**
     * get fusty flow factory
     *
     * @return null|string
     */
    public function getFustyFlowFactory()
    {
        return $this->isNoFlashUploader() ? 'lib/uploader/fusty-flow-factory.js' : null;
    }

    /**
     * get adminhtml uploader instance
     *
     * @return null|string
     */
    public function getAdminhtmlUploaderInstance()
    {
        return $this->isNoFlashUploader() ? 'mage/adminhtml/uploader/instance.js' : null;
    }

}
