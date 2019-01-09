/**
 * Aion DemoShop JS
 * skin/frontend/rwd/demoshop/aion/js/home.js
 * Kovacs Daniel Akos kovacs.daniel@aion.hu
 */

jQuery(function() {
    /** Owl carousel config */
    jQuery("#home-products-grid").owlCarousel({
        loop: false,
        margin: 10,
        nav: true,
        responsive:{
            320:{
                items:1
            },
            768:{
                items:3
            },
            992:{
                items:5
            }
        }
    });
});