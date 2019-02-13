<?php
/**
 * app/code/community/Icoders/Banner/Block/Adminhtml/Grid/Edit/Tab/Category.php
 *
 * @category  Icoders
 * @package   Icoders_Banner
 * @author    iCoders <support@icoders.co>
 * @copyright 2016 Icoders (http://www.icoders.co)
 * @license   http://icoders.co/license Icoders License
 * @link      http://www.icoders.co
 */

/**
 * Class Icoders_Banner_Block_Adminhtml_Grid_Edit_Tab_Category
 */
class Icoders_Banner_Block_Adminhtml_Grid_Edit_Tab_Category
    extends Mage_Adminhtml_Block_Catalog_Category_Tree
    implements Mage_Adminhtml_Block_Widget_Tab_Interface
{
    private $_selectedNodes = null;

    /**
     * Get tab label
     *
     * @return Icoders_Banner_Helper_Data
     */
    public function getTabLabel()
    {
        return $this->_getHelper()->__('Visible on category');
    }

    /**
     * Get tab title
     *
     * @return Icoders_Banner_Helper_Data
     */
    public function getTabTitle()
    {
        return $this->_getHelper()->__('Visible on category');
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
     * Retrieve currently edited product
     *
     * @return Icoders_Banner_Model_Banner
     */
    public function getBanner()
    {
        return Mage::registry('banner_item');
    }

    /**
     * Checks when this block is readonly
     *
     * @return boolean
     */
    public function isReadonly()
    {
        return $this->getBanner()->getCategoriesReadonly();
    }

    /**
     * Get banner category ids
     *
     * @return array
     */
    public function getCategoryIds()
    {
        $_categoryList = $this->getBanner()->getCategoryId();
        $_categoryList = explode(',', $_categoryList);
        return is_array($_categoryList) ? $_categoryList : array();
    }

    /**
     * Get banner category ids
     *
     * @return comma separated string
     */
    public function getIdsString()
    {
        return implode(',', $this->getCategoryIds());
    }

    /**
     * Get Root category node
     *
     * @return mixed|Varien_Data_Tree_Node
     */
    public function getRootNode()
    {
        $root = $this->getRoot();
        if ($root && in_array($root->getId(), $this->getCategoryIds())) {
            $root->setChecked(true);
        }
        return $root;
    }

    /**
     * Get Root category
     *
     * @param null $parentNodeCategory node category
     * @param int  $recursionLevel     recursion level
     *
     * @return mixed|Varien_Data_Tree_Node
     */
    public function getRoot($parentNodeCategory = null, $recursionLevel = 3)
    {
        if (!is_null($parentNodeCategory) && $parentNodeCategory->getId()) {
            return $this->getNode($parentNodeCategory, $recursionLevel);
        }
        $root = Mage::registry('root');
        if (is_null($root)) {
            $storeId = (int)$this->getRequest()->getParam('store');

            if ($storeId) {
                $store = Mage::app()->getStore($storeId);
                $rootId = $store->getRootCategoryId();
            } else {
                $rootId = Mage_Catalog_Model_Category::TREE_ROOT_ID;
            }

            $ids = $this->getSelectedCategoriesPathIds($rootId);
            $tree = Mage::getResourceSingleton('catalog/category_tree')
                ->loadByIds($ids, false, false);

            if ($this->getCategory()) {
                $tree->loadEnsuredNodes($this->getCategory(), $tree->getNodeById($rootId));
            }

            $tree->addCollectionData($this->getCategoryCollection());

            $root = $tree->getNodeById($rootId);

            if ($root && $rootId != Mage_Catalog_Model_Category::TREE_ROOT_ID) {
                $root->setIsVisible(true);
                if ($this->isReadonly()) {
                    $root->setDisabled(true);
                }
            } elseif ($root && $root->getId() == Mage_Catalog_Model_Category::TREE_ROOT_ID) {
                $root->setName(Mage::helper('catalog')->__('Root'));
            }

            Mage::register('root', $root);
        }

        return $root;
    }

    /**
     * Get category node json format
     *
     * @param Varien_Data_Tree_Node $node  node
     * @param int                   $level level
     *
     * @return string
     */
    protected function _getNodeJson($node, $level = 1)
    {
        $item = parent::_getNodeJson($node, $level);

        $isParent = $this->_isParentSelectedCategory($node);

        if ($isParent) {
            $item['expanded'] = true;
        }

        if (in_array($node->getId(), $this->getCategoryIds())) {
            $item['checked'] = true;
        }

        if ($this->isReadonly()) {
            $item['disabled'] = true;
        }
        return $item;
    }

    /**
     * Return is parent selected category
     *
     * @param Varien_Data_Tree_Node $node node
     *
     * @return bool
     */
    protected function _isParentSelectedCategory($node)
    {
        foreach ($this->_getSelectedNodes() as $selected) {
            if ($selected) {
                $pathIds = explode('/', $selected->getPathId());
                if (in_array($node->getId(), $pathIds)) {
                    return true;
                }
            }
        }

        return false;
    }

    /**
     * Get selected category
     *
     * @return array|null
     */
    protected function _getSelectedNodes()
    {
        if ($this->_selectedNodes === null) {
            $this->_selectedNodes = array();
            $root = $this->getRoot();
            foreach ($this->getCategoryIds() as $categoryId) {
                if ($root) {
                    $this->_selectedNodes[] = $root->getTree()->getNodeById($categoryId);
                }
            }
        }

        return $this->_selectedNodes;
    }

    /**
     * Get category children to json
     *
     * @param int $categoryId category id
     *
     * @return string
     */
    public function getCategoryChildrenJson($categoryId)
    {
        $category = Mage::getModel('catalog/category')->load($categoryId);
        $node = $this->getRoot($category, 1)->getTree()->getNodeById($categoryId);

        if (!$node || !$node->hasChildren()) {
            return '[]';
        }

        $children = array();
        foreach ($node->getChildren() as $child) {
            $children[] = $this->_getNodeJson($child);
        }

        return Mage::helper('core')->jsonEncode($children);
    }

    /**
     * Get load tree url
     *
     * @param null $expanded expanded
     *
     * @return string
     */
    public function getLoadTreeUrl($expanded = null)
    {
        return $this->getUrl('*/*/categoriesJson', array('_current' => true));
    }

    /**
     * Return distinct path ids of selected categories
     *
     * @param int|bool $rootId Root category Id for context
     *
     * @return array
     */
    public function getSelectedCategoriesPathIds($rootId = false)
    {
        $ids = array();
        $collection = Mage::getModel('catalog/category')->getCollection()
            ->addFieldToFilter('entity_id', array('in' => $this->getCategoryIds()));
        foreach ($collection as $item) {
            if ($rootId && !in_array($rootId, $item->getPathIds())) {
                continue;
            }
            foreach ($item->getPathIds() as $id) {
                if (!in_array($id, $ids)) {
                    $ids[] = $id;
                }
            }
        }
        return $ids;
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
