<? if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();

if ($APPLICATION->GetCurPage(false) == SITE_DIR) $basIsMain = true;
else $basIsMain = false;

$bas_folder = explode('/', $APPLICATION->GetCurPage(false));

$strCanonical = (CMain::IsHTTPS() ? "https://" : "http://") . SITE_SERVER_NAME;

if ($_REQUEST['PAGEN_1']) {
    $basRequestUrl = explode('/', $_SERVER['REDIRECT_URL']);

    if ($basRequestUrl[3] === 'filter') $strCanonical .= '/' . $bas_folder[1] . '/' . $bas_folder[2] . '/';
    else $strCanonical .= $_SERVER['REDIRECT_URL'];
} elseif ($bas_folder[3] === 'filter') {
    $basRequestUrl = explode('/', $_SERVER['REDIRECT_URL']);

    if ($basRequestUrl[3] === 'filter') $strCanonical .= '/' . $bas_folder[1] . '/' . $bas_folder[2] . '/';
    else $strCanonical = false;
} else $strCanonical = false;

$assets = \Bitrix\Main\Page\Asset::getInstance(); ?>
    <!DOCTYPE html>
    <html lang="ru">
    <head>

        <meta charset="utf-8">
        <meta name="theme-color" content="#452f57">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

        <meta name="geo.region" content="RU"/>
        <meta name="geo.placename" content="Московский"/>
        <meta name="geo.position" content="55.634764;37.438938"/>
        <meta name="ICBM" content="55.634764, 37.438938"/>

        <meta name="google-site-verification" content="2ZM341lRC8ggil3C_hFFOq5yiI_AKLfJ_YhuRgoUxxE"/>
        <meta name="yandex-verification" content="0c2c8d68ccd0c891"/>

        <link type="image/png" href="/favicon.png" rel="icon">
        <link type="image/png" href="/favicon.png" rel="shortcut icon">

        <meta property="og:image" content="/local/templates/bas/img/logo.svg"/>


        <? if ($strCanonical): ?>

            <link rel="canonical" href="<?= $strCanonical ?>">

        <? endif ?>

        <title><? $APPLICATION->ShowTitle() ?></title>

        <?
        $assets->addJs("//code.jquery.com/jquery-3.4.1.min.js");
        $assets->addJs("//stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.bundle.min.js");

        $assets->addCss("//fonts.googleapis.com/css?family=Roboto:400,500,700,900&amp;subset=cyrillic");
        $assets->addCss("//fonts.googleapis.com/css?family=PT+Sans:400,700&amp;subset=cyrillic");
        $assets->addCss("//stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css");
        $assets->addCss("//use.fontawesome.com/releases/v5.6.3/css/all.css");

        $assets->addCss(SITE_TEMPLATE_PATH . "/owl.carousel/owl.carousel.css");
        $assets->addCss(SITE_TEMPLATE_PATH . "/formstyler/jquery.formstyler.css");
        $assets->addCss(SITE_TEMPLATE_PATH . "/fancybox/jquery.fancybox.css");

        $assets->addJs(SITE_TEMPLATE_PATH . "/fancybox/jquery.fancybox.min.js");
        $assets->addJs(SITE_TEMPLATE_PATH . "/formstyler/jquery.formstyler.js");
        $assets->addJs(SITE_TEMPLATE_PATH . "/owl.carousel/owl.carousel.js");
        $assets->addJs(SITE_TEMPLATE_PATH . "/js/jquery.maskedinput.js");
        $assets->addJs(SITE_TEMPLATE_PATH . "/js/jquery.form.js");
        $assets->addJs(SITE_TEMPLATE_PATH . "/js/script.js");
        ?>

        <?
        $APPLICATION->ShowMeta("robots", false, false);
        $APPLICATION->ShowMeta("description", false, false);
        $APPLICATION->ShowCSS(true, false);
        $APPLICATION->ShowHeadStrings();
        $APPLICATION->ShowHeadScripts();
        ?>

        <!-- Facebook Pixel Code -->
        <script>
            !function (f, b, e, v, n, t, s) {
                if (f.fbq) return;
                n = f.fbq = function () {
                    n.callMethod ?
                        n.callMethod.apply(n, arguments) : n.queue.push(arguments)
                };
                if (!f._fbq) f._fbq = n;
                n.push = n;
                n.loaded = !0;
                n.version = '2.0';
                n.queue = [];
                t = b.createElement(e);
                t.async = !0;
                t.src = v;
                s = b.getElementsByTagName(e)[0];
                s.parentNode.insertBefore(t, s)
            }(window, document, 'script',
                'https://connect.facebook.net/en_US/fbevents.js');
            fbq('init', '414019936069837');
            fbq('track', 'PageView');
        </script>
        <noscript><img height="1" width="1" style="display:none"
                       src="https://www.facebook.com/tr?id=414019936069837&ev=PageView&noscript=1"
            /></noscript>
        <!-- End Facebook Pixel Code -->

        <!-- Global site tag (gtag.js) - Google Analytics -->
        <script data-skip-moving=true async src="https://www.googletagmanager.com/gtag/js?id=UA-50306716-3"></script>
        <script data-skip-moving=true>
            window.dataLayer = window.dataLayer || [];

            function gtag() {
                dataLayer.push(arguments);
            }

            gtag('js', new Date());

            gtag('config', 'UA-50306716-3');
        </script>

    </head>
