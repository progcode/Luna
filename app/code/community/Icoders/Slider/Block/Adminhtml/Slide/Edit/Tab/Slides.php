<?php

/**
 * Icoders_Slider_Block_Adminhtml_Banner_Edit_Tab_Slides
 *
 * @category  Icoders
 * @package   Icoders_Slider
 * @author    Dombi István <istvan.dombi@icoders.co>
 * @copyright 2013 Icoders (http://icoders.co)
 * @license   Icoders License http://icoders.co/licence
 * @link      http://www.icoders.co
 */
class Icoders_Slider_Block_Adminhtml_Banner_Edit_Tab_Slides extends Mage_Adminhtml_Block_Widget_Grid
{
    /**
     * Set grid params
     */
    public function __construct()
    {
        parent::__construct();
        $this->setId('icoders_slider_edit_tab_slides');
        $this->setDefaultSort('position');
        $this->setUseAjax(true);
        if ($this->_getBanner()->getId()) {
            $this->setDefaultFilter(array('in_banner' => 1));
        }
        if ($this->isReadonly()) {
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
            return Mage::getModel('icoders_slider/banner')->load($id);
        }
    }

    /**
     * Add filter
     *
     * @param object $column
     *
     * @return Mage_Adminhtml_Block_Catalog_Product_Edit_Tab_Related
     */
    protected function _addColumnFilterToCollection($column)
    {
        // Set custom filter for in product flag
        if ($column->getId() == 'in_banner') {
            $slideIds = $this->_getSelectedSlides();
            if (empty($slideIds)) {
                $slideIds = 0;
            }
            if ($column->getFilter()->getValue()) {
                $this->getCollection()->addFieldToFilter('entity_id', array('in' => $slideIds));
            } else {
                if ($slideIds) {
                    $this->getCollection()->addFieldToFilter('entity_id', array('nin' => $slideIds));
                }
            }
        } else {
            parent::_addColumnFilterToCollection($column);
        }
        return $this;
    }

    /**
     * Prepare collection
     *
     * @return Mage_Adminhtml_Block_Widget_Grid
     */
    protected function _prepareCollection()
    {
        $collection = Mage::getModel('icoders_slider/slide')->getCollection();

        if ($this->isReadonly()) {
            $slideIds = $this->_getSelectedSlides();
            if (empty($slideIds)) {
                $slideIds = array(0);
            }
            $collection->addFieldToFilter('entity_id', array('in' => $slideIds));
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
        return $this->_getBanner()->getRelatedReadonly();
    }

    /**
     * Add columns to grid
     *
     * @return Mage_Adminhtml_Block_Widget_Grid
     */
    protected function _prepareColumns()
    {
        if (!$this->isReadonly()) {
            $this->addColumn(
                'in_banner',
                array(
                    'header_css_class' => 'a-center',
                    'type'             => 'checkbox',
                    'name'             => 'in_banner',
                    'values'           => $this->_getSelectedSlides(),
                    'align'            => 'center',
                    'index'            => 'entity_id'
                )
            );
        }

        $this->addColumn(
            'entity_id',
            array(
                'header'   => Mage::helper('icoders_slider')->__('ID'),
                'sortable' => true,
                'width'    => 60,
                'index'    => 'entity_id'
            )
        );

        $this->addColumn(
            'title_f',
            array(
                'header' => Mage::helper('icoders_slider')->__('Title'),
                'index'  => 'title'
            )
        );

        $this->addColumn(
            'link',
            array(
                'header' => Mage::helper('icoders_slider')->__('Link'),
                'index'  => 'link'
            )
        );

        $this->addColumn(
            'position',
            array(
                'header'         => Mage::helper('icoders_slider')->__('Position'),
                'name'           => 'position',
                'type'           => 'number',
                'validate_class' => 'validate-number',
                'index'          => 'position',
                'width'          => 60
            )
        );

        return parent::_prepareColumns();
    }

    /** Get Row Url
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

    /**
     * Retrieve selected related products
     *
     * @return array
     */
    protected function _getSelectedSlides()
    {
        $products = $this->getSlidesRelated();
        if (!is_array($products)) {
            $products = array_keys($this->getSelectedRelatedSlides());
        }
        return $products;
    }

    /**
     * Retrieve related products
     *
     * @return array
     */
    public function getSelectedRelatedSlides()
    {
        $slides = array();
        foreach ($this->_getBanner()->getSlides() as $slide) {
            $slides[$slide->getId()] = array('position' => $slide->getPosition());
        }
        return $slides;
    }

    /** Prepare Mass Action
     *
     * @return $this
     */
    protected function _prepareMassaction()
    {
        $this->setMassactionIdField('slide_ids');
        $this->getMassactionBlock()->setFormFieldName('slide_ids');
        $this->getMassactionBlock()->addItem(
            'connect_slides',
            array(
                'label'   => Mage::helper('icoders_slider')->__('Connect to banner'),
                'url'     => $this->getUrl('*/slide/massConnect', ['banner_id' => $this->_getBanner()->getId()]),
                'confirm' => Mage::helper('icoders_slider')->__('Are you sure you want to make these slides to connect this banner?')
            )
        );
        $this->getMassactionBlock()->addItem(
            'deconnect_slides',
            array(
                'label'   => Mage::helper('icoders_slider')->__('Delete connection'),
                'url'     => $this->getUrl('*/slide/massDeconnect', ['banner_id' => $this->_getBanner()->getId()]),
                'confirm' => Mage::helper('icoders_slider')->__('Are you sure you want to delete the connection with the selected slide(s)?')
            )
        );
        return $this;
    }
}
