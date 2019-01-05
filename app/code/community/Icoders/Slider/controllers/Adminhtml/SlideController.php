<?php
/**
 * @category  Icoders
 * @package   Icoders_Slider
 * @author    Dombi István <istvan.dombi@icoders.co>
 * @copyright 2017 Icoders (http://icoders.co)
 * @license   http://icoders.co/licence Icoders License
 * @link      http://icoders.co
 */

/**
 * Class Icoders_Slider_Adminhtml_SlideController
 */
class Icoders_Slider_Adminhtml_SlideController extends Mage_Adminhtml_Controller_Action
{
    /** @var string */
    const UPLOAD_DIR = 'sliders';

    /**
     * Init actions
     *
     * @return $this
     */
    protected function _initAction()
    {
        $this->loadLayout()
            ->_setActiveMenu('cms/icoders_slider/icoders_slider_slide')
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
        $this->_initAction();
        $this->_title($this->getHelper()->__('Banners'))
            ->_title($this->getHelper()->__('Manage Slides'));

        /** @var $model Icoders_Slider_Model_Slide */
        $model = Mage::getModel('icoders_slider/slide');

        $slideId = $this->getRequest()->getParam('id');

        if ($slideId) {

            $model->load($slideId);

            if (!$model->getId()) {
                $this->_getSession()->addError(
                    $this->getHelper()->__('Slide does not exist.')
                );

                $this->_redirect('*/*/');
                return;
            }

            $this->_title($model->getTitle());
            $breadCrumb = $this->getHelper()->__('Edit Slide');

        } else {

            $this->_title($this->getHelper()->__('New Slide'));
            $breadCrumb = $this->getHelper()->__('New Slide');

        }

        $this->_initAction()->_addBreadcrumb($breadCrumb, $breadCrumb);

        $data = Mage::getSingleton('adminhtml/session')->getFormData(true);
        if (!empty($data)) {
            $model->addData($data);
        }

        Mage::register('slide_item', $model);

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
            $this->_getSession()->addError($this->getHelper()->__('Please select Slide.'));
        } else {
            try {
                $model = Mage::getSingleton('icoders_slider/slide')->load($id);
                $model->delete();
                $this->_getSession()->addSuccess(
                    $this->getHelper()->__('Slide was successfully deleted')
                );
            } catch (Mage_Core_Exception $e) {
                $this->_getSession()->addError($e->getMessage());
            } catch (Exception $e) {
                $this->_getSession()->addError(
                    $this->getHelper()->__('An error occurred while deleting Slide. Please review log and try again.')
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
            $this->_getSession()->addError($this->getHelper()->__('Please select Slide(s).'));
        } else {
            try {
                /** @var Icoders_Slider_Model_Resource_Slide_Collection $slides */
                $slides = Mage::getModel('icoders_slider/slide')->getCollection();
                $slides->addFieldToFilter('entity_id', $ids);
                foreach ($ids as $id) {
                    $model = $slides->getItemByColumnValue('entity_id', $id);
                    $model->delete();
                }

                $this->_getSession()->addSuccess(
                    $this->getHelper()->__('Total of %d slide(s) have been deleted.', count($ids))
                );
            } catch (Mage_Core_Exception $e) {
                $this->_getSession()->addError($e->getMessage());
            } catch (Exception $e) {
                $this->_getSession()->addError(
                    $this->getHelper()->__('An error occurred while mass deleting slides. Please review log and try again.')
                );
                Mage::logException($e);

                return;
            }
        }
        $this->_redirect('*/*/index');
    }

    /**
     * Save action
     *
     * @return void
     */
    public function saveAction()
    {

        if ($data = $this->getRequest()->getPost()) {

            $model = Mage::getModel('icoders_slider/slide');

            try {
                $uploadFiles = ['desktop_image', 'tablet_image', 'mobile_image'];

                foreach ($uploadFiles as $name) {
                    if (is_array($data[$name])) {
                        if (isset($data[$name]['delete']) || (isset($_FILES[$name]) && !empty($_FILES[$name]['tmp_name']))) {
                            $io = new Varien_Io_File();
                            $io->rm(Mage::getBaseDir('media') . DS . $data[$name]['value']);
                            $data[$name] = null;

                            if (isset($_FILES[$name]) && !empty($_FILES[$name]['tmp_name'])) {
                                $data[$name] = $this->_uploadImage($name);
                            }

                        } else if (!isset($_FILES[$name]) || empty($_FILES[$name]['tmp_name'])) {
                            $data[$name] = $data[$name]['value'];
                        }
                    } elseif (isset($_FILES[$name]) && !empty($_FILES[$name]['tmp_name'])) {
                        $data[$name] = $this->_uploadImage($name);
                    }
                }

                $model->setData($data)->setId($this->getRequest()->getParam('id'));

                $model->save();

                Mage::getSingleton('adminhtml/session')->addSuccess(
                    $this->getHelper()->__('Slide was successfully saved')
                );

                Mage::getSingleton('adminhtml/session')->setFormData(false);

                if ($this->getRequest()->getParam('back')) {
                    $this->_redirect('*/*/edit', array('id' => $model->getId()));
                    return;
                }
                $this->_redirect('*/*/');
                return;
            } catch (Exception $e) {
                $data['desktop_image'] = $data['tablet_image'] = $data['mobile_image'] = null;
                Mage::getSingleton('adminhtml/session')->addError($e->getMessage());
                Mage::getSingleton('adminhtml/session')->setFormData($data);
                $this->_redirect('*/*/edit', array('id' => $this->getRequest()->getParam('id')));
                return;
            }
        }

        Mage::getSingleton('adminhtml/session')->addError(
            $this->getHelper()->__('Unable to find Slide to save')
        );

        $this->_redirect('*/*/index');
    }

    /**
     * @param string $name name of the image input
     *
     * @return null|string
     */
    protected function _uploadImage($name)
    {
        if (isset($_FILES[$name]) && !empty($_FILES[$name]['tmp_name'])) {
            $uploader = new Varien_File_Uploader($name);
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
            if ($result['file']) {
                return '/' . self::UPLOAD_DIR . $result['file'];
            }
        }

        return null;
    }

    /**
     * Mass delete action
     *
     * @return void
     */
    public function massConnectAction()
    {
        $ids = $this->getRequest()->getParam('ids');

        if (!$this->getRequest()->getParam('banner_id')) {
            Mage::getSingleton('adminhtml/session')->addError('The banner is mandatory to connect with.');
        } else {
            if (!is_array($ids)) {
                $this->_getSession()->addError($this->getHelper()->__('Please select Slide(s).'));
            } else {
                try {
                    $collection = Mage::getModel('icoders_slider/slide')->getCollection();
                    $collection->addFieldToFilter('entity_id', ['in' => $ids]);
                    $collection->setDataToAll('banner_id', $this->getRequest()->getParam('banner_id'));
                    $collection->save();

                    $this->_getSession()->addSuccess(
                        $this->getHelper()->__('Total of %d record(s) have been connected.', count($ids))
                    );
                } catch (Mage_Core_Exception $e) {
                    $this->_getSession()->addError($e->getMessage());
                } catch (Exception $e) {
                    $this->_getSession()->addError(
                        $this->getHelper()->__('An error occurred while mass connect items. Please review log and try again.')
                    );
                    Mage::logException($e);

                    return;
                }
            }
        }
        $this->_redirectReferer();
    }

    /**
     * Mass delete action
     *
     * @return void
     */
    public function massDeconnectAction()
    {
        $ids = $this->getRequest()->getParam('ids');


        if (!is_array($ids)) {
            $this->_getSession()->addError($this->getHelper()->__('Please select Slide(s).'));
        } else {
            try {
                $collection = Mage::getModel('icoders_slider/slide')->getCollection();
                $collection->addFieldToFilter('entity_id', ['in' => $ids]);
                foreach ($collection as $slide) {
                    $slide->setbannerId(null);
                    $slide->save();
                }

                $this->_getSession()->addSuccess(
                    $this->getHelper()->__('Total of %d slide(s) have been disconnected from the banner.', count($ids))
                );
            } catch (Mage_Core_Exception $e) {
                $this->_getSession()->addError($e->getMessage());
            } catch (Exception $e) {
                $this->_getSession()->addError(
                    $this->getHelper()->__('An error occurred while mass connect items. Please review log and try again.')
                );
                Mage::logException($e);

                return;
            }
        }
        $this->_redirectReferer();
    }

    /**
     * Check the permission to run it
     *
     * @return boolean
     */
    protected function _isAllowed()
    {
        return Mage::helper('icoders_slider/admin')->isActionAllowed(
            $this->getRequest()->getActionName()
        );
    }

    /**
     * Get helper
     *
     * @return Icoders_Slider_Helper_Data
     */
    public function getHelper()
    {
        return Mage::helper('icoders_slider');
    }

}