<body>
    <div id="panel"><? $APPLICATION->ShowPanel(); ?></div>
    <nav class="top">
        <div class="container">
            <div class="block d-flex align-items-center justify-content-between">
                <div class="d-lg-none">
                    <a href="/" class="logo">
                        <img src="<?= SITE_TEMPLATE_PATH ?>/img/logo.svg" alt="logo"
                             style="width: 113px; margin-top: 5px;">
                    </a>
                </div>
                <div class="d-none d-lg-block">
                    <? $APPLICATION->IncludeComponent(
                        "bitrix:menu",
                        "bas.top",
                        array(
                            "ALLOW_MULTI_SELECT" => "N",
                            "CHILD_MENU_TYPE" => "left",
                            "DELAY" => "N",
                            "MAX_LEVEL" => "2",
                            "MENU_CACHE_GET_VARS" => array(),
                            "MENU_CACHE_TIME" => "3600",
                            "MENU_CACHE_TYPE" => "N",
                            "MENU_CACHE_USE_GROUPS" => "N",
                            "ROOT_MENU_TYPE" => "top",
                            "USE_EXT" => "Y",
                            "COMPONENT_TEMPLATE" => "bas.top",
                            "COMPOSITE_FRAME_MODE" => "A",
                            "COMPOSITE_FRAME_TYPE" => "AUTO"
                        ),
                        false
                    ); ?>
                </div>
                <a href="javascript:;" style="margin: 0" class="phone d-xxs-none" data-html="true"
                   data-placement="bottom" data-toggle="popover"
                   data-content="<a href='tel:+74951182930'>МЦ Румянцево</a><br><a href='tel:+74951183777'>МЦ Империя</a><br><a href='tel:+74954143231'>МЦ Family Room</a>"></a>
                <div class="text-right">
                    <div class="xs_block d-lg-none">
                        <a href="javascript:;" class="btn btn-style1 btn-skew" data-toggle="modal"
                           data-target="#basSetZav"><span>Оставить заявку</span></a>
                    </div>
                    <div class="write_block d-none d-lg-block">
                        <a href="javascript:;" data-toggle="modal" data-target="#basDirModal"
                           class="d-none d-sm-inline-block d-md-none d-xl-inline-block btn-skew"><span>Написать директору</span></a>
                        <a href="javascript:;" data-toggle="modal" data-target="#basOrderDisModal"
                           class="btn-skew"><span>Заказать звонок</span></a>
                    </div>
                </div>
                <div class="header__favorites-block d-none d-md-flex text-right">
                    <a class="header__favorites-block__item mr-3 favorites-counter" href="/favorites/"
                       data-toggle="tooltip" title="Вам понравилось">0</a>
                    <a class="header__favorites-block__item seen-counter" href="/seen/" data-toggle="tooltip"
                       title="Вы смотрели">0</a>
                </div>
            </div>
        </div>
    </nav>
    <header class="main">
        <div class="container d-none d-lg-block">
            <div class="row no-gutters justify-content-between align-items-center">
                <div>
                    <div class="left">

                        <? if ($basIsMain): ?>

                            <span class="logo">
							<img src="<?= SITE_TEMPLATE_PATH ?>/img/logo.svg" alt="logo" style="width: 165px;">
						</span>

                        <? else: ?>

                            <a href="/" class="logo">
                                <img src="<?= SITE_TEMPLATE_PATH ?>/img/logo.svg" alt="logo" style="width: 165px;">
                            </a>

                        <? endif ?>

                    </div>
                </div>
                <div>
                    <div class="center icon_sprite_one">
                        <a href="/calculate/" class="link_num1 btn-skew">
                            <span>
                                Заказать<br>
                                дизайн и расчет <br>
                                <i>Бесплатно</i>
                            </span>
                        </a>
                        <a href="/designer/" class="link_num2 d-none d-lg-inline-block btn-skew">
                            <span>
                                Выезд <br>
                                дизайнера на <br>
                                дом <i>Бесплатно</i>
                            </span>
                        </a>
                        <a href="/contacts/" class="link_contacts d-none d-lg-inline-block d-xl-none btn-skew">
                            <span>Адреса салонов</span>
                        </a>
                    </div>
                </div>
                <div class="d-none d-xl-block"
                     style="flex-basis: 450px; flex-shrink: 1; margin-left: 5px; margin-right: -15px; margin-bottom: -6px">
                    <div class="right">
                        <? $APPLICATION->IncludeComponent(
                            "bitrix:news.list",
                            "bas.our.office.header",
                            array(
                                "ACTIVE_DATE_FORMAT" => "d.m.Y",
                                "ADD_SECTIONS_CHAIN" => "N",
                                "AJAX_MODE" => "N",
                                "AJAX_OPTION_ADDITIONAL" => "",
                                "AJAX_OPTION_HISTORY" => "N",
                                "AJAX_OPTION_JUMP" => "N",
                                "AJAX_OPTION_STYLE" => "N",
                                "CACHE_FILTER" => "N",
                                "CACHE_GROUPS" => "N",
                                "CACHE_TIME" => "36000000",
                                "CACHE_TYPE" => "A",
                                "CHECK_DATES" => "N",
                                "COMPOSITE_FRAME_MODE" => "A",
                                "COMPOSITE_FRAME_TYPE" => "AUTO",
                                "DETAIL_URL" => "",
                                "DISPLAY_BOTTOM_PAGER" => "N",
                                "DISPLAY_DATE" => "Y",
                                "DISPLAY_NAME" => "Y",
                                "DISPLAY_PICTURE" => "Y",
                                "DISPLAY_PREVIEW_TEXT" => "Y",
                                "DISPLAY_TOP_PAGER" => "N",
                                "FIELD_CODE" => array(
                                    0 => "",
                                    1 => "",
                                ),
                                "FILTER_NAME" => "",
                                "HIDE_LINK_WHEN_NO_DETAIL" => "N",
                                "IBLOCK_ID" => "7",
                                "IBLOCK_TYPE" => "info",
                                "INCLUDE_IBLOCK_INTO_CHAIN" => "N",
                                "INCLUDE_SUBSECTIONS" => "N",
                                "MESSAGE_404" => "",
                                "NEWS_COUNT" => "5",
                                "PAGER_BASE_LINK_ENABLE" => "N",
                                "PAGER_DESC_NUMBERING" => "N",
                                "PAGER_DESC_NUMBERING_CACHE_TIME" => "36000",
                                "PAGER_SHOW_ALL" => "N",
                                "PAGER_SHOW_ALWAYS" => "N",
                                "PAGER_TEMPLATE" => ".default",
                                "PAGER_TITLE" => "Новости",
                                "PARENT_SECTION" => "",
                                "PARENT_SECTION_CODE" => "",
                                "PREVIEW_TRUNCATE_LEN" => "",
                                "PROPERTY_CODE" => array(
                                    0 => "EMAIL",
                                    1 => "TIME",
                                    2 => "PHONE",
                                    3 => "EL_ABOUT",
                                    4 => "",
                                ),
                                "SET_BROWSER_TITLE" => "N",
                                "SET_LAST_MODIFIED" => "N",
                                "SET_META_DESCRIPTION" => "N",
                                "SET_META_KEYWORDS" => "N",
                                "SET_STATUS_404" => "N",
                                "SET_TITLE" => "N",
                                "SHOW_404" => "N",
                                "SORT_BY1" => "SORT",
                                "SORT_BY2" => "ID",
                                "SORT_ORDER1" => "ASC",
                                "SORT_ORDER2" => "ASC",
                                "STRICT_SECTION_CHECK" => "N",
                                "COMPONENT_TEMPLATE" => "bas.our.office.header"
                            ),
                            false
                        ); ?>
                    </div>
                </div>
                <div class="center icon_sprite_one d-none d-xl-block">
                    <a href="/contacts/#y-map" class="link_contacts btn-skew" style="width: 118px">
                        <span>
                            Салоны <br>
                            на карте
                        </span>
                    </a>
                </div>
            </div>
        </div>
        <div class="container d-lg-none">
            <div class="tab row no-gutters justify-content-between align-items-center">
                <div class="right text-right">
                    <button class="navbar-toggle" type="button" data-toggle="collapse"
                            data-target=".bs-navbar-collapse">
						<span class="icon">
							<span></span>
							<span></span>
							<span></span>
						</span>
                        <span class="name">Каталог</span>
                    </button>
                </div>
                <div class="d-lg-none">
                    <div class="xs-menu-separator">&nbsp;</div>
                </div>
                <div class="center text-center d-none d-lg-block">
                    <a class="phone" href="javascript:;" data-toggle="modal" data-target="#basOrderDisModal">Заказать
                        звонок</a>
                </div>
                <div class="left">
                    <? $APPLICATION->IncludeComponent(
                        "bitrix:menu",
                        "bas.top",
                        array(
                            "ALLOW_MULTI_SELECT" => "N",
                            "CHILD_MENU_TYPE" => "left",
                            "DELAY" => "N",
                            "MAX_LEVEL" => "2",
                            "MENU_CACHE_GET_VARS" => array(),
                            "MENU_CACHE_TIME" => "3600",
                            "MENU_CACHE_TYPE" => "N",
                            "MENU_CACHE_USE_GROUPS" => "N",
                            "ROOT_MENU_TYPE" => "top",
                            "USE_EXT" => "Y",
                            "COMPONENT_TEMPLATE" => "bas.top",
                            "COMPOSITE_FRAME_MODE" => "A",
                            "COMPOSITE_FRAME_TYPE" => "AUTO"
                        ),
                        false
                    ); ?>
                </div>
            </div>
        </div>
    </header>
    <nav class="main">
        <div class="abs_block">
            <div class="container">
                <div class="block row no-gutters justify-content-between align-items-center">
                    <div>
                        <? $APPLICATION->IncludeComponent(
                            "bitrix:menu",
                            "bas.main",
                            array(
                                "ALLOW_MULTI_SELECT" => "N",
                                "CHILD_MENU_TYPE" => "left",
                                "DELAY" => "N",
                                "MAX_LEVEL" => "2",
                                "MENU_CACHE_GET_VARS" => array(),
                                "MENU_CACHE_TIME" => "3600",
                                "MENU_CACHE_TYPE" => "N",
                                "MENU_CACHE_USE_GROUPS" => "N",
                                "ROOT_MENU_TYPE" => "main",
                                "USE_EXT" => "Y",
                                "COMPONENT_TEMPLATE" => "bas.main",
                                "COMPOSITE_FRAME_MODE" => "A",
                                "COMPOSITE_FRAME_TYPE" => "AUTO"
                            ),
                            false
                        ); ?>
                    </div>
                    <div class="d-none d-xl-block">
                        <? $APPLICATION->IncludeComponent(
                            "bas:bas.search.title",
                            "bas",
                            array(
                                "CATEGORY_0" => array(
                                    0 => "iblock_catalog",
                                ),
                                "CATEGORY_0_TITLE" => "",
                                "CHECK_DATES" => "N",
                                "CONTAINER_ID" => "title-search",
                                "INPUT_ID" => "title-search-input",
                                "NUM_CATEGORIES" => "1",
                                "ORDER" => "date",
                                "PAGE" => "/search/",
                                "SHOW_INPUT" => "Y",
                                "SHOW_OTHERS" => "N",
                                "TOP_COUNT" => "5",
                                "USE_LANGUAGE_GUESS" => "Y",
                                "COMPONENT_TEMPLATE" => "bas",
                                "COMPOSITE_FRAME_MODE" => "A",
                                "COMPOSITE_FRAME_TYPE" => "AUTO",
                                "CATEGORY_0_iblock_catalog" => array(
                                    0 => "4",
                                ),
                                "PRICE_CODE" => "",
                                "PRICE_VAT_INCLUDE" => "Y",
                                "PREVIEW_TRUNCATE_LEN" => "",
                                "SHOW_PREVIEW" => "Y",
                                "PREVIEW_WIDTH" => "75",
                                "PREVIEW_HEIGHT" => "75"
                            ),
                            false
                        ); ?>
                    </div>
                </div>
            </div>
        </div>
    </nav>
