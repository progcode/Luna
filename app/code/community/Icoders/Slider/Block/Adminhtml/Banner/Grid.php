<?php
/**
 * Icoders_Slider_Block_Adminhtml_Banner_Grid
 *
 * @category  Icoders
 * @package   Icoders_Slider
 * @author    iCoders <support@icoders.co>
 * @copyright 2013 Icoders (http://icoders.co)
 * @license   Icoders License http://icoders.co/licence
 * @link      http://www.icoders.co
 */
class Icoders_Slider_Block_Adminhtml_Banner_Grid extends Mage_Adminhtml_Block_Widget_Grid
{
    /**
     * Construct
     */
    public function __construct()
    {
        parent::__construct();
        $this->setId("icoders_slider_banner_grid");
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
        $collection = Mage::getModel("icoders_slider/banner")->getCollection();
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
                "header" => Mage::helper("icoders_slider")->__("ID"),
                "align"  => "right",
                "width"  => "50px",
                "type"   => "number",
                "index"  => "entity_id",
            )
        );
        $this->addColumn(
            "title",
            array(
                "header" => Mage::helper("icoders_slider")->__("Title"),
                "index"  => "title",
            )
        );
        $this->addColumn(
            'status',
            array(
                'header'   => Mage::helper('icoders_slider')->__('Status'),
                'index'    => 'status',
                'type'     => 'options',
                'renderer' => 'Icoders_Slider_Block_Adminhtml_Banner_Grid_Renderer_Status',
                'options'  => [
                    Icoders_Slider_Model_Resource_Banner_Collection::STATUS_DISABLED => Mage::helper('icoders_slider')->__('Disabled'),
                    Icoders_Slider_Model_Resource_Banner_Collection::STATUS_ENABLED  => Mage::helper('icoders_slider')->__('Enabled')]
            )
        );

        $this->addColumn(
            'edit',
            array(
                'header' => Mage::helper('icoders_slider')->__('Action'),
                'width' => '100',
                'type' => 'action',
                'getter' => 'getId',
                'actions' => array(
                    array(
                        'caption' => Mage::helper('icoders_slider')->__('Edit'),
                        'url' => array('base' => '*/*/edit'),
                        'field' => 'id'
                    )
                ),
                'filter' => false,
                'sortable' => false,
                'index' => 'stores',
                'is_system' => true,
            )
        );

        $this->addColumn(
            'slides',
            array(
                'header' => Mage::helper('icoders_slider')->__('Action'),
                'width' => '100',
                'type' => 'action',
                'getter' => 'getId',
                'actions' => array(
                    array(
                        'caption' => Mage::helper('icoders_slider')->__('Manage Slides'),
                        'url' => array('base' => 'adminhtml/slide/index'),
                        'field' => 'id'
                    )
                ),
                'filter' => false,
                'sortable' => false,
                'index' => 'stores',
                'is_system' => true,
            )
        );

        return parent::_prepareColumns();
    }

    /**
     * Get Row Url
     *
     * @param Varien_Object $row Row of collection
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
                'label'   => Mage::helper('icoders_slider')->__('Remove'),
                'url'     => $this->getUrl('*/*/massDelete'),
                'confirm' => Mage::helper('icoders_slider')->__('Are you sure you want to delete the selected Banners?')
            )
        );
        return $this;
    }
}
