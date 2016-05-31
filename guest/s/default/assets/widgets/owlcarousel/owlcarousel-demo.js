/* Carousel */

$(document).ready(function() {

    $(".owl-carousel-1").owlCarousel({
        lazyLoad: true,
        itemsCustom: [
            [0, 1],
            [450, 1],
            [600, 2],
            [700, 2],
            [1000, 2],
            [1200, 2],
            [1400, 2],
            [1600, 2]
        ],
        navigation: true,
        autoPlay: 5000,
        stopOnHover: true,
        paginationSpeed: 1000,
        goToFirstSpeed: 2000,
        singleItem: false,
        autoHeight: true,
        transitionStyle: "goDown",
        navigationText: ["<i class='glyph-icon icon-angle-left'></i>", "<i class='glyph-icon icon-angle-right'></i>"],
    });
});
