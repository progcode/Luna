<?php
/**
 * Icoders Luna - sample cms pages
 *
 * @category  Icoders
 * @package   Icoders_Luna
 * @copyright 2002-2016. Icoders (http://www.icoders.co)
 * @license   http://www.magentocommerce.com/license/enterprise-edition GNU General Public License
 * @link      http://www.icoders.co
 */
/* @var $installer Mage_Core_Model_Resource_Setup */

$installer = $this;

$installer->startSetup();

$identifier = 'demo-cms-oldal';
$staticBlock = Mage::getModel('cms/page')
    ->load($identifier, 'identifier');

if ($staticBlock->isObjectNew()) {
    $staticBlock
        ->setIdentifier($identifier)
        ->setStores(array(0))
        ->setIsActive(true)
        ->setRootTemplate('one_column')
        ->setTitle('Demo CMS oldal');
}

$staticBlock
    ->setContent('<p>Demo CMS oldal</p>')
    ->save();

$installer->endSetup();
