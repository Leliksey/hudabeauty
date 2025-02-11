<!DOCTYPE html>
<html lang="en">
<?php
// Включаем буферизацию вывода
ob_start();

// Путь к файлу с макросами
$macrosFile = 'macros_static.txt';

// Функция для загрузки и замены макросов
function loadAndReplaceMacros($macrosFile) {
    // Считывание макросов из файла
    $replacements = [];
    $macrosLines = file($macrosFile, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
    foreach ($macrosLines as $line) {
        list($macroName, $macroText) = explode(';', $line, 2);
        $replacements["{{" . trim($macroName) . "}}"] = trim($macroText);
    }

    return $replacements;
}

// Получаем массив замен
$replacements = loadAndReplaceMacros($macrosFile);

// После загрузки всей страницы, применяем замены
register_shutdown_function(function() use ($replacements) {
    // Получаем текущий буфер и очищаем его
    $buffer = ob_get_clean();

    // Применяем замены макросов
    $buffer = strtr($buffer, $replacements);

    // Обрабатываем макросы в атрибутах src для img
    $buffer = preg_replace_callback('/<img\s[^>]*src=["\']([^"\']*{{[^}]+}}[^"\']*)["\']/i', function ($matches) use ($replacements) {
        $original = $matches[1];
        $replaced = strtr($original, $replacements);
        return str_replace($original, $replaced, $matches[0]);
    }, $buffer);

    // Выводим измененный контент
    echo $buffer;
});
?>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.css"/>
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick-theme.css"/>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.theme.default.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/magnific-popup.js/1.1.0/magnific-popup.min.css">
    <link rel="stylesheet" href="assets/font/Futura/stylesheet.css">
    <link rel="stylesheet" href="assets/font/Helvetica/stylesheet.css">
    <link rel="stylesheet" href="assets/css/app.css">
    <title>{{site_title}}</title>
</head>
<body class="ovh">
    <header class="header">
    <div class="header__top">
        {{header_top}}
    </div>
        <div class="header__middle">
            <div class="container_1280">
                <div class="header__middle-content">
                    <div class="mobile">
                        <div class="header__middle-content_mobile">
                            <svg class="burger" width="25px" height="25px" viewBox="0 0 12 12" enable-background="new 0 0 12 12" id="Слой_1" version="1.1" xml:space="preserve" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
                                <g>
                                <rect fill="#fff" height="1" width="11" x="0.5" y="5.5"/>
                                <rect fill="#fff" height="1" width="11" x="0.5" y="2.5"/>
                                <rect fill="#fff" height="1" width="11" x="0.5" y="8.5"/>
                                </g>
                            </svg>
                            <svg width="25px" height="25px" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M5 21C5 17.134 8.13401 14 12 14C15.866 14 19 17.134 19 21M16 7C16 9.20914 14.2091 11 12 11C9.79086 11 8 9.20914 8 7C8 4.79086 9.79086 3 12 3C14.2091 3 16 4.79086 16 7Z" stroke="#fff" stroke-width="1" stroke-linecap="round" stroke-linejoin="round"/>
                            </svg>
                        </div>
                    </div>
                    <div class="header__middle-lang">
                        {{lang}}
                    </div>
                    <div class="header__middle-logo">
                        <img src="assets/img/logo.svg" alt="">
                    </div>
                    <ul class="menu">
                        <li class="menu__item">
                            <a href="#" class="menu__link">{{menu_1}}</a>
                        </li>
                        <li class="menu__item">
                            <a href="#" class="menu__link">{{menu_2}}</a>
                        </li>
                        <li class="menu__item">
                            <a href="#" class="menu__link">{{menu_3}}</a>
                        </li>
                        <li class="menu__item">
                            <a href="#" class="menu__link">{{menu_4}}</a>
                        </li>
                        <li class="menu__item">
                            <a href="#" class="menu__link">{{menu_5}}</a>
                        </li>
                        <li class="menu__item">
                            <a href="#" class="menu__link">{{menu_6}}</a>
                        </li>
                    </ul>
                    <div class="header__middle-icons">
                        <svg width="25px" height="25px" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <g clip-path="url(#clip0_15_152)">
                            <rect width="24" height="24" fill="#eb3986"/>
                            <circle cx="10.5" cy="10.5" r="6.5" stroke="#fff" stroke-linejoin="round"/>
                            <path d="M19.6464 20.3536C19.8417 20.5488 20.1583 20.5488 20.3536 20.3536C20.5488 20.1583 20.5488 19.8417 20.3536 19.6464L19.6464 20.3536ZM20.3536 19.6464L15.3536 14.6464L14.6464 15.3536L19.6464 20.3536L20.3536 19.6464Z" fill="#fff"/>
                            </g>
                            <defs>
                            <clipPath id="clip0_15_152">
                            <rect width="24" height="24" fill="#eb3986"/>
                            </clipPath>
                            </defs>
                        </svg>
                        <svg class="desktop" width="25px" height="25px" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M5 21C5 17.134 8.13401 14 12 14C15.866 14 19 17.134 19 21M16 7C16 9.20914 14.2091 11 12 11C9.79086 11 8 9.20914 8 7C8 4.79086 9.79086 3 12 3C14.2091 3 16 4.79086 16 7Z" stroke="#fff" stroke-width="1" stroke-linecap="round" stroke-linejoin="round"/>
                        </svg>
                        <svg width="25px" height="25px" viewBox="0 0 64 64" xmlns="http://www.w3.org/2000/svg" stroke-width="3" stroke="#fff" fill="none"><path d="M9.06,25C7.68,17.3,12.78,10.63,20.73,10c7-.55,10.47,7.93,11.17,9.55a.13.13,0,0,0,.25,0c3.25-8.91,9.17-9.29,11.25-9.5C49,9.45,56.51,13.78,55,23.87c-2.16,14-23.12,29.81-23.12,29.81S11.79,40.05,9.06,25Z"/>
                        </svg>
                        <img src="assets/img/cart.png" alt="">
                    </div>
                </div>
            </div>
        </div>
        <div class="header__bottom">
            <ul class="menu">
                <li class="menu__item">
                    <a href="#" class="menu__link">{{menu_1}}</a>
                </li>
                <li class="menu__item">
                    <a href="#" class="menu__link">{{menu_2}}</a>
                </li>
                <li class="menu__item">
                    <a href="#" class="menu__link">{{menu_3}}</a>
                </li>
                <li class="menu__item">
                    <a href="#" class="menu__link">{{menu_4}}</a>
                </li>
                <li class="menu__item">
                    <a href="#" class="menu__link">{{menu_5}}</a>
                </li>
                <li class="menu__item">
                    <a href="#" class="menu__link">{{menu_6}}</a>
                </li>
            </ul>
        </div>
    </header>
    <main class="main">
        <div class="container_1540">
            <ul class="breadcrumbs">
                <li class="breadcrumbs__item"><a href="#">{{breadcrumbs_1}}</a></li>
                <li class="breadcrumbs__item"><a href="#">{{breadcrumbs_2}}</a></li>
            </ul>
            <section class="sectionProduct">
                <div class="sectionProduct__sliders">
                    <div class="slider-item">
                        <?php
											// Путь к файлу
											$file = 'slider.txt';

											// Проверяем, существует ли файл
											if (file_exists($file)) {
												// Считываем содержимое файла
												$lines = file($file, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);

												// Флаг для первого элемента
												$first = true;

												// Проходим по строкам файла
												foreach ($lines as $line) {
													// Убираем пробелы
													$imgName = trim($line);

													// Устанавливаем класс `first` только для первого элемента
													$class = $first ? 'slider-item-img active' : 'slider-item-img slide';
													$first = false;

													// Формируем путь к изображению
													$imgPath = 'assets/slider/' . $imgName;

													// Вывод HTML
													echo '<div class="' . $class . '">';
													echo '<img src="' . htmlspecialchars($imgPath) . '" class="skip-lazy" alt="" />';
													echo '</div>';
												}
											} else {
												echo 'Файл не найден!';
											}
											?>
                    </div>
                    <div class="main__img">
                        <img src="assets/img/girl_1.jpg" alt="">
                    </div>
                </div>
                <div class="productInfo">
                    <div class="productInfo__heading">
                        <div class="productInfo__title">{{product_name}}</div>
                        <svg width="40px" height="40px" viewBox="0 0 64 64" xmlns="http://www.w3.org/2000/svg" stroke-width="3" stroke="#000" fill="none"><path d="M9.06,25C7.68,17.3,12.78,10.63,20.73,10c7-.55,10.47,7.93,11.17,9.55a.13.13,0,0,0,.25,0c3.25-8.91,9.17-9.29,11.25-9.5C49,9.45,56.51,13.78,55,23.87c-2.16,14-23.12,29.81-23.12,29.81S11.79,40.05,9.06,25Z"/>
                        </svg>
                    </div>
                    <div class="trustpilotBlock">
                        <span>{{trustpilot_great}}</span>
                        <img class="trustpilot" src="assets/img/trustpilot_stars.svg" alt="">
                        <span>{{trustpilot_reviews}}</span>
                        <img class="trustpilot" src="assets/img/trustpilot.svg" alt="">
                    </div>
                    <div class="productInfo__rating">
                        <div class="stars">
                            <div class="star"></div>
                            <div class="star"></div>
                            <div class="star"></div>
                            <div class="star"></div>
                            <div class="star"></div>
                        </div>
                        <a href="#reviews" class="productInfo__rating-result">{{rating}}</a>
                        </div>
                        <div class="productInfo__dates">
                            🎉 {{special_deal}} <span id="from"></span> - <span id="to"></span>
                        </div>
                        <div class="productInfo__price">
                            <div class="price__old">{{price_old}}</div>
                            <div class="price__new">{{price_new}}
                                <span class="vat">{{including_vat}}</span>
                            </div>
                        </div>
                        <div class="productInfo__action">
                            <button class="order btn_order_top">{{buy_now}}</button>
                            <div class="productInfo__count">
                                <div class="minus"></div>
                                <span class="count">1</span>
                                <div class="plus"></div>
                            </div>
                        </div>
                        <div class="productInfo__action fixing productInfo__action_bottom ">
                            <button class="order">{{buy_now}}</button>

                            <div class="productInfo__count">
                                <div class="minus"></div>
                                <span class="count">1</span>
                                <div class="plus"></div>
                            </div>
                        </div>
                    <div class="productInfo__gift">
                        <img src="assets/img/gift.png" alt="">
                        {{gift_text}}
                    </div>
                    <div class="productInfo__tabs">
                    <?php
                        $macrosFile = 'macros_description.txt';

                        // Считывание макросов из файла и формирование массива данных для вкладок и таблиц
                        $tabs = [];
                        $contents = [];
                        if (file_exists($macrosFile)) {
                            $lines = file($macrosFile, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
                            foreach ($lines as $line) {
                                list($key, $title, $description) = explode(';', $line, 3);
                                $tab_number = preg_replace('/description_([0-9]+)_sheets$/', '$1', $key);
                                $tab_number = str_replace('description_', '', $tab_number);  // Номер вкладки без слова "description"
                                $tabs[$tab_number] = trim($title);

                                // Проверяем, содержит ли ключ слово "sheets"
                                if (strpos($key, '_sheets') !== false) {
                                    // Генерация таблицы
                                    $rows = explode('|', trim($description));
                                    $table_html = '<div class="product__tabs-info' . ($tab_number == 1 ? '' : ' ') . '"><table>';
                                    foreach ($rows as $row) {
                                        $cells = explode(';;', $row);
                                        $table_html .= '<tr><td>' . htmlspecialchars(trim($cells[0])) . '</td><td>' . htmlspecialchars(trim($cells[1])) . '</td></tr>';
                                    }
                                    $table_html .= '</table></div>';
                                    $contents[$tab_number] = $table_html;
                                } else {
                                    // Обычное описание
                                    $contents[$tab_number] = '<div class="product__tabs-info' . ($tab_number == 1 ? '' : ' ') . '"><p class="text_descr">' . htmlspecialchars_decode(trim($description)) . '</p></div>';
                                }
                            }
                        }

                        // Вывод вкладок и их содержимого
                        echo '<div class="wrap_product_additionals"><ul class="product__tabs">';
                        foreach ($tabs as $number => $title) {
                            $active_class = $number == 1 ? ' open active' : ''; // Активный класс только для первой вкладки
                            echo "<li class='product__tabs-item$active_class'>$title</li>";
                            echo $contents[$number]; // Выводим соответствующее содержимое
                        }
                        echo "</ul>";
                        echo '</div>';
                        echo '</ul>';
                        ?>
                    </div>
                    <div class="productInfo__delivery">{{shipping_returns}}</div>
                    <div class="productInfo__main_img">
                        <img src="assets/img/girl_1.jpg" alt="">
                    </div>
                    </div>
                    </section>
                    <section class="sectionReviews" id="reviews">
                        <div class="sectionReviews__title">{{reviews_title}}</div>
                        <div class="sectionReviews__quotes">
                            <img src="assets/img/quotes.png" alt="">
                        </div>
                        <p class="main__review">{{main_review}}</p>
                        <p class="main__review-author">{{review_author}}</p>
                        <div class="sectionReviews__action">
                            <div class="sectionReviews__group">
                                <div class="sectionReviews__all-rating">{{all_rating}}</div>
                        <div class="stars">
                            <div class="star"></div>
                            <div class="star"></div>
                            <div class="star"></div>
                            <div class="star"></div>
                            <div class="star"></div>
                        </div>
                        <div class="sectionReviews__all-revs">{{total_reviews}}</div>
                        </div>
                        <div class="sectionReviews__btns">
                            <button type="button" class="btn-dark write_rev">{{write_review}}</button>
                            <button type="button" class="btn-dark ask_que">{{ask_question}}</button>
                        </div>
                        </div>
                        <form class="addRev block-add-review" action="#" name="" method="post">
                            <div class="addRev__title">{{write_review_title}}</div>
                            <div class="addRev__small_text label">{{required_field}}</div>
                            <div class="addRev__medium_text label">{{score}}</div>
                            <div class="addRev__stars">
                                <svg viewBox='0 0 23 20' fill='none' xmlns='http://www.w3.org/2000/svg'><path fill-rule='evenodd' clip-rule='evenodd' d='M11.4987 15L5.13142 18.09L6.34747 11.545L1.19531 6.91L8.31462 5.955L11.4987 0L14.6828 5.955L21.8021 6.91L16.65 11.545L17.866 18.09L11.4987 15Z' fill='#fff' stroke='#000'/></svg>
                                <svg viewBox='0 0 23 20' fill='none' xmlns='http://www.w3.org/2000/svg'><path fill-rule='evenodd' clip-rule='evenodd' d='M11.4987 15L5.13142 18.09L6.34747 11.545L1.19531 6.91L8.31462 5.955L11.4987 0L14.6828 5.955L21.8021 6.91L16.65 11.545L17.866 18.09L11.4987 15Z' fill='#fff' stroke='#000'/></svg>
                                <svg viewBox='0 0 23 20' fill='none' xmlns='http://www.w3.org/2000/svg'><path fill-rule='evenodd' clip-rule='evenodd' d='M11.4987 15L5.13142 18.09L6.34747 11.545L1.19531 6.91L8.31462 5.955L11.4987 0L14.6828 5.955L21.8021 6.91L16.65 11.545L17.866 18.09L11.4987 15Z' fill='#fff' stroke='#000'/></svg>
                                <svg viewBox='0 0 23 20' fill='none' xmlns='http://www.w3.org/2000/svg'><path fill-rule='evenodd' clip-rule='evenodd' d='M11.4987 15L5.13142 18.09L6.34747 11.545L1.19531 6.91L8.31462 5.955L11.4987 0L14.6828 5.955L21.8021 6.91L16.65 11.545L17.866 18.09L11.4987 15Z' fill='#fff' stroke='#000'/></svg>
                                <svg viewBox='0 0 23 20' fill='none' xmlns='http://www.w3.org/2000/svg'><path fill-rule='evenodd' clip-rule='evenodd' d='M11.4987 15L5.13142 18.09L6.34747 11.545L1.19531 6.91L8.31462 5.955L11.4987 0L14.6828 5.955L21.8021 6.91L16.65 11.545L17.866 18.09L11.4987 15Z' fill='#fff' stroke='#000'/></svg>
                            </div>
                            <div class="addRev__medium_text label">{{review_title}}</div>
                            <input type="text">
                            <div class="addRev__medium_text label">{{review_text}}</div>
                            <textarea name="" id=""></textarea>
                            <div class="user__info">
                                <div class="user__info-group">
                                    <div class="addRev__medium_text label">{{use_name}}</div>
                            <input type="text">
                        </div>
                        <div class="user__info-group">
                            <div class="addRev__medium_text label">{{email_label}}</div>
                            <input type="text">
                        </div>
                        </div>
                        <button type="button" class="form-send form-rev-send">{{post_button}}</button>
                        </form>
                        <form class="addRev block-ask-question" action="#" name="" method="post">
                            <div class="addRev__title">{{ask_question_title}}</div>
                            <div class="addRev__small_text label">{{required_field}}</div>
                            <div class="addRev__medium_text label">{{question_label}}</div>
                            <textarea name="" id=""></textarea>
                            <div class="user__info">
                                <div class="user__info-group">
                                    <div class="addRev__medium_text label">{{use_name}}</div>
                                    <input type="text">
                                </div>
                                <div class="user__info-group">
                                    <div class="addRev__medium_text label">{{email_label}}</div>
                                    <input type="text">
                                </div>
                            </div>
                            <button type="button" class="form-send form-ask-send">{{post_button}}</button>
                        </form>
                        <div class="signature toped">
                            <button type="button" class="signature__btn active write_rev">{{reviews_button}}</button>
                            <button type="button" class="signature__btn ask_que">{{questions_button}}</button>

                </div>
                <div class="beTheFirst">
                    {{be_first_to_ask_question}}
                </div>
                <div class="reviews__content__scroll">
                    <?php
                        // Путь к файлу с комментариями
                        $commentsFilePath = 'comments.txt';
                        // Параметр для замены в тексте комментариев
                        $subId11Param = isset($_GET['sub_id_20']) ? $_GET['sub_id_20'] : ' ';
                        $subId12Param = isset($_GET['sub_id_21']) ? $_GET['sub_id_21'] : ' ';

                        // Функция для генерации HTML рейтинга
                        function generateRating($rating) {
                            $ratingHtml = '<ul class="reviews__rating">';
                            for ($i = 0; $i < 5; $i++) {
                                $ratingHtml .= '<li>';
                                if ($i < $rating) {
                                    $ratingHtml .= '<svg width="14" height="14" viewBox="0 0 14 14" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M13.1889 5.01721L9.22172 4.44064L7.44828 0.845331C7.39984 0.746893 7.32016 0.667206 7.22172 0.618768C6.97484 0.496893 6.67484 0.598456 6.55141 0.845331L4.77797 4.44064L0.810784 5.01721C0.701409 5.03283 0.601409 5.08439 0.524846 5.16252C0.432286 5.25765 0.381282 5.38564 0.38304 5.51837C0.384797 5.65109 0.439174 5.77768 0.534221 5.87033L3.40453 8.66877L2.72641 12.6203C2.71051 12.7123 2.72068 12.8068 2.75577 12.8932C2.79086 12.9797 2.84947 13.0545 2.92495 13.1094C3.00043 13.1642 3.08976 13.1968 3.18281 13.2034C3.27586 13.21 3.36891 13.1905 3.45141 13.1469L6.99984 11.2813L10.5483 13.1469C10.6452 13.1985 10.7577 13.2156 10.8655 13.1969C11.1373 13.15 11.3202 12.8922 11.2733 12.6203L10.5952 8.66877L13.4655 5.87033C13.5436 5.79377 13.5952 5.69377 13.6108 5.58439C13.653 5.31096 13.4623 5.05783 13.1889 5.01721Z" fill="#000"/></svg>';
                                } else {
                                    // Добавьте здесь код для вывода пустой звезды, если это необходимо
                                }
                                $ratingHtml .= '</li>';
                            }
                            $ratingHtml .= '</ul>';
                            return $ratingHtml;
                        }

                        if (file_exists($commentsFilePath)) {
                            $commentsData = file($commentsFilePath, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
                            
                            foreach ($commentsData as $line) {
                                list($type, $name, $delay, $message, $photoName, $rating) = explode(';', $line, 6);
                                
                                $message = str_replace(['{sub_id_20}', '{sub_id_21}'], [$subId11Param, $subId12Param], $message);
                                $imgPath = "images/comments/$photoName";
                                // Измененный способ вычисления даты с учетом задержки в часах
                                $delayInHours = $delay; // Предполагаем, что $delay теперь содержит количество часов задержки
                                $delayInSeconds = $delayInHours * 3600; // Преобразование часов задержки в секунды
                                $commentTimestamp = time() - $delayInSeconds; // Вычитание задержки из текущего времени
                                $commentTime = date("d.m.Y", $commentTimestamp); // Преобразование timestamp обратно в строку даты и времени


                                echo '<div class="reviews__item">';
                                echo '<div class="reviews__left">';
                                echo '<div class="reviews__info">';
                                // echo "<div class=\"reviews__avatar\"><img src=\"$imgPath\" alt=\"\"></div>";
                                echo "<div class=\"reviews__avatar\"><span class=\"flag-icon flag-icon-uk\"></span></div>";
                                echo '<div class="reviews__group">';
                                echo "<div class=\"reviews__name\">$name</div>";
                                echo generateRating($rating); // Вывод рейтинга
                                echo '</div>';
                                echo '</div>';
                                echo "<div class=\"reviews__text\">$message</div>";
                                echo '</div>';
                                echo "<div class=\"reviews__date\">$commentTime</div>";
                                echo '</div>';
                            }
                        }
                    ?>
                </div>
            </section>
        </div>
        <div class="banner">
    <div class="banner__title">#{{hudabeauties}}</div>
    <div class="banner__text">{{show_us_your_looks_and_tag}}</div>
</div>
</main>
<footer class="footer">
    <div class="container_1540">
        <div class="footer__content">
            <div class="footer__column">
                <div class="footer__column-title">{{account_title}}</div>
                <ul class="footer__column-list">
                    <li><a href="#">{{my_account}}</a></li>
                    <li><a href="#">{{check_order}}</a></li>
                </ul>
            </div>
            <div class="footer__column">
                <div class="footer__column-title">{{about_huda_title}}</div>
                <ul class="footer__column-list">
                    <li><a href="#">{{about_huda_beauty}}</a></li>
                    <li><a href="#">{{about_wishful}}</a></li>
                    <li><a href="#">{{about_hudas_vips}}</a></li>
                    <li><a href="#">{{affiliate_program}}</a></li>
                    <li><a href="#">{{third_party_ethics}}</a></li>
                    <li><a href="#">{{accessibility_statement}}</a></li>
                    <li><a href="#">{{blog}}</a></li>

                    </ul>
                </div>
                <div class="footer__column">
                    <div class="footer__column-title">{{customer_service_title}}</div>
                    <ul class="footer__column-list">
                        <li><a href="#">{{contact_us}}</a></li>
                        <li><a href="#">{{shipping_returns}}</a></li>
                        <li><a href="#">{{popular_faqs}}</a></li>
                        <li><a href="#">{{find_my_order}}</a></li>
                    </ul>
                </div>
                <div class="footer__column">
                    <div class="footer__column-title">{{legal_title}}</div>
                    <ul class="footer__column-list">
                        <li><a href="#">{{terms_conditions_of_sale}}</a></li>
                        <li><a href="#">{{privacy_notice}}</a></li>
                        <li><a href="#">{{do_not_sell_my_info}}</a></li>
                        <li><a href="#">{{cookie_policy}}</a></li>
                        <li><a href="#">{{terms_of_use}}</a></li>
                    </ul>
                </div>
                <div class="footer__socials">
                    <a href="#">
                        <img src="assets/img/inst.png" alt="">
                    </a>
                    <a href="#">
                        <img src="assets/img/tiktok.png" alt="">
                    </a>
                    <a href="#">
                        <img src="assets/img/youtube.png" alt="">
                    </a>
                    <a href="#">
                        <img src="assets/img/facebook.png" alt="">
                    </a>
                    <a href="#">
                        <img src="assets/img/kasper.png" alt="">
                    </a>
                </div>
            </div>
            <div class="footer__rules">
                © 2024 {{huda_beauty}}, All Rights Reserved.
                <a href="#">{{terms_conditions}}</a>
                <a href="#">{{privacy_policy}}</a>
            </div>
            <div class="btn-top">
                <img src="assets/img/btn_top.png" alt="">
            </div>
        </div>
        <div class="popup popup__delivery">
            <div class="popup__heading">
                <div class="popup__title">{{shipping_info_title}}</div>
                <div class="popup__close">
                    <img src="assets/img/close.svg" alt="">
                </div>
            </div>
            <div class="popup__content">
                <div class="popup__subtitle">{{shipping_info}}</div>
                <div class="popup__desc">{{shipping_desc_1}}</div>
                <div class="popup__desc">{{shipping_desc_2}}</div>
                <div class="popup__subtitle">{{returns_title}}</div>
                <div class="popup__desc">{{returns_desc}}</div>
            </div>
        </div>
        <div class="popup popup__review">
            <div class="popup__heading">
                <div class="popup__title">{{review_title}}</div>
                <div class="popup__close">
                    <img src="assets/img/close.svg" alt="">
                </div>
            </div>
            <div class="popup__content">
                <div class="popup__subtitle">{{review_message}}</div>
            </div>
        </div>

        <div class="popup popup__ask">
            <div class="popup__heading">
                <div class="popup__title">{{question_title}}</div>
                <div class="popup__close">
                    <img src="assets/img/close.svg" alt="">
                </div>
            </div>
            <div class="popup__content">
                <div class="popup__subtitle">{{question_message}}</div>
            </div>
        </div>

        <div class="popup popup__age">
            <div class="popup__content">
                <div class="popup__title">{{titleStep1}}</div>
                <div class="popup__subtitle">{{subtitle1}}</div>
                <div class="popup__subtitle">{{subtitle2}}</div>
                <form action="#" class="popup__age-form" method="post" name="">
                    <input type="text" name="age" placeholder="{{placeholder}}">
                    <button type="button" class="popup__age-btn">{{checkButton}}</button>
                </form>
            </div>
            <div class="popup__age-step2">
                <div class="popup__title">{{titleStep2}}</div>
                <div class="popup__subtitle">{{subtitle3}}</div>
                <div class="popup__subtitle">{{subtitle4}}</div>
                <div class="popup__subtitle">{{subtitle5}}</div>
                <button type="button" class="activate_btn">{{activateButton}}</button>
            </div>
        </div>

        <div class="overlay"></div>
        <div class="overlay__white"></div>
    </footer>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/magnific-popup.js/1.1.0/jquery.magnific-popup.min.js"></script>
    <script src="assets/js/app.js"></script>
</body>
</html>