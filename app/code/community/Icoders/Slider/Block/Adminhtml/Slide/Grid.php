<?php

/**
 * Aion_Rbanner_Block_Adminhtml_Slide_Grid
 *
 * @category  Aion
 * @package   Aion_Rbanner
 * @author    Dombi István <istvan.dombi@aionhill.com>
 * @copyright 2013 AionNext Kft. (http://aionhill.com)
 * @license   Aion License http://aionhill.com/licence
 * @link      http://www.aion.hu
 */
class Aion_Rbanner_Block_Adminhtml_Slide_Grid extends Mage_Adminhtml_Block_Widget_Grid
{
    /**
     * Construct
     */
    public function __construct()
    {
        parent::__construct();
        $this->setId("aion_rbanner_slide_grid");
        $this->setDefaultSort("entity_id");
        $this->setDefaultDir("ASC");
        $this->setSaveParametersInSession(true);
    }

    /**
     * Prepare Collection
     *
     * @return Mage_Adminhtml_Block_Widget_Grid
     */
    protected function _prepareCollection()
    {
        $collection = Mage::getModel("aion_rbanner/slide")->getCollection();
        if (($bannerId = $this->getRequest()->getParam('id'))) {
            $collection->addFieldToFilter('banner_id', $bannerId);
        }
        $this->setCollection($collection);
        return parent::_prepareCollection();
    }

    /**
     * Prepare Columns
     *
     * @return $this
     */
    protected function _prepareColumns()
    {
        $this->addColumn(
            "entity_id",
            array(
                "header" => Mage::helper("aion_rbanner")->__("ID"),
                "align"  => "right",
                "width"  => "50px",
                "type"   => "number",
                "index"  => "entity_id",
            )
        );

        $this->addColumn(
            "title",
            array(
                "header" => Mage::helper("aion_rbanner")->__("Title"),
                "index"  => "title",
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
            "position",
            array(
                "header" => Mage::helper("aion_rbanner")->__("Position"),
                "align"  => "right",
                "width"  => "50px",
                "type"   => "number",
                "index"  => "position",
            )
        );

        $this->addColumn(
            'edit',
            array(
                'header'    => Mage::helper('aion_rbanner')->__('Action'),
                'width'     => '100',
                'type'      => 'action',
                'getter'    => 'getId',
                'actions'   => array(
                    array(
                        'caption' => Mage::helper('aion_rbanner')->__('Edit'),
                        'url'     => array('base' => '*/*/edit'),
                        'field'   => 'id'
                    )
                ),
                'filter'    => false,
                'sortable'  => false,
                'index'     => 'stores',
                'is_system' => true,
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
            "*/*/edit",
            array(
                "id" => $row->getId()
            )
        );
    }

    /** Prepare Mass Action
     *
     * @return $this
     */
    protected function _prepareMassaction()
    {
        $this->setMassactionIdField('id');
        $this->getMassactionBlock()->setFormFieldName('ids');
        $this->getMassactionBlock()->setUseSelectAll(true);
        $this->getMassactionBlock()->addItem(
            'remove_banner',
            array(
                'label'   => Mage::helper('aion_rbanner')->__('Remove'),
                'url'     => $this->getUrl('*/*/massDelete'),
                'confirm' => Mage::helper('aion_rbanner')->__('Are you sure you want to delete the selected Banners?')
            )
        );

        $this->getMassactionBlock()->addItem('connect_slides', array(
                'label'      => Mage::helper('aion_rbanner')->__('Connect to Banner'),
                'url'        => $this->getUrl('*/*/massConnect', array('_current' => true)),
                'additional' => array(
                    'visibility' => array(
                        'name'   => 'banner_id',
                        'type'   => 'select',
                        'class'  => 'required-entry',
                        'label'  => Mage::helper('aion_rbanner')->__('Banner'),
                        'values' => Mage::getModel('aion_rbanner/banner')->getCollection()->toOptionArray()
                    )
                )
            )
        );

        $this->getMassactionBlock()->addItem('deconnect_slides', array(
                'label' => Mage::helper('aion_rbanner')->__('Delete connection'),
                'url'   => $this->getUrl('*/*/massDeconnect', array('_current' => true))
            )
        );

        return $this;
    }
}
