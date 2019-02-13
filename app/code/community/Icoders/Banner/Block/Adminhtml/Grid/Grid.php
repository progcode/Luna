<?php
/**
 * app/code/community/Icoders/Banner/Block/Adminhtml/Grid/Grid.php
 *
 * @category  Icoders
 * @package   Icoders_Banner
 * @author    iCoders <support@icoders.co>
 * @copyright 2016 Icoders (http://www.icoders.co)
 * @license   http://icoders.co/license Icoders License
 * @link      http://www.icoders.co
 */

/**
 * Class Icoders_Banner_Block_Adminhtml_Grid_Grid
 */
class Icoders_Banner_Block_Adminhtml_Grid_Grid extends Mage_Adminhtml_Block_Widget_Grid
{

    /**
     * Constructor
     */
    public function __construct()
    {
        parent::__construct();
        $this->setId('grid_id');
        $this->setDefaultDir('asc');
        $this->setSaveParametersInSession(true);
    }

    /**
     * Prepare collection
     *
     * @return Mage_Adminhtml_Block_Widget_Grid
     */
    protected function _prepareCollection()
    {
        $collection = Mage::getModel('icoders_banner/banner')->getCollection();
        $this->setCollection($collection);

        return parent::_prepareCollection();
    }

    /**
     * Prepare columns
     *
     * @return $this
     * @throws Exception
     */
    protected function _prepareColumns()
    {
        $this->addColumn(
            'entity_id',
            array(
                'header' => $this->__('ID'),
                'width'  => '50px',
                'index'  => 'entity_id'
            )
        );

        $this->addColumn(
            'title',
            array(
                'header' => $this->__('Title'),
                'index'  => 'title'
            )
        );

        /**
         * Check is single store mode
         */
        if (!Mage::app()->isSingleStoreMode()) {
            $this->addColumn(
                'store_id',
                array(
                    'header'     => Mage::helper('icoders_banner')->__('Store View'),
                    'index'      => 'store_id',
                    'type'       => 'store',
                    'store_all'  => true,
                    'store_view' => true,
                    'sortable'   => false,
                    'filter_condition_callback'
                                 => array($this, '_filterStoreCondition'),
                )
            );
        }

        $this->addColumn(
            'status',
            array(
                'header'  => $this->__('Status'),
                'index'   => 'status',
                'type'    => 'options',
                'width'   => '100px',
                'options' => array(
                    1 => Mage::helper('adminhtml')->__('Enable'),
                    0 => Mage::helper('adminhtml')->__('Disable'),
                ),
            )
        );

        $this->addColumn(
            'action',
            array(
                'header'   => Mage::helper('adminhtml')->__('Action'),
                'width'    => '100px',
                'type'     => 'action',
                'getter'   => 'getId',
                'actions'  => array(array(
                                        'caption' => Mage::helper('adminhtml')->__('Edit'),
                                        'url'     => array('base' => '*/*/edit'),
                                        'field'   => 'id'
                                    )),
                'filter'   => false,
                'sortable' => false,
                'index'    => 'banner',
            )
        );

        return parent::_prepareColumns();
    }

    /**
     * Get row url
     *
     * @param Icoders_Banner_Model_Banner $row banner model
     *
     * @return string
     */
    public function getRowUrl($row)
    {
        return $this->getUrl('*/*/edit', array('id' => $row->getId()));
    }

    /**
     * Prepare mass action
     *
     * @return $this
     */
    protected function _prepareMassaction()
    {
        $modelPk = Mage::getModel('icoders_banner/banner')->getResource()->getIdFieldName();
        $this->setMassactionIdField($modelPk);
        $this->getMassactionBlock()->setFormFieldName('ids');

        $this->getMassactionBlock()->addItem(
            'delete',
            array(
                'label' => $this->__('Delete'),
                'url'   => $this->getUrl('*/*/massDelete'),
            )
        );

        return $this;
    }

}