<? $APPLICATION->IncludeComponent(
    "bitrix:menu",
    "bas.hidden",
    array(
        "ALLOW_MULTI_SELECT" => "N",
        "CHILD_MENU_TYPE" => "left",
        "DELAY" => "N",
        "MAX_LEVEL" => "1",
        "MENU_CACHE_GET_VARS" => array(),
        "MENU_CACHE_TIME" => "3600",
        "MENU_CACHE_TYPE" => "N",
        "MENU_CACHE_USE_GROUPS" => "N",
        "ROOT_MENU_TYPE" => "left",
        "USE_EXT" => "N",
        "COMPONENT_TEMPLATE" => "bas.hidden"
    ),
    false
); ?>
<main class="main <?= ($APPLICATION->GetDirProperty('padding_bottom') === 'Y') ? 'no_padding_bottom' : '' ?> <?= ($APPLICATION->GetDirProperty('padding_top') === 'Y') ? 'no_padding_top' : '' ?> <?= $basIsMain ? 'main_page' : 'inner_page' ?>">

<? if ($basIsMain): ?>

    <? $APPLICATION->IncludeComponent(
        "bitrix:news.list",
        "bas.main.slider",
        array(
            "ACTIVE_DATE_FORMAT" => "d.m.Y",
            "ADD_SECTIONS_CHAIN" => "N",
            "AJAX_MODE" => "N",
            "AJAX_OPTION_ADDITIONAL" => "",
            "AJAX_OPTION_HISTORY" => "N",
            "AJAX_OPTION_JUMP" => "N",
            "AJAX_OPTION_STYLE" => "Y",
            "CACHE_FILTER" => "N",
            "CACHE_GROUPS" => "N",
            "CACHE_TIME" => "36000",
            "CACHE_TYPE" => "A",
            "CHECK_DATES" => "Y",
            "DETAIL_URL" => "",
            "DISPLAY_BOTTOM_PAGER" => "N",
            "DISPLAY_DATE" => "Y",
            "DISPLAY_NAME" => "Y",
            "DISPLAY_PICTURE" => "Y",
            "DISPLAY_PREVIEW_TEXT" => "Y",
            "DISPLAY_TOP_PAGER" => "N",
            "FIELD_CODE" => array(
                0 => "",
                1 => "",
            ),
            "FILTER_NAME" => "",
            "HIDE_LINK_WHEN_NO_DETAIL" => "N",
            "IBLOCK_ID" => "1",
            "IBLOCK_TYPE" => "info",
            "INCLUDE_IBLOCK_INTO_CHAIN" => "N",
            "INCLUDE_SUBSECTIONS" => "N",
            "MESSAGE_404" => "",
            "NEWS_COUNT" => "10",
            "PAGER_BASE_LINK_ENABLE" => "N",
            "PAGER_DESC_NUMBERING" => "N",
            "PAGER_DESC_NUMBERING_CACHE_TIME" => "36000",
            "PAGER_SHOW_ALL" => "N",
            "PAGER_SHOW_ALWAYS" => "N",
            "PAGER_TEMPLATE" => ".default",
            "PAGER_TITLE" => "Новости",
            "PARENT_SECTION" => "",
            "PARENT_SECTION_CODE" => "",
            "PREVIEW_TRUNCATE_LEN" => "",
            "PROPERTY_CODE" => array(
                0 => "HAS_TEXT",
                1 => "LINK",
                2 => "IMG_MOBILE",
            ),
            "SET_BROWSER_TITLE" => "N",
            "SET_LAST_MODIFIED" => "N",
            "SET_META_DESCRIPTION" => "N",
            "SET_META_KEYWORDS" => "N",
            "SET_STATUS_404" => "N",
            "SET_TITLE" => "N",
            "SHOW_404" => "N",
            "SORT_BY1" => "ACTIVE_FROM",
            "SORT_BY2" => "SORT",
            "SORT_ORDER1" => "DESC",
            "SORT_ORDER2" => "ASC",
            "COMPONENT_TEMPLATE" => "bas.main.slider",
            "STRICT_SECTION_CHECK" => "N",
            "COMPOSITE_FRAME_MODE" => "Y",
            "COMPOSITE_FRAME_TYPE" => "STATIC"
        ),
        false
    ); ?>
    <? $APPLICATION->IncludeComponent(
        "bitrix:news.list",
        "bas.prime.all.page",
        array(
            "ACTIVE_DATE_FORMAT" => "d.m.Y",
            "ADD_SECTIONS_CHAIN" => "N",
            "AJAX_MODE" => "N",
            "AJAX_OPTION_ADDITIONAL" => "",
            "AJAX_OPTION_HISTORY" => "N",
            "AJAX_OPTION_JUMP" => "N",
            "AJAX_OPTION_STYLE" => "Y",
            "CACHE_FILTER" => "N",
            "CACHE_GROUPS" => "N",
            "CACHE_TIME" => "36000000",
            "CACHE_TYPE" => "A",
            "CHECK_DATES" => "Y",
            "DETAIL_URL" => "",
            "DISPLAY_BOTTOM_PAGER" => "N",
            "DISPLAY_DATE" => "Y",
            "DISPLAY_NAME" => "Y",
            "DISPLAY_PICTURE" => "Y",
            "DISPLAY_PREVIEW_TEXT" => "Y",
            "DISPLAY_TOP_PAGER" => "N",
            "FIELD_CODE" => array(
                0 => "",
                1 => "",
            ),
            "FILTER_NAME" => "",
            "HIDE_LINK_WHEN_NO_DETAIL" => "N",
            "IBLOCK_ID" => "2",
            "IBLOCK_TYPE" => "info",
            "INCLUDE_IBLOCK_INTO_CHAIN" => "N",
            "INCLUDE_SUBSECTIONS" => "N",
            "MESSAGE_404" => "",
            "NEWS_COUNT" => "6",
            "PAGER_BASE_LINK_ENABLE" => "N",
            "PAGER_DESC_NUMBERING" => "N",
            "PAGER_DESC_NUMBERING_CACHE_TIME" => "36000",
            "PAGER_SHOW_ALL" => "N",
            "PAGER_SHOW_ALWAYS" => "N",
            "PAGER_TEMPLATE" => ".default",
            "PAGER_TITLE" => "Новости",
            "PARENT_SECTION" => "",
            "PARENT_SECTION_CODE" => "",
            "PREVIEW_TRUNCATE_LEN" => "",
            "PROPERTY_CODE" => array(
                0 => "",
                1 => "",
            ),
            "SET_BROWSER_TITLE" => "N",
            "SET_LAST_MODIFIED" => "N",
            "SET_META_DESCRIPTION" => "N",
            "SET_META_KEYWORDS" => "N",
            "SET_STATUS_404" => "N",
            "SET_TITLE" => "N",
            "SHOW_404" => "N",
            "SORT_BY1" => "SORT",
            "SORT_BY2" => "ID",
            "SORT_ORDER1" => "ASC",
            "SORT_ORDER2" => "ASC",
            "COMPONENT_TEMPLATE" => "bas.prime.all.page",
            "STRICT_SECTION_CHECK" => "N"
        ),
        false
    ); ?>

