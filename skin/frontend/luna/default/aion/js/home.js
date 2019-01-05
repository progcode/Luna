/**
 * Aion DemoShop JS
 * skin/frontend/rwd/demoshop/aion/js/home.js
 * Kovacs Daniel Akos kovacs.daniel@aion.hu
 */

jQuery(function() {

    /** Owl carousel config */
    jQuery("#home-products-grid").owlCarousel({
        autoPlay: false,
        items : 5,
        itemsDesktop : [1199,3],
        itemsDesktopSmall : [979,3],
        navigation: true
    });

});