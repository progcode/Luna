<?php
/**
 * app/code/community/Icoders/Banner/controllers/Adminhtml/Icoders/BannerController.php
 *
 * @category  Icoders
 * @package   Icoders_Banner
 * @author    iCoders <support@icoders.co>
 * @copyright 2016 Icoders (http://www.icoders.co)
 * @license   http://icoders.co/license Icoders License
 * @link      http://www.icoders.co
 */

/**
 * Class Icoders_Banner_Adminhtml_Icoders_BannerController
 */
class Icoders_Banner_Adminhtml_Icoders_BannerController extends Mage_Adminhtml_Controller_Action
{

    const UPLOAD_DIR = 'banners';

    /**
     * Init actions
     *
     * @return $this
     */
    protected function _initAction()
    {
        $this->loadLayout()
            ->_setActiveMenu('cms/icoders_banner')
            ->_addBreadcrumb(
                $this->getHelper()->__('Banner'),
                $this->getHelper()->__('Banner')
            )
            ->_addBreadcrumb(
                $this->getHelper()->__('Manage Banner'),
                $this->getHelper()->__('Manage Banner')
            );

        return $this;
    }

    /**
     * Index action
     *
     * @return void
     */
    public function indexAction()
    {
        $this->_initAction();
        $this->renderLayout();
    }

    /**
     * Create new Banner item
     *
     * @return void
     */
    public function newAction()
    {
        $this->_forward('edit');
    }

    /**
     * Edit Banner item
     *
     * @return void
     */
    public function editAction()
    {
        $this->_title($this->getHelper()->__('Banner'))
            ->_title($this->getHelper()->__('Manage Banner'));

        /** @var $model Icoders_Banner_Model_Banner */
        $model = Mage::getModel('icoders_banner/banner');

        $bannerId = $this->getRequest()->getParam('id');

        if ($bannerId) {

            $model->load($bannerId);

            if (!$model->getId()) {
                $this->_getSession()->addError(
                    $this->getHelper()->__('Banner item does not exist.')
                );

                $this->_redirect('*/*/');
                return;
            }

            $this->_title($model->getTitle());
            $breadCrumb = $this->getHelper()->__('Edit Item');

        } else {

            $this->_title($this->getHelper()->__('New Item'));
            $breadCrumb = $this->getHelper()->__('New Item');

        }

        $this->_initAction()->_addBreadcrumb($breadCrumb, $breadCrumb);

        $this->getLayout()->getBlock('head')->setCanLoadExtJs(true);

        $data = Mage::getSingleton('adminhtml/session')->getFormData(true);
        if (!empty($data)) {
            $model->addData($data);
        }

        Mage::register('banner_item', $model);

        $this->renderLayout();
    }

    /**
     * Delete action
     *
     * @return void
     */
    public function deleteAction()
    {
        $id = $this->getRequest()->getParam('id');

        if (intval($id) == 0) {
            $this->_getSession()->addError($this->getHelper()->__('Please select Banner.'));
        } else {
            try {
                $model = Mage::getSingleton('icoders_banner/banner')->load($id);
                $model->delete();
                $this->_getSession()->addSuccess(
                    $this->getHelper()->__('Banner was successfully deleted')
                );
            } catch (Mage_Core_Exception $e) {
                $this->_getSession()->addError($e->getMessage());
            } catch (Exception $e) {
                $this->_getSession()->addError(
                    $this->getHelper()->__('An error occurred while deleting Banner. Please review log and try again.')
                );
                Mage::logException($e);

                return;
            }
        }
        $this->_redirect('*/*/index');
    }

    /**
     * Mass delete action
     *
     * @return void
     */
    public function massDeleteAction()
    {
        $ids = $this->getRequest()->getParam('ids');

        if (!is_array($ids)) {
            $this->_getSession()->addError($this->getHelper()->__('Please select Banner(s).'));
        } else {
            try {
                foreach ($ids as $id) {
                    $model = Mage::getSingleton('icoders_banner/banner')->load($id);
                    $model->delete();
                }

                $this->_getSession()->addSuccess(
                    $this->getHelper()->__('Total of %d record(s) have been deleted.', count($ids))
                );
            } catch (Mage_Core_Exception $e) {
                $this->_getSession()->addError($e->getMessage());
            } catch (Exception $e) {
                $this->_getSession()->addError(
                    $this->getHelper()->__('An error occurred while mass deleting items. Please review log and try again.')
                );
                Mage::logException($e);

                return;
            }
        }
        $this->_redirect('*/*/index');
    }

    /**
     * Upload action
     *
     * @return void
     */
    public function uploadAction()
    {
        try {
            $uploader = new Varien_File_Uploader('image');
            $uploader->setAllowedExtensions(array('jpg', 'jpeg', 'gif', 'png'));

            $uploader->addValidateCallback(
                'catalog_product_image',
                Mage::helper('catalog/image'),
                'validateUploadFile'
            );

            $uploader->setAllowRenameFiles(true);
            $uploader->setFilesDispersion(true);
            $result = $uploader->save(
                Mage::getBaseDir(Mage_Core_Model_Store::URL_TYPE_MEDIA) . DS . self::UPLOAD_DIR
            );

            $result['tmp_name'] = str_replace(DS, "/", $result['tmp_name']);
            $result['path'] = str_replace(DS, "/", $result['path']);
            $tempUrl = str_replace(DS, '/', $result['file']);

            if (substr($tempUrl, 0, 1) == '/') {
                $tempUrl = substr($tempUrl, 1);
            }

            $result['url'] = Mage::getBaseUrl(Mage_Core_Model_Store::URL_TYPE_MEDIA) . self::UPLOAD_DIR . '/' . $tempUrl;

            $result['file'] = $result['file'];

            $result['cookie'] = array(
                'name'     => session_name(),
                'value'    => $this->_getSession()->getSessionId(),
                'lifetime' => $this->_getSession()->getCookieLifetime(),
                'path'     => $this->_getSession()->getCookiePath(),
                'domain'   => $this->_getSession()->getCookieDomain()
            );

        } catch (Exception $e) {
            $result = array(
                'error'     => $e->getMessage(),
                'errorcode' => $e->getCode());
        }

        $this->getResponse()->setBody(Mage::helper('core')->jsonEncode($result));
    }