<? else: ?>

    <? global $arrFilter;

    $arrFilter = array('CODE' => $bas_folder[1]); ?>

    <? $APPLICATION->IncludeComponent(
        "bitrix:news.list",
        "bas.page.background",
        array(
            "COMPONENT_TEMPLATE" => "bas.page.background",
            "IBLOCK_TYPE" => "help",
            "IBLOCK_ID" => "9",
            "NEWS_COUNT" => "1",
            "SORT_BY1" => "ACTIVE_FROM",
            "SORT_ORDER1" => "DESC",
            "SORT_BY2" => "SORT",
            "SORT_ORDER2" => "ASC",
            "FILTER_NAME" => "arrFilter",
            "FIELD_CODE" => array(
                0 => "",
                1 => "",
            ),
            "PROPERTY_CODE" => array(
                0 => "POLOG",
                1 => "",
                2 => "",
            ),
            "CHECK_DATES" => "N",
            "DETAIL_URL" => "",
            "AJAX_MODE" => "N",
            "AJAX_OPTION_JUMP" => "N",
            "AJAX_OPTION_STYLE" => "Y",
            "AJAX_OPTION_HISTORY" => "N",
            "AJAX_OPTION_ADDITIONAL" => "",
            "CACHE_TYPE" => "A",
            "CACHE_TIME" => "36000000",
            "CACHE_FILTER" => "N",
            "CACHE_GROUPS" => "N",
            "PREVIEW_TRUNCATE_LEN" => "",
            "ACTIVE_DATE_FORMAT" => "d.m.Y",
            "SET_TITLE" => "N",
            "SET_BROWSER_TITLE" => "N",
            "SET_META_KEYWORDS" => "N",
            "SET_META_DESCRIPTION" => "N",
            "SET_STATUS_404" => "N",
            "INCLUDE_IBLOCK_INTO_CHAIN" => "N",
            "ADD_SECTIONS_CHAIN" => "N",
            "HIDE_LINK_WHEN_NO_DETAIL" => "N",
            "PARENT_SECTION" => "",
            "PARENT_SECTION_CODE" => "",
            "INCLUDE_SUBSECTIONS" => "N",
            "DISPLAY_DATE" => "Y",
            "DISPLAY_NAME" => "Y",
            "DISPLAY_PICTURE" => "Y",
            "DISPLAY_PREVIEW_TEXT" => "Y",
            "PAGER_TEMPLATE" => ".default",
            "DISPLAY_TOP_PAGER" => "N",
            "DISPLAY_BOTTOM_PAGER" => "N",
            "PAGER_TITLE" => "Новости",
            "PAGER_SHOW_ALWAYS" => "N",
            "PAGER_DESC_NUMBERING" => "N",
            "PAGER_DESC_NUMBERING_CACHE_TIME" => "36000",
            "PAGER_SHOW_ALL" => "N",
            "SET_LAST_MODIFIED" => "N",
            "PAGER_BASE_LINK_ENABLE" => "N",
            "SHOW_404" => "N",
            "MESSAGE_404" => ""
        ),
        false, array('HIDE_ICONS' => 'Y')
    ); ?>

