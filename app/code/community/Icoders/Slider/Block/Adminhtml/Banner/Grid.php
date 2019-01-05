<?php
/**
 * Aion_Rbanner_Block_Adminhtml_Banner_Grid
 *
 * @category  Aion
 * @package   Aion_Rbanner
 * @author    Dombi István <istvan.dombi@aionhill.com>
 * @copyright 2013 AionNext Kft. (http://aionhill.com)
 * @license   Aion License http://aionhill.com/licence
 * @link      http://www.aion.hu
 */
class Aion_Rbanner_Block_Adminhtml_Banner_Grid extends Mage_Adminhtml_Block_Widget_Grid
{
    /**
     * Construct
     */
    public function __construct()
    {
        parent::__construct();
        $this->setId("aion_rbanner_banner_grid");
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
        $collection = Mage::getModel("aion_rbanner/banner")->getCollection();
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
            'status',
            array(
                'header'   => Mage::helper('aion_rbanner')->__('Status'),
                'index'    => 'status',
                'type'     => 'options',
                'renderer' => 'Aion_Rbanner_Block_Adminhtml_Banner_Grid_Renderer_Status',
                'options'  => [
                    Aion_Rbanner_Model_Resource_Banner_Collection::STATUS_DISABLED => Mage::helper('aion_rbanner')->__('Disabled'),
                    Aion_Rbanner_Model_Resource_Banner_Collection::STATUS_ENABLED  => Mage::helper('aion_rbanner')->__('Enabled')]
            )
        );

        $this->addColumn(
            'edit',
            array(
                'header' => Mage::helper('aion_rbanner')->__('Action'),
                'width' => '100',
                'type' => 'action',
                'getter' => 'getId',
                'actions' => array(
                    array(
                        'caption' => Mage::helper('aion_rbanner')->__('Edit'),
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
                'header' => Mage::helper('aion_rbanner')->__('Action'),
                'width' => '100',
                'type' => 'action',
                'getter' => 'getId',
                'actions' => array(
                    array(
                        'caption' => Mage::helper('aion_rbanner')->__('Manage Slides'),
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
                'label'   => Mage::helper('aion_rbanner')->__('Remove'),
                'url'     => $this->getUrl('*/*/massDelete'),
                'confirm' => Mage::helper('aion_rbanner')->__('Are you sure you want to delete the selected Banners?')
            )
        );
        return $this;
    }
}