    /**
     * Save action
     *
     * @return void
     */
    public function saveAction()
    {

        if ($data = $this->getRequest()->getPost()) {

            $model = Mage::getModel('icoders_banner/banner');

            if (isset($data['stores']) && !empty($data['stores'])) {
                if (in_array('0', $data['stores'])) {
                    $data['stores'] = array(0);
                }

                $data['stores'] = implode(',', $data['stores']);
            }
            if (isset($data['categories'])) {
                $data['categories'] = explode(',', $data['categories']);
                if (is_array($data['categories'])) {
                    $categoryIds = array_unique($data['categories']);
                    if (empty($categoryIds)) {
                        $data['category_id'] = '';
                    } else {
                        $data['category_id'] = implode(',', $categoryIds);
                    }

                }
            }
            if (isset($data['pages']) && !empty($data['pages'])) {
                if (empty($data['pages'][0])) {
                    unset($data['pages'][0]);
                }
                if (!empty($data['pages'])) {
                    $pageIds = implode(',', $data['pages']);
                    $data['page_id'] = $pageIds;
                } else {
                    $data['page_id'] = '';
                }
            }

            if (isset($data['links']) && !empty($data['links'])) {
                $data['menus'] = Mage::helper('core')->jsonEncode($data['links']);
            } else {
                $data['menus'] = '';
            }

            $model->setData($data)->setId($this->getRequest()->getParam('id'));

            try {
                if ($model->getCreatedTime() == null || $model->getUpdateTime() == null) {
                    $model->setCreatedTime(now())
                        ->setUpdateTime(now());
                } else {
                    $model->setUpdateTime(now());
                }

                $model->save();

                // save images
                if (isset($data['banner_tabs']['images']) && !empty($data['banner_tabs']['images'])) {
                    $images = Mage::helper('core')->jsonDecode($data['banner_tabs']['images'], true);
                    foreach ($images as $key => $image) {
                        if (isset($image['removed']) && $image['removed'] == 1) {
                            Mage::getModel('icoders_banner/images')->load($image['entity_id'])->delete();
                        } else {
                            $image['banner_id'] = $model->getId();
                            Mage::getModel('icoders_banner/images')->setData($image)->save();
                        }
                    }
                    unset($data['banner_tabs']['images']);
                }


                $coll = Mage::getModel('icoders_banner/links')->getCollection()
                    ->addFieldToFilter('banner_id', $model->getId());

                foreach ($coll as $item) {
                    $item->delete();
                }

                if (isset($data['links']) && !empty($data['links'])) {

                    foreach ($data['links']['value'] as $link) {
                        $link['banner_id'] = $model->getId();
                        $link['link'] = $link['url'];

                        Mage::getModel('icoders_banner/links')->setData($link)->save();
                    }
                }

                Mage::getSingleton('adminhtml/session')->addSuccess(
                    $this->getHelper()->__('Banner was successfully saved')
                );

                Mage::getSingleton('adminhtml/session')->setFormData(false);

                if ($this->getRequest()->getParam('back')) {
                    $this->_redirect('*/*/edit', array('id' => $model->getId()));
                    return;
                }
                $this->_redirect('*/*/');
                return;
            } catch (Exception $e) {
                Mage::getSingleton('adminhtml/session')->addError($e->getMessage());
                Mage::getSingleton('adminhtml/session')->setFormData($data);
                $this->_redirect('*/*/edit', array('id' => $this->getRequest()->getParam('id')));
                return;
            }
        }
        Mage::getSingleton('adminhtml/session')->addError(
            $this->getHelper()->__('Unable to find Banner to save')
        );

        $this->_redirect('*/*/');
    }

    /**
     * Check the permission to run it
     *
     * @return boolean
     */
    protected function _isAllowed()
    {
        return Mage::helper('icoders_banner/admin')->isActionAllowed(
            $this->getRequest()->getActionName()
        );
    }

    /**
     * Flush News Posts Images Cache action
     *
     * @return void
     */
    public function flushAction()
    {
        if (Mage::helper('icoders_banner/image')->flushImagesCache()) {
            $this->_getSession()->addSuccess(
                $this->getHelper()->__('Cache successfully flushed')
            );
        } else {
            $this->_getSession()->addError(
                $this->getHelper()->__('There was error during flushing cache')
            );
        }
        $this->_forward('index');
    }

    /**
     * CategoriesJson action
     *
     * @return void
     */
    public function categoriesJsonAction()
    {
        $bannerId = $this->getRequest()->getParam('id');
        $_model = Mage::getModel('icoders_banner/banner')->load($bannerId);
        Mage::register('banner_item', $_model);

        $this->getResponse()->setBody(
            $this->getLayout()
                ->createBlock('icoders_banner/adminhtml_grid_edit_tab_category')
                ->getCategoryChildrenJson(
                    $this->getRequest()->getParam('category')
                )
        );
    }

    /**
     * Get helper
     *
     * @return Icoders_Banner_Helper_Data
     */
    public function getHelper()
    {
        return Mage::helper('icoders_banner');
    }

}
