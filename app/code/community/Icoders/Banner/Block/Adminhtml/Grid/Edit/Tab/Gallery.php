<?php
/**
 * app/code/community/Icoders/Banner/Block/Adminhtml/Grid/Edit/Tab/Gallery.php
 *
 * @category  Icoders
 * @package   Icoders_Banner
 * @author    iCoders <support@icoders.co>
 * @copyright 2016 Icoders (http://www.icoders.co)
 * @license   http://icoders.co/license Icoders License
 * @link      http://www.icoders.co
 */

/**
 * Class Icoders_Banner_Block_Adminhtml_Grid_Edit_Tab_Gallery
 */
class Icoders_Banner_Block_Adminhtml_Grid_Edit_Tab_Gallery
    extends Mage_Adminhtml_Block_Widget
    implements Mage_Adminhtml_Block_Widget_Tab_Interface
{

    /**
     * Get tab label
     *
     * @return Icoders_Banner_Helper_Data
     */
    public function getTabLabel()
    {
        return $this->_getHelper()->__('Images');
    }

    /**
     * Get tab title
     *
     * @return Icoders_Banner_Helper_Data
     */
    public function getTabTitle()
    {
        return $this->_getHelper()->__('Images');
    }

    /**
     * Can show tab
     *
     * @return bool
     */
    public function canShowTab()
    {
        return true;
    }

    /**
     * Is hidden
     *
     * @return bool
     */
    public function isHidden()
    {
        return false;
    }

    /**
     * Prepare layout
     *
     * @return Mage_Core_Block_Abstract
     */
    protected function _prepareLayout()
    {
        $this->setChild(
            'uploader',
            $this->getLayout()->createBlock('adminhtml/media_uploader')
        );

        if ($this->_getHelper()->isNoFlashUploader()) {
            // PATCH SUPEE-8788 or Magento 1.9.3
            $this->getUploader()->getUploaderConfig()
                ->setFileParameterName('image')
                ->setTarget(
                    Mage::getModel('adminhtml/url')->addSessionParam()->getUrl('*/*/upload')
                );

            $browseConfig = $this->getUploader()->getButtonConfig();
            $browseConfig
                ->setAttributes(
                    array("accept" => $browseConfig->getMimeTypesByExtensions('gif, png, jpeg, jpg'))
                );
        } else {
            $this->getUploader()->getConfig()
                ->setUrl(
                    Mage::getModel('adminhtml/url')->addSessionParam()->getUrl('*/*/upload')
                )
                ->setFileField('image')
                ->setFilters(
                    array(
                        'images' => array(
                            'label' => Mage::helper('adminhtml')->__('Images (.gif, .jpg, .png)'),
                            'files' => array('*.gif', '*.jpg', '*.jpeg', '*.png')
                        )
                    )
                );
        }

        Mage::dispatchEvent('catalog_product_gallery_prepare_layout', array('block' => $this));

        return parent::_prepareLayout();
    }

    /**
     * Retrieve uploader block
     *
     * @return Mage_Adminhtml_Block_Media_Uploader
     */
    public function getUploader()
    {
        return $this->getChild('uploader');
    }

    /**
     * Retrieve uploader block html
     *
     * @return string
     */
    public function getUploaderHtml()
    {
        return $this->getChildHtml('uploader');
    }

    /**
     * Get JsObject name
     *
     * @return string
     */
    public function getJsObjectName()
    {
        return $this->getHtmlId() . 'JsObject';
    }

    /**
     * Return "Add New Images" button
     *
     * @return string
     */
    public function getAddImagesButton()
    {
        return $this->getButtonHtml(
            Mage::helper('icoders_banner')->__('Add New Images'),
            $this->getJsObjectName() . '.showUploader()',
            'add',
            $this->getHtmlId() . '_add_images_button'
        );
    }


    /**
     * Images to Json
     *
     * @return mixed|string
     */
    public function getImagesJson()
    {
        /** @var Icoders_Banner_Model_Banner $model */
        $model = Mage::registry('banner_item');

        if ($model->getId()) {
            $images = Mage::getModel('icoders_banner/images')->getCollection()
                ->addFieldToFilter('banner_id', $model->getId())
                ->setOrder('position');

            $result = array();

            foreach ($images as $_img) {
                $data = $_img->getData();
                $data['url'] = Mage::getBaseUrl(Mage_Core_Model_Store::URL_TYPE_MEDIA) . '/banners' . $_img->getFile();
                $result[] = $data;
            }

            $content = Mage::helper('core')->jsonEncode($result);
            return $content;

        }

        return '[]';
    }


    /**
     * Image values
     *
     * @return string (json)
     */
    public function getImagesValuesJson()
    {
        $values = array();
        foreach ($this->getMediaAttributes() as $attribute) {
            /** @var $attribute Mage_Eav_Model_Entity_Attribute */
            //$values[$attribute->getAttributeCode()] = $attribute->getValue();
        }
        return Mage::helper('core')->jsonEncode($values);
    }

    /**
     * Get Image types
     *
     * @return array
     */
    public function getImageTypes()
    {
        $imageTypes = array();

        foreach ($this->getMediaAttributes() as $attribute) {
            /** @var $attribute Mage_Eav_Model_Entity_Attribute */
            $imageTypes[$attribute->getAttributeCode()] = array(
                'label' => $attribute->getLabel(),
                'field' => $attribute->getLabel()
            );
        }
        return $imageTypes;
    }


    /**
     * Get Media Attributes
     *
     * @return array
     */
    public function getMediaAttributes()
    {
        $attributeCollection = new Varien_Data_Collection();
        $attribute = new Varien_Object(
            array(
                'attribute_code' => 'attribute1',
                'label'          => 'attribute1'
            )
        );
        $attributeCollection->addItem($attribute);

        return $attributeCollection;
    }

    /**
     * Get image types
     *
     * @return string (json)
     */
    public function getImageTypesJson()
    {
        return Mage::helper('core')->jsonEncode($this->getImageTypes());
    }

    /**
     * Get Store id
     *
     * @return int
     */
    protected function _getStoreId()
    {
        return Mage::app()->getStore(true)->getId();
    }

    /**
     * Get helper
     *
     * @return Icoders_Banner_Helper_Data
     */
    protected function _getHelper()
    {
        return Mage::helper('icoders_banner');
    }

    /**
     * Get element
     *
     * @return Icoders_Banner_Model_Banner
     */
    public function getElement()
    {
        return Mage::registry('banner_item');
    }

}
