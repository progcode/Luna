<?php
/**
 * @category  Icoders
 * @package   Icoders_Slider
 * @author    iCoders <support@icoders.co>
 * @copyright 2017 Icoders (http://icoders.co)
 * @license   http://icoders.co/licence Icoders License
 * @link      http://icoders.co
 */

/**
 * Class Icoders_Slider_Adminhtml_BannerController
 */
class Icoders_Slider_Adminhtml_BannerController extends Mage_Adminhtml_Controller_Action
{

    const UPLOAD_DIR = 'sliders';

    /**
     * Init actions
     *
     * @return $this
     */
    protected function _initAction()
    {
        $this->loadLayout()
            ->_setActiveMenu('cms/icoders_slider/icoders_slider_banner')
            ->_addBreadcrumb(
                $this->getHelper()->__('Banners'),
                $this->getHelper()->__('Banners')
            )
            ->_addBreadcrumb(
                $this->getHelper()->__('Manage Banners'),
                $this->getHelper()->__('Manage Banners')
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
        $this->_title($this->getHelper()->__('Banner'))
            ->_title($this->getHelper()->__('Manage Banners'));

        /** @var $model Icoders_Slider_Model_Banner */
        $model = Mage::getModel('icoders_slider/banner');

        $bannerId = $this->getRequest()->getParam('id');

        if ($bannerId) {

            $model->load($bannerId);

            if (!$model->getId()) {
                $this->_getSession()->addError(
                    $this->getHelper()->__('Banner does not exist.')
                );

                $this->_redirect('*/*/');
                return;
            }

            $this->_title($model->getTitle());
            $breadCrumb = $this->getHelper()->__('Edit Banner');

        } else {
            $this->_title($this->getHelper()->__('New Banner'));
            $breadCrumb = $this->getHelper()->__('New Banner');
        }

        $this->_initAction()->_addBreadcrumb($breadCrumb, $breadCrumb);

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
                $model = Mage::getSingleton('icoders_slider/banner')->load($id);
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
                $banners = Mage::getModel('icoders_slider/resource_banner_collection');
                $banners->addFieldToFilter('entity_id', ['in' => $ids]);
                foreach ($ids as $id) {
                    $model = $banners->getItemByColumnValue('entity_id', $id);
                    $model->delete();
                }

                $this->_getSession()->addSuccess(
                    $this->getHelper()->__('Total of %d record(s) have been deleted.', count($ids))
                );
            } catch (Mage_Core_Exception $e) {
                $this->_getSession()->addError($e->getMessage());
            } catch (Exception $e) {
                $this->_getSession()->addError(
                    $this->getHelper()->__('An error occurred while mass deleting banners. Please review log and try again.')
                );
                Mage::logException($e);

                return;
            }
        }
        $this->_redirect('*/*/index');
    }

    /**
     * Slides action (grid)
     *
     * @return void
     */
    public function slidesAction()
    {
        $this->loadLayout();
        $this->renderLayout();
    }


    /**
     * Save action
     *
     * @return void
     */
    public function saveAction()
    {
        if ($data = $this->getRequest()->getPost()) {

            $model = Mage::getModel('icoders_slider/banner');

            if (isset($data['stores']) && !empty($data['stores'])) {
                if (in_array('0', $data['stores'])) {
                    $data['stores'] = array(0);
                }

                $data['stores'] = implode(',', $data['stores']);
            }

            $model->setData($data)->setId($this->getRequest()->getParam('id'));

            try {
                $model->save();

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
