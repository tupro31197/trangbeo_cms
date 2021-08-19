$(function() {

    "use strict";

    //===== Prealoder

    $(window).on('load', function(event) {
        $('.preloader').delay(500).fadeOut(500);
    });


    //===== Mobile Menu 

    $(".navbar-toggler").on('click', function() {
        $(this).toggleClass('active');
    });

    $(".navbar-nav a").on('click', function() {
        $(".navbar-toggler").removeClass('active');
    });


    //===== close navbar-collapse when a  clicked

    $(".navbar-nav a").on('click', function() {
        $(".navbar-collapse").removeClass("show");
    });


    //===== Sticky

    $(window).on('scroll', function(event) {
        var scroll = $(window).scrollTop();
        if (scroll < 10) {
            $(".navigation-bar").removeClass("sticky");
        } else {
            $(".navigation-bar").addClass("sticky");
        }
    });


    //===== Section Menu Active

    var scrollLink = $('.page-scroll');
    // Active link switching
    $(window).scroll(function() {
        var scrollbarLocation = $(this).scrollTop();

        scrollLink.each(function() {

            var sectionOffset = $(this.hash).offset().top - 90;

            if (sectionOffset <= scrollbarLocation) {
                $(this).parent().addClass('active');
                $(this).parent().siblings().removeClass('active');
            }
        });
    });


    //===== wow

    new WOW().init();


    //===== AOS

    AOS.init({
        duration: 800,
    });


    //===== Slick project

    $('.slick').slick({
        dots: false,
        prevArrow: false,
        nextArrow: false,
        infinite: true,
        slidesToShow: 3,
        slidesToScroll: 1,
        autoplay: true,
        autoplaySpeed: 1500,
        responsive: [{
                breakpoint: 1024,
                settings: {
                    slidesToShow: 3,
                    slidesToScroll: 3,
                    infinite: true,

                }
            },
            {
                breakpoint: 600,
                settings: {
                    slidesToShow: 2,
                    slidesToScroll: 2
                }
            },
            {
                breakpoint: 480,
                settings: {
                    slidesToShow: 1,
                    slidesToScroll: 1
                }
            }
            // You can unslick at a given breakpoint now by adding:
            // settings: "unslick"
            // instead of a settings object
        ]
    });

    $('.slick_video').slick({
        dots: false,
        prevArrow: false,
        nextArrow: false,
        infinite: true,
        slidesToShow: 1,
        slidesToScroll: 1,
        autoplay: true,
        autoplaySpeed: 3000,

    });

    $('.slick_image').slick({
        prevArrow: false,
        nextArrow: false,
        infinite: true,
        speed: 500,
        fade: true,
        cssEase: 'linear',
        autoplay: true,
        autoplaySpeed: 2000,
    });

    //===== Slick Testimonial



    //===== Back to top

    // Show or hide the sticky footer button
    $(window).on('scroll', function(event) {
        if ($(this).scrollTop() > 600) {
            $('.back-to-top').fadeIn(200)
        } else {
            $('.back-to-top').fadeOut(200)
        }
    });

    //Animate the scroll to yop
    $('.back-to-top').on('click', function(event) {
        event.preventDefault();

        $('html, body').animate({
            scrollTop: 0,
        }, 1500);
    });





    const second = 1000,
        minute = second * 60,
        hour = minute * 60,
        day = hour * 24;
    var tomorrow = new Date();
    tomorrow.setDate(tomorrow.getDate() + 1);
    let today = new Date(),
        countDown = new Date(today.getTime() + 1000);

    var now = today.getDate() + '/' + (today.getMonth() + 1) + '/' + today.getFullYear();

    x = setInterval(function() {
        var d = new Date();
        var hours = 24 - d.getHours();
        var min = 60 - d.getMinutes();
        if ((min + '').length == 1) {
            min = '0' + min;
        }
        var sec = 60 - d.getSeconds();
        if ((sec + '').length == 1) {
            sec = '0' + sec;
        }
        document.getElementById("today").innerHTML = now,
            document.getElementById("hours").innerHTML = hours,
            document.getElementById("minutes").innerHTML = min,
            document.getElementById("seconds").innerHTML = sec;

        //do something later when date is reached

        //seconds
    }, 0)




});