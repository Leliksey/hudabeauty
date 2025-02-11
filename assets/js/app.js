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
    function initSlick() {
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
                    settings: "unslick"
                }
            },
        ]
    })
    .on('afterChange', onSliderAfterChange)
    .on('wheel', onSliderWheel);
    }
    initSlick()
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
        $(".main__img").attr("href", src);
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
        function destroySlick() {
            if ($(".slider-item").hasClass("slick-initialized")) {
                $(".slider-item").slick("unslick");
            }
        }
        
        function destroyOwl() {
            var $owl = $(".slider-item");
            if ($owl.hasClass("owl-carousel")) {
                $owl.trigger('destroy.owl.carousel')
                    .removeClass('owl-carousel owl-loaded')
                    .find('.owl-stage-outer').children().unwrap(); // Удаляем обёртку Owl
            }
        }
        setSliderHeight();
        $(window).on("resize", function() {
            if($(window).width() < 1025) {
                $(".slider-item").owlCarousel({
                    loop: true,
                    nav: false,
                    dots: true,
                    items: 1
                });
                
            } else {
                $(".slider-item").trigger('destroy.owl.carousel').removeClass('owl-carousel owl-loaded');
                initSlick()
                setSliderHeight();
            }
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


        let selectedIndex = -1; // Хранит выбранный рейтинг

    $(".addRev__stars svg").on("mouseenter", function () {
        let index = $(this).index();
        $(".addRev__stars svg").each(function (i) {
            $(this).find("path").css("fill", i <= index ? "#000" : "#fff");
        });
    });

    $(".addRev__stars").on("mouseleave", function () {
        updateStars(); // Возвращаемся к выбранному рейтингу
    });

    $(".addRev__stars svg").on("click", function () {
        selectedIndex = $(this).index(); // Фиксируем рейтинг
        updateStars();
    });

    function updateStars() {
        $(".addRev__stars svg").each(function (i) {
            $(this).find("path").css("fill", i <= selectedIndex ? "#000" : "#fff");
        });
    }


    $(".write_rev").on("click", function() {
        $(".block-add-review").show();
        $(".beTheFirst").hide();
        $(".reviews__content__scroll").show();
        $(".block-ask-question").hide();
        $(".signature__btn").removeClass("active");
        $(".signature").removeClass("toped");
        $(".write_rev").addClass("active");
    })
    $(".ask_que").on("click", function() {
        $(".beTheFirst").show();
        $(".reviews__content__scroll").hide();
        $(".block-add-review").hide();
        $(".block-ask-question").show();
        $(".signature__btn").removeClass("active");
        $(".ask_que").addClass("active");
        $(".signature").removeClass("toped");
    })
    $(".signature__btn").on("click", function() {
        $(".signature__btn").removeClass("active");
        $(this).addClass("active");
        $(".signature").removeClass("toped");
    })







    $(".form-rev-send, .form-ask-send").on("click", function () {
        let form = $(this).closest("form");
        let isReviewForm = form.hasClass("block-add-review");
        let isValid = true;

        // Очистка предыдущих ошибок
        form.find(".error-message").remove();
        form.find("input, textarea").removeClass("error");

        // Проверка рейтинга (только для формы отзыва)
        if (isReviewForm) {
            if ($(".addRev__stars svg.active").length === 0) {
                $(".addRev__stars").after("<div class='error-message'>Select a rating</div>");
                isValid = false;
            }
        }

        // Проверка текстовых полей и textarea
        form.find("input[type='text'], textarea").each(function () {
            if ($(this).val().trim() === "") {
                $(this).addClass("error").after("<div class='error-message'>This field is required</div>");
                isValid = false;
            }
        });

        // Проверка email
        let emailInput = form.find("input[type='text']").eq(-1); // Последний input — email
        let emailVal = emailInput.val().trim();
        let emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
        if (!emailRegex.test(emailVal)) {
            emailInput.addClass("error").after("<div class='error-message'>Enter a valid email</div>");
            isValid = false;
        }

        if (isValid) {
            if (isReviewForm) {
                $(".overlay").fadeIn(300);
                $("body").addClass("ovh");
                $(".popup__review").addClass("open");
            } else {
                $(".overlay").fadeIn(300);
                $("body").addClass("ovh");
                $(".popup__ask").addClass("open");
            }
        }
    });

    // Фиксация рейтинга
    let selectedItem = -1;
    $(".addRev__stars svg").on("mouseenter", function () {
        let index = $(this).index();
        $(".addRev__stars svg").each(function (i) {
            $(this).find("path").css("fill", i <= index ? "#000" : "#fff");
        });
    });

    $(".addRev__stars").on("mouseleave", function () {
        $(".addRev__stars svg").each(function (i) {
            $(this).find("path").css("fill", i <= selectedItem ? "#000" : "#fff");
        });
    });

    $(".addRev__stars svg").on("click", function () {
        selectedItem = $(this).index();
        $(".addRev__stars svg").removeClass("active");
        $(".addRev__stars svg").each(function (i) {
            $(this).find("path").css("fill", i <= selectedItem ? "#000" : "#fff");
            if (i <= selectedItem) $(this).addClass("active");
        });
    });



    let $btnTop = $(".btn-top");

    // Показывать кнопку при прокрутке вниз
    $(window).on("scroll", function () {
        if ($(this).scrollTop() > 300) {
            $btnTop.fadeIn();
        } else {
            $btnTop.fadeOut();
        }
    });

    // Плавный скролл наверх
    $btnTop.on("click", function () {
        $("html, body").animate({ scrollTop: 0 }, 500);
    });



    // $(".main__img").magnificPopup({
    //     type: "image",
    //     gallery: {
    //         enabled: true, // Включить галерею
    //     }
    // });


    // $(".popup-zoom").magnificPopup({
    //     type: "image",
    //     gallery: {
    //         enabled: true
    //     }
    // });

    // $('.main__img').on('mousemove', function(e) {
    //     const $img = $(this).find('img');
    //     const containerWidth = $(this).width();
    //     const containerHeight = $(this).height();
    //     const imgWidth = $img.width();
    //     const imgHeight = $img.height();

    //     const mouseX = e.pageX - $(this).offset().left;
    //     const mouseY = e.pageY - $(this).offset().top;

    //     const moveX = (imgWidth - containerWidth) * (mouseX / containerWidth);
    //     const moveY = (imgHeight - containerHeight) * (mouseY / containerHeight);

    //     $img.css('transform', `translate(-${moveX}px, -${moveY}px) scale(1.5)`);
    // });

    // $('.main__img').on('mouseleave', function() {
    //     $(this).find('img').css('transform', 'translate(0, 0) scale(1)');
    // });



    function checkVisibility() {
        var btnOrderTop = $('.btn_order_top');
        var actionBottom = $('.productInfo__action_bottom');

        // Если кнопка btn_order_top существует
        if (btnOrderTop.length) {
            // Получаем позицию кнопки и размер окна
            var buttonTopPosition = btnOrderTop.offset().top;
            var windowHeight = $(window).height();
            var windowScrollTop = $(window).scrollTop();

            // Если кнопка находится в области видимости экрана, скрываем action_bottom
            if (buttonTopPosition <= windowScrollTop + windowHeight && buttonTopPosition + btnOrderTop.outerHeight() > windowScrollTop) {
                actionBottom.fadeOut();  // Скрываем
            } else {
                actionBottom.fadeIn();  // Показываем
            }
        }
    }

    // Инициализируем проверку видимости при загрузке страницы и при прокрутке
    checkVisibility();
    $(window).on('scroll', function() {
        checkVisibility();
    });


    $(".popup__age-btn").on("click", function () {
        validateAge($(this).closest("form"));
    });
    
    // Обработчик нажатия Enter в поле ввода
    $("input[name='age']").on("keydown", function (event) {
        if (event.key === "Enter") {
            event.preventDefault(); // Предотвращаем стандартное поведение (например, отправку формы)
            validateAge($(this).closest("form"));
        }
    });
    
    function validateAge(form) {
        let $input = form.find("input[name='age']");
        let value = $input.val().trim();
        let regex = /^\d{4}\.\d{2}\.\d{2}$/; // Формат YYYY.MM.DD
        let isValid = true;
    
        // Очистка предыдущих ошибок
        form.find(".error").removeClass("error");
        form.find(".error-message").remove();
    
        if (!regex.test(value)) {
            $input.addClass("error");
            if ($input.next(".error-message").length === 0) {
                $input.after("<div class='error-message'>Введите дату в формате YYYY.MM.DD</div>");
            }
            isValid = false;
        } else {
            // Проверяем, чтобы дата была реальной
            let parts = value.split(".");
            let year = parseInt(parts[0], 10);
            let month = parseInt(parts[1], 10);
            let day = parseInt(parts[2], 10);
            let date = new Date(year, month - 1, day);
    
            if (
                date.getFullYear() !== year ||
                date.getMonth() + 1 !== month ||
                date.getDate() !== day
            ) {
                $input.addClass("error");
                if ($input.next(".error-message").length === 0) {
                    $input.after("<div class='error-message'>Введите корректную дату!</div>");
                }
                isValid = false;
            }
        }
    
        if (isValid) {
            $(".popup__content").hide();
            $(".popup__age-step2").show();
        }
    }
    
    // Разрешаем ввод только цифр и точки + автоформатирование YYYY.MM.DD
    $("input[name='age']").on("input", function () {
        let value = this.value.replace(/[^0-9]/g, ""); // Убираем всё, кроме цифр
        if (value.length > 8) value = value.substring(0, 8); // Ограничение до 8 символов
    
        let formattedValue = "";
        if (value.length > 4) {
            formattedValue = value.substring(0, 4) + "." + value.substring(4);
        } else {
            formattedValue = value;
        }
        if (value.length > 6) {
            formattedValue = formattedValue.substring(0, 7) + "." + value.substring(6);
        }
    
        this.value = formattedValue;
    });
    
    $(".activate_btn").on("click", function () {
        $(".popup__age, .overlay__white").hide();
        $("body").removeClass("ovh");
    });
    
    
});