<? endif ?>

    <div class="container">

<? if (!$basIsMain && ($APPLICATION->GetDirProperty('hide_banner') !== 'Y')): ?>

    <? $APPLICATION->IncludeComponent(
        "bitrix:news.list",
        "bas.banner",
        array(
            "ACTIVE_DATE_FORMAT" => "d.m.Y",
            "ADD_SECTIONS_CHAIN" => "N",
            "AJAX_MODE" => "N",
            "AJAX_OPTION_ADDITIONAL" => "",
            "AJAX_OPTION_HISTORY" => "N",
            "AJAX_OPTION_JUMP" => "N",
            "AJAX_OPTION_STYLE" => "N",
            "CACHE_FILTER" => "N",
            "CACHE_GROUPS" => "N",
            "CACHE_TIME" => "2",
            "CACHE_TYPE" => "A",
            "CHECK_DATES" => "Y",
            "COMPOSITE_FRAME_MODE" => "A",
            "COMPOSITE_FRAME_TYPE" => "DYNAMIC_WITHOUT_STUB",
            "DETAIL_URL" => "",
            "DISPLAY_BOTTOM_PAGER" => "N",
            "DISPLAY_DATE" => "Y",
            "DISPLAY_NAME" => "Y",
            "DISPLAY_PICTURE" => "Y",
            "DISPLAY_PREVIEW_TEXT" => "Y",
            "DISPLAY_TOP_PAGER" => "N",
            "FIELD_CODE" => array(
                0 => "",
                1 => "",
            ),
            "FILTER_NAME" => "",
            "HIDE_LINK_WHEN_NO_DETAIL" => "N",
            "IBLOCK_ID" => "19",
            "IBLOCK_TYPE" => "info",
            "INCLUDE_IBLOCK_INTO_CHAIN" => "N",
            "INCLUDE_SUBSECTIONS" => "N",
            "MESSAGE_404" => "",
            "NEWS_COUNT" => "1",
            "PAGER_BASE_LINK_ENABLE" => "N",
            "PAGER_DESC_NUMBERING" => "N",
            "PAGER_DESC_NUMBERING_CACHE_TIME" => "36000",
            "PAGER_SHOW_ALL" => "N",
            "PAGER_SHOW_ALWAYS" => "N",
            "PAGER_TEMPLATE" => ".default",
            "PAGER_TITLE" => "Новости",
            "PARENT_SECTION" => "",
            "PARENT_SECTION_CODE" => "",
            "PREVIEW_TRUNCATE_LEN" => "",
            "PROPERTY_CODE" => array(
                0 => "LINK",
                1 => "IMG_MOBILE",
            ),
            "SET_BROWSER_TITLE" => "N",
            "SET_LAST_MODIFIED" => "N",
            "SET_META_DESCRIPTION" => "N",
            "SET_META_KEYWORDS" => "N",
            "SET_STATUS_404" => "N",
            "SET_TITLE" => "N",
            "SHOW_404" => "N",
            "SORT_BY1" => "RAND",
            "SORT_BY2" => "",
            "SORT_ORDER1" => "",
            "SORT_ORDER2" => "",
            "STRICT_SECTION_CHECK" => "N",
            "COMPONENT_TEMPLATE" => "bas.banner"
        ),
        false
    ); ?>

<? endif ?>

<? if (!$basIsMain && ($APPLICATION->GetDirProperty('hide_breadcrumb') !== 'Y')): ?>
    <div id="header-breadcrumb">
        <? $APPLICATION->IncludeComponent(
            "bitrix:breadcrumb",
            "bas",
            array(
                "PATH" => "",
                "SITE_ID" => "s1",
                "START_FROM" => "0",
                "COMPONENT_TEMPLATE" => "bas",
                "COMPOSITE_FRAME_MODE" => "A",
                "COMPOSITE_FRAME_TYPE" => "AUTO"
            ),
            false
        ); ?>
    </div>

<? endif; ?>

<? if (!$basIsMain && ($APPLICATION->GetDirProperty('hide_h1') !== 'Y')): ?>

    <div class="bas_our_margin">
        <h1 <?= ($APPLICATION->GetDirProperty('small_h1') === 'Y') ? 'class="bas_small"' : '' ?>><? $APPLICATION->ShowTitle(false) ?></h1>
    </div>

<? endif ?>

<? if($APPLICATION->GetDirProperty('center_off') === 'Y' || $basIsMain):?>

		</div>

	<?endif ?>