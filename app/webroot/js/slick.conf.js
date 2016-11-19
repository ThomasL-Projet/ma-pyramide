/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/* Pour l'accueil */
jQuery('.main-slider-content').slick({
    dots: true,
    slidesToShow: 1,
    slidesToScroll: 1,
    autoplay: true,
    autoplaySpeed: 3750,
    pauseOnDotsHover: true
});
jQuery(window).resize(function () {
    jQuery('.main-slider-content').slick('unslick');
    jQuery('.main-slider-content').slick({
        slidesToShow: 1,
        slidesToScroll: 1,
        autoplay: true,
        autoplaySpeed: 3750,
        pauseOnDotsHover: true
    });
});
/* Accueil, on affichge la div associé au slide quand un slide est effectué -> cf doc Slick */
jQuery('.main-slider-content').on('afterChange', function (event, slick, currentSlider, nextSlide) {
    switch (jQuery('.main-slider-content').slick('slickCurrentSlide')+1) {
       
        case 1:
            jQuery('.desc_1').show();
            jQuery('.desc_2').hide();
            jQuery('.desc_3').hide();
            jQuery('.desc_4').hide();
            break;

        case 2 :
            jQuery('.desc_1').hide();
            jQuery('.desc_2').show();
            jQuery('.desc_3').hide();
            jQuery('.desc_4').hide();
            break;
        case 3 :
            jQuery('.desc_1').hide();
            jQuery('.desc_2').hide();
            jQuery('.desc_3').show();
            jQuery('.desc_4').hide();
            break;
        case 4 :
            jQuery('.desc_1').hide();
            jQuery('.desc_2').hide();
            jQuery('.desc_3').hide();
            jQuery('.desc_4').show();
            break;

    }
});

/* Pour mon tableau de bord */
jQuery('.suiviPhysique').slick({
    dots: true,
    slidesToShow: 3,
    slidesToScroll: 1,
    autoplay: false,
    pauseOnDotsHover: true
});
jQuery(window).resize(function () {
    jQuery('.suiviPhysique').slick('unslick');
    jQuery('.suiviPhysique').slick({
        slidesToShow: 3,
        slidesToScroll: 1,
        autoplay: false,
        pauseOnDotsHover: true
    });
});
jQuery('.suiviAliment').slick({
    dots: true,
    slidesToShow: 3,
    slidesToScroll: 1,
    autoplay: false,
    pauseOnDotsHover: true
});
jQuery(window).resize(function () {
    jQuery('.suiviAliment').slick('unslick');
    jQuery('.suiviAliment').slick({
        slidesToShow: 3,
        slidesToScroll: 1,
        autoplay: false,
        pauseOnDotsHover: true
    });
});
jQuery('.suiviParam').slick({
    dots: true,
    slidesToShow: 3,
    slidesToScroll: 1,
    autoplay: false,
    pauseOnDotsHover: true
});
jQuery(window).resize(function () {
    jQuery('.suiviParam').slick('unslick');
    jQuery('.suiviParam').slick({
        slidesToShow: 3,
        slidesToScroll: 1,
        autoplay: false,
        pauseOnDotsHover: true
    });
});
