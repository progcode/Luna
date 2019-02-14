<?php
/**
 * Icoders Luna
 *
 * @category  Icoders
 * @package   Icoders_Luna
 * @author    Kovacs Daniel Akos <kovacs.daniel@icoders.co>
 * @copyright 2019. Icoders (http://www.icoders.co)
 * @license   http://www.magentocommerce.com/license/enterprise-edition GNU General Public License
 * @link      http://www.icoders.co
 */

/* @var $installer Mage_Core_Model_Resource_Setup */

$installer = $this;
$installer->startSetup();

try {
    $content1 =
        '<div class="category-page-row">
            <div class="row">
                <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                    <a class="thumbnail" href="{{config path="web/secure/base_url"}}accessories/eyewear.html">
                        <img class="img-responsive" src="{{media url="wysiwyg/accessorieseyewearimg.jpg"}}" alt="Eyewear" />
                    </a>
                </div>
                <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                    <a class="thumbnail" href="{{config path="web/secure/base_url"}}accessories/jewelry.html">
                        <img src="{{media url="wysiwyg/acessoreiesjeweleryimg.jpg"}}" alt="Jewelry" />
                    </a>
                </div>
                <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                    <a class="thumbnail" href="{{config path="web/secure/base_url"}}accessories/shoes.html">
                        <img src="{{media url="wysiwyg/accessoriesshoesimg.jpg"}}" alt="Shoes" />
                    </a>
                </div>
                <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                    <a class="thumbnail" href="{{config path="web/secure/base_url"}}accessories/bags-luggage.html">
                        <img src="{{media url="wysiwyg/Accessoriesbagimg.jpg"}}" alt="Bags" />
                    </a>
                </div>
            </div>
		</div>';

    $content2 =
        '<div class="category-page-row">
            <div class="row">
                <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                    <a class="thumbnail" href="{{config path="web/secure/base_url"}}home-decor/books-music.html">
                        <img class="img-responsive" src="{{media url="wysiwyg/Homecatimg-books.jpg"}}" alt="Books &amp; Music" />
                    </a>
                </div>
                <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                    <a class="thumbnail" href="{{config path="web/secure/base_url"}}home-decor/bed-bath.html">
                        <img class="img-responsive" src="{{media url="wysiwyg/home_bed_bathimg.jpg"}}" alt="Bed &amp; Bath" />
                    </a>
                </div>
                <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                    <a class="thumbnail" href="{{config path="web/secure/base_url"}}home-decor/electronics.html">
                        <img class="img-responsive" src="{{media url="wysiwyg/Homecatimg-electronics.jpg"}}" alt="Electronics" />
                    </a>
                </div>
                <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                    <a class="thumbnail" href="{{config path="web/secure/base_url"}}home-decor/decorative-accents.html">
                        <img class="img-responsive" src="{{media url="wysiwyg/Homecatimg-decor.jpg"}}" alt="Decorative Accents" />
                    </a>
                </div>
            </div>
		</div>';

    $content3 =
        '<div class="category-page-row">
            <div class="row">
                <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                    <a class="thumbnail" href="{{config path="web/secure/base_url"}}men/new-arrivals.html">
                        <img class="img-responsive" src="{{media url="wysiwyg/mencat-newarrivalsimg.jpg"}}" alt="New Arrivals" />
                    </a>
                </div>
                <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                    <a class="thumbnail" href="{{config path="web/secure/base_url"}}men/shirts.html">
                        <img class="img-responsive" src="{{media url="wysiwyg/clp-sub-m-shirts.jpg"}}"  alt="Shirts" />
                    </a>
                </div>
                <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                     <a class="thumbnail" href="{{config path="web/secure/base_url"}}men/tees-knits-and-polos.html">
                        <img class="img-responsive" src="{{media url="wysiwyg/Mencat-teesimg.jpg"}}" alt="Tees, Knits and Polos" />
                    </a>
                </div>
                <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                    <a class="thumbnail" href="{{config path="web/secure/base_url"}}men/pants-denim.html">
                        <img class="img-responsive" src="{{media url="wysiwyg/mencat-pants.jpg"}}" alt="Pants &amp; Denim" />
                    </a>
                </div>
            </div>
		</div>';

    $content4 =
        '<div class="category-page-row">
            <div class="row">
                <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                    <a class="thumbnail" href="{{config path="web/secure/base_url"}}women/new-arrivals.html">
                        <img class="img-responsive" src="{{media url="wysiwyg/Womennewarrivalsimg.jpg"}}" alt="New Arrivals" />
                    </a>
                </div>
                <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                    <a class="thumbnail" href="{{config path="web/secure/base_url"}}women/tops-blouses.html">
                        <img class="img-responsive" src="{{media url="wysiwyg/Womentopsimg.jpg"}}" alt="Tops &amp; Blouses" />
                    </a>
                </div>
                <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                    <a class="thumbnail" href="{{config path="web/secure/base_url"}}women/pants-denim.html">
                        <img class="img-responsive" src="{{media url="wysiwyg/Womenpantsimg.jpg"}}" alt="Pants &amp; Denim" />
                    </a>
                </div>
                <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                    <a class="thumbnail" href="{{config path="web/secure/base_url"}}women/dresses-skirts.html">
                        <img class="img-responsive" src="{{media url="wysiwyg/Womenskirtsimg.jpg"}}" alt="Dresses &amp; Skirts" />
                    </a>
                </div>
            </div>
		</div>';

    Mage::getModel('cms/block')
        ->load('category-landingpage-accessories-linksblock', 'identifier')
        ->setData('content', $content1)
        ->save();

    Mage::getModel('cms/block')
        ->load('category-landingpage-home-linksblock', 'identifier')
        ->setData('content', $content2)
        ->save();

    Mage::getModel('cms/block')
        ->load('category-landingpage-men-linksblock', 'identifier')
        ->setData('content', $content3)
        ->save();

    Mage::getModel('cms/block')
        ->load('category-landingpage-women-linksblock', 'identifier')
        ->setData('content', $content4)
        ->save();

} catch (Exception $e) {
    Mage::throwException($e->getMessage());
}

$installer->endSetup();
