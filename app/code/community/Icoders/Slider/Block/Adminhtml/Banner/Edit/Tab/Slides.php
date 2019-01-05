<?php

/**
 * Aion_Rbanner_Block_Adminhtml_Banner_Edit_Tab_Slides
 *
 * @category  Aion
 * @package   Aion_Rbanner
 * @author    Dombi István <istvan.dombi@aionhill.com>
 * @copyright 2013 AionNext Kft. (http://aionhill.com)
 * @license   Aion License http://aionhill.com/licence
 * @link      http://www.aion.hu
 */
class Aion_Rbanner_Block_Adminhtml_Banner_Edit_Tab_Slides extends Mage_Adminhtml_Block_Widget_Grid
{
    /**
     * Set grid params
     */
    public function __construct()
    {
        parent::__construct();
        $this->setId('aion_rbanner_edit_tab_slides');
        $this->setDefaultSort('position');
        $this->setUseAjax(true);
        if (!$this->_getBanner()->getId()) {
            $this->setFilterVisibility(false);
        }
    }

    /**
     * Retirve currently edited product model
     *
     * @return Mage_Catalog_Model_Product
     */
    protected function _getBanner()
    {
        if (Mage::registry('banner_item')) {
            return Mage::registry('banner_item');
        } else if (($id = $this->getRequest()->getParam('id'))) {
            return Mage::getModel('aion_rbanner/banner')->load($id);
        } else {
            return Mage::getModel('aion_rbanner/banner');
        }
    }

    /**
     * Prepare collection
     *
     * @return Mage_Adminhtml_Block_Widget_Grid
     */
    protected function _prepareCollection()
    {
        $collection = Mage::getModel('aion_rbanner/slide')->getCollection();
        if ($this->_getBanner()->getId()) {
            $collection->addFieldToFilter('banner_id', $this->_getBanner()->getId());
        } else {
            $collection->addFieldToFilter('entity_id', 0);
        }

        $this->setCollection($collection);
        return parent::_prepareCollection();
    }

    /**
     * Checks when this block is readonly
     *
     * @return boolean
     */
    public function isReadonly()
    {
        return $this->_getBanner()->isObjectNew();
    }

    /**
     * Add columns to grid
     *
     * @return Mage_Adminhtml_Block_Widget_Grid
     */
    protected function _prepareColumns()
    {
        $this->addColumn(
            'entity_id',
            array(
                'header'   => Mage::helper('aion_rbanner')->__('ID'),
                'sortable' => true,
                'width'    => 60,
                'index'    => 'entity_id'
            )
        );

        $this->addColumn(
            'title_slides',
            array(
                'header' => Mage::helper('aion_rbanner')->__('Title'),
                'index'  => 'title'
            )
        );

        $this->addColumn(
            'link',
            array(
                'header' => Mage::helper('aion_rbanner')->__('Link'),
                'index'  => 'link'
            )
        );

        $this->addColumn(
            "banner_id",
            array(
                "header"   => Mage::helper("aion_rbanner")->__("Banner"),
                "index"    => "banner_id",
                "renderer" => 'Aion_Rbanner_Block_Adminhtml_Slide_Grid_Renderer_Banner'
            )
        );

        $this->addColumn(
            'position_slides',
            array(
                'header'         => Mage::helper('aion_rbanner')->__('Position'),
                'name'           => 'position',
                'type'           => 'number',
                'validate_class' => 'validate-number',
                'index'          => 'position',
                'width'          => 60
            )
        );

        return parent::_prepareColumns();
    }

    /**
     * Get Row Url
     *
     * @param Varien_Object $row Row object of collection
     *
     * @return string
     */
    public function getRowUrl($row)
    {
        return $this->getUrl(
            "*/slide/edit",
            array(
                "id" => $row->getId()
            )
        );
    }

    /**
     * Rerieve grid URL
     *
     * @return string
     */
    public function getGridUrl()
    {
        return $this->getData('grid_url')
            ? $this->getData('grid_url')
            : $this->getUrl('*/*/slides', array('_current' => true));
    }
}
