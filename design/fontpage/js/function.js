$(window).load(function () {
    $(".loader").fadeOut("slow")
})
$(document).ready(function () {



    $("ul.nav li.dropdown-m").hover(function () {
        $(this).find(".dropdown-menu").first().toggleClass("activy")
    }), jQuery(function (o) {
        o("ul.nav li.dropdown-m").hover(function () {
            o(this).find(".dropdown-menu").first().stop(!0, !0).delay(250).slideDown()
        }, function () {
            o(this).find(".dropdown-menu").first().stop(!0, !0).delay(100).slideUp()
        }), o(".navbar .dropdown-m > a").click(function () {
            location.href = this.href
        }), document.addEventListener("touchstart", function () {}, !0)
    }), $(window).height() + 100 < $(document).height() && $(".top").removeClass("hidden").affix({
        offset: {
            top: 100
        }
    }), $(".top").click(function (o) {
        o.preventDefault(), $("html, body").animate({
            scrollTop: 0
        }, 1e3)
    })
    //



    //
    $("#owl-demo3").owlCarousel({
        center: true,
        items:3,
        loop:true,
        autoplay: 4000,
        nav: true,
        dots: true,
        navText: ["<h1><i class='glyphicon glyphicon-chevron-left'></i></h1>", "<h1><i class='glyphicon glyphicon-chevron-right'></i></h1>"],
        responsive: {
            300: {
                items: 1
            },
            600: {
                items: 1
            },
            900: {
                items: 1
            },
            1028: {
                items: 1
            },
            1200: {
                items: 3
            }
        }
    });

});
$(document).ready(function () {
    $('a[href^="#"]').on('click', function (event) {
        var target = $(this.getAttribute('href'));
        if (target.length) {
            event.preventDefault();
            $('html, body').stop().animate({
                scrollTop: target.offset().top - 70
            }, 1000);
        }
    });
    //
    hideChat(0);

    $('#prime').click(function () {
        toggleFab();
    });


    //Toggle chat and links
    function toggleFab() {
        $('.prime').toggleClass('zmdi-comment-outline');
        $('.prime').toggleClass('zmdi-close');
        $('.prime').toggleClass('is-active');
        $('.prime').toggleClass('is-visible');
        $('#prime').toggleClass('is-float');
        $('.chat').toggleClass('is-visible');
        $('.fab').toggleClass('is-visible');

    }

    $('#chat_first_screen').click(function (e) {
        hideChat(1);
    });

    $('#chat_second_screen').click(function (e) {
        hideChat(2);
    });

    $('#chat_third_screen').click(function (e) {
        hideChat(3);
    });

    $('#chat_fourth_screen').click(function (e) {
        hideChat(4);
    });

    $('#chat_fullscreen_loader').click(function (e) {
        $('.fullscreen').toggleClass('zmdi-window-maximize');
        $('.fullscreen').toggleClass('zmdi-window-restore');
        $('.chat').toggleClass('chat_fullscreen');
        $('.fab').toggleClass('is-hide');
        $('.header_img').toggleClass('change_img');
        $('.img_container').toggleClass('change_img');
        $('.chat_header').toggleClass('chat_header2');
        $('.fab_field').toggleClass('fab_field2');
        $('.chat_converse').toggleClass('chat_converse2');
        //$('#chat_converse').css('display', 'none');
        // $('#chat_body').css('display', 'none');
        // $('#chat_form').css('display', 'none');
        // $('.chat_login').css('display', 'none');
        // $('#chat_fullscreen').css('display', 'block');
    });

    function hideChat(hide) {
        switch (hide) {
            case 0:
                $('#chat_converse').css('display', 'none');
                $('#chat_body').css('display', 'none');
                $('#chat_form').css('display', 'none');
                $('.chat_login').css('display', 'block');
                $('.chat_fullscreen_loader').css('display', 'none');
                $('#chat_fullscreen').css('display', 'none');
                break;
            case 1:
                $('#chat_converse').css('display', 'block');
                $('#chat_body').css('display', 'none');
                $('#chat_form').css('display', 'none');
                $('.chat_login').css('display', 'none');
                $('.chat_fullscreen_loader').css('display', 'block');
                break;
            case 2:
                $('#chat_converse').css('display', 'none');
                $('#chat_body').css('display', 'block');
                $('#chat_form').css('display', 'none');
                $('.chat_login').css('display', 'none');
                $('.chat_fullscreen_loader').css('display', 'block');
                break;
            case 3:
                $('#chat_converse').css('display', 'none');
                $('#chat_body').css('display', 'none');
                $('#chat_form').css('display', 'block');
                $('.chat_login').css('display', 'none');
                $('.chat_fullscreen_loader').css('display', 'block');
                break;
            case 4:
                $('#chat_converse').css('display', 'none');
                $('#chat_body').css('display', 'none');
                $('#chat_form').css('display', 'none');
                $('.chat_login').css('display', 'none');
                $('.chat_fullscreen_loader').css('display', 'block');
                $('#chat_fullscreen').css('display', 'block');
                break;
        }
    }
    //
    $('.nav li a').click(function(){
        $('.chat').removeClass('is-visible');
        $('.fab').removeClass('is-visible');
        $('.prime').removeClass('is-active');
    })
});
