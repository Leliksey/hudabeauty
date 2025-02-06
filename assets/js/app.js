$(document).ready(function() {
    const slider = $(".slider-item");

    function onSliderAfterChange(event, slick, currentSlide) {
        $(event.target).data('current-slide', currentSlide);
    }
    
    function onSliderWheel(e) {
        var deltaY = e.originalEvent.deltaY,
        $currentSlider = $(e.currentTarget),
        currentSlickIndex = $currentSlider.data('current-slide') || 0;
        
        if (
        // check when you scroll up
        (deltaY < 0 && currentSlickIndex == 0) ||
        // check when you scroll down
        (deltaY > 0 && currentSlickIndex == $currentSlider.data('slider-length') - 1)
        ) {
        return;
        }

        e.preventDefault();

        if (e.originalEvent.deltaY < 0) {
        $currentSlider.slick('slickPrev');
        } else {
        $currentSlider.slick('slickNext');
        }
    }
    
    slider.each(function(index, element) {
        var $element = $(element);
        // set the length of children in each loop
        // but the better way for performance is to set this data attribute on the div.slider in the markup
        $element.data('slider-length', $element.children().length);
    })
    .slick({
        infinite: true,
        slidesToShow: 9,
        slidesToScroll: 1,
        dots: false,
        arrows: true,
        vertical: true,
        centerMode: true,
        centerPadding: 0,
        responsive: [
            {
                breakpoint: 1024, // При ширине экрана <= 1024px
                settings: {
                    vertical: false,
                }
            },
        ]
    })
    .on('afterChange', onSliderAfterChange)
    .on('wheel', onSliderWheel);

    function killSlider() {
        if($(window).width() < 1025 ) {
            $(slider).slick('unslick');
            $(".slider-item-img").removeClass("active")
        }
    }
    killSlider()



    $(".slider-item-img").on("click", function() {
        let src = $(this).find("img").attr("src");
        $(".main__img img, .productInfo__main_img img").attr("src", src);
        if($(window).width() > 1024 ) {
            $(".slider-item-img").removeClass("active");
            $(this).addClass("active");
        }
    })
    $(".productInfo__heading svg").on('click', function() {
        $(this).toggleClass("active")
    });

    function formatDate(date) {
        let day = date.getDate().toString().padStart(2, '0');
        let month = (date.getMonth() + 1).toString().padStart(2, '0'); // Январь — 0, поэтому +1
        return `${day}.${month}`;
    }

    let today = new Date();
    let fromDate = new Date();
    fromDate.setDate(today.getDate() - 3); // Отнимаем 3 дня

    $("#from").text(formatDate(fromDate));
    $("#to").text(formatDate(today));



    $(".product__tabs-item").click(function() {
        // $(this).parent().find(".product__tabs-item").removeClass("active"); 
        // $(this).addClass("active");
        $(this).next().slideToggle();
    });
    $(document).on("click", ".product__tabs-item", function(e) {
        e.preventDefault();
        $(this).toggleClass("open");
      });



      let hasScrolled = false;

        $(window).on("scroll", function () {
            if ($(this).scrollTop() > 150 && !hasScrolled) {
                hasScrolled = true;
                onScrollDown(); // Функция при начале скроллинга вниз
            } else if ($(this).scrollTop() === 0 && hasScrolled) {
                hasScrolled = false;
                onScrollTop(); // Функция при возврате наверх
            }
        });

        function onScrollDown() {
            $(".header").addClass("fix")
        };

        function onScrollTop() {
            $(".header").removeClass("fix")
        };




        $(".overlay, .popup__close").on("click", function() {
            $(".overlay").fadeOut(300);
            $(".popup").removeClass("open");
            $("body").removeClass("ovh");
        });
        $(".productInfo__delivery").on("click", function() {
            $(".overlay").fadeIn(300);
            $("body").addClass("ovh");
            $(".popup__delivery").addClass("open");
        });


        function setSliderHeight() {
            let mainImgHeight = $(".main__img img").height();
            if (mainImgHeight && $(window).width() > 1024 ) {
                $(".slider-item").height(mainImgHeight);
            }
        }


        function initOwl() {
            if($(window).width() < 1025 ) {
                $(".slider-item").owlCarousel({
                    loop: true,
                    nav: false,
                    dots: true,
                    items: 1
                });
            }
        }
        initOwl()
        setSliderHeight();
        $(window).on("resize", function() {
            setSliderHeight();
            killSlider();
            $(".slider-item").trigger('destroy.owl.carousel').removeClass('owl-carousel owl-loaded');;
            initOwl();
        });




        $(".plus").on("click", function () {
            let $count = $(this).siblings(".count");
            let value = parseInt($count.text(), 10);
            $count.text(value + 1);
        });
    
        $(".minus").on("click", function () {
            let $count = $(this).siblings(".count");
            let value = parseInt($count.text(), 10);
            if (value > 1) {
                $count.text(value - 1);
            }
        });
});