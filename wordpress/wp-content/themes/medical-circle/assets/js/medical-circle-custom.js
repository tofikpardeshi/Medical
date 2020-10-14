jQuery(document).ready(function($){
    var at_window = $(window);
    function at_ticker() {
        var ticker = $('.news-notice-content'),
            ticker_first = ticker.children(':first');

        if( ticker_first.length ){
            setInterval(function() {
                if ( !ticker_first.is(":hover") ){
                    ticker_first.fadeOut(function() {
                        ticker_first.appendTo(ticker);
                        ticker_first = ticker.children(':first');
                        ticker_first.fadeIn();
                    });
                }
            },3000);
        }
    }

    at_ticker();
    
    function homeFullScreen() {

        var homeSection = $('#at-banner-slider');
        var windowHeight = at_window.outerHeight();

        if (homeSection.hasClass('home-fullscreen')) {

            $('.home-fullscreen').css('height', windowHeight);
        }
    }
    //make slider full width
    homeFullScreen();

    //window resize
    at_window.resize(function () {
        homeFullScreen();
    });

    at_window.on("load", function() {
        $('.acme-slick-carausel').show().slick({
            autoplay: true,
            adaptiveHeight: true,
            autoplaySpeed: 3000,
            speed: 700,
            cssEase: 'linear',
            fade: true,
            prevArrow: '<i class="prev fa fa-angle-left"></i>',
            nextArrow: '<i class="next fa fa-angle-right"></i>'
        });
        /*parallax scolling*/
        $('a[href*="\\#"]').click(function(event){
            var at_offset= $.attr(this, 'href');
            var id = at_offset.substring(1, at_offset.length);
            if ( ! document.getElementById( id ) ) {
                return;
            }
            if( $( at_offset ).offset() ){
                $('html, body').animate({
                    scrollTop: $( at_offset ).offset().top-$('.at-navbar').height()
                }, 1000);
                event.preventDefault();
            }

        });
        /*bootstrap sroolpy*/
        $("body").scrollspy({target: ".at-sticky", offset: $('.at-navbar').height()+50 } );

        /*featured slider*/
        $('.acme-gallery').each(function(){
            var $masonry_boxes = $(this);
            var $container = $masonry_boxes.find('.fullwidth-row');
            $container.imagesLoaded( function(){
                $masonry_boxes.fadeIn( 'slow' );
                $container.masonry({
                    itemSelector : '.at-gallery-item'
                });
            });
            /*widget*/
            $masonry_boxes.find('.image-gallery-widget').magnificPopup({
                type: 'image',
                gallery: {
                    enabled: true
                }

            });
            $masonry_boxes.find('.single-image-widget').magnificPopup({
                type: 'image'
            });
        });

        /*widget slider*/
        $('.acme-widget-carausel').show().slick({
            autoplay: true,
            autoplaySpeed: 3000,
            speed: 700,
            cssEase: 'linear',
            fade: true,
            prevArrow: '<i class="prev fa fa-angle-left"></i>',
            nextArrow: '<i class="next fa fa-angle-right"></i>'
        });

    });

    function stickyMenu() {

        var scrollTop = at_window.scrollTop();
        if ( scrollTop > 250 ) {
            $('.medical-circle-sticky').addClass('at-sticky');
            $('.sm-up-container').show();
        }
        else {
            $('.medical-circle-sticky').removeClass('at-sticky');
            $('.sm-up-container').hide();
        }
    }
    //What happen on window scroll
    stickyMenu();
    at_window.on("scroll", function (e) {
        setTimeout(function () {
            stickyMenu();
        }, 300)
    });
    
    /*department tab*/
    function department_tab() {
        // Runs when the image button is clicked.
        jQuery('body').on('click','.department-title a', function(e){
            var $this = $(this),
                department_wrap = $this.closest('.at-department'),
                department_tab_id = $this.data('id'),
                department_title = department_wrap.find('.department-title'),
            department_content_wrap = department_wrap.find('.department-item-content');

            department_title.removeClass('active');
            $this.parent().addClass('active');
            department_content_wrap.removeClass('active');

            department_content_wrap.each(function () {
                if( $(this).data('id') === department_tab_id ){
                    $(this).addClass('active')
                }
            });

            e.preventDefault();
        });
    }
    function accordion() {
        // Runs when the image button is clicked.
        jQuery('body').on('click','.accordion-title', function(e){
            var $this = $(this),
                accordion_content  = $this.closest('.accordion-content'),
                accordion_item  = $this.closest('.accordion-item'),
                accordion_details  = accordion_item.find('.accordion-details'),
                accordion_all_items  = accordion_content.find('.accordion-item'),
                accordion_icon  = accordion_content.find('.accordion-icon');

            accordion_icon.each(function () {
                $(this).addClass('fa-angle-down');
                $(this).removeClass('fa-angle-up');
            });
            accordion_all_items.each(function () {
                $(this).find('.accordion-details').slideUp();
            });

            if( accordion_details.is(":visible")){
                accordion_details.slideUp();
                $this.find('.accordion-icon').addClass('fa-angle-down');
                $this.find('.accordion-icon').removeClass('fa-angle-up');
            }
            else{
                accordion_details.slideDown();
                $this.find('.accordion-icon').addClass('fa-angle-up');
                $this.find('.accordion-icon').removeClass('fa-angle-down');
            }
            e.preventDefault();
        });
    }
    function at_site_origin_grid() {
        $('.panel-grid').each(function(){
            var count = $(this).children('.panel-grid-cell').length;
            if( count < 1 ){
                count = $(this).children('.panel-grid').length;
            }
            if( count > 1 ){
                $(this).addClass('at-grid-full-width');
            }
        });
    }
    accordion();
    department_tab();
    at_site_origin_grid();
});

/*animation with wow*/
if(typeof WOW !== 'undefined'){
    eb_wow = new WOW({
            boxClass: 'init-animate'
    }
    );
    eb_wow.init();
}