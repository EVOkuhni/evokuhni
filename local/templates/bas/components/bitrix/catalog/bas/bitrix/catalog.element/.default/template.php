<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();

$this->setFrameMode(true);
?>

<div class="d-none seen-trigger" data-id="<?= $arResult['ID'] ?>"></div>

<div class="bas_catalog_element" itemscope itemtype="http://schema.org/Product">
	<div itemprop="aggregateRating" itemscope itemtype="http://schema.org/AggregateRating">
		<span itemprop="ratingValue" content="5"></span>
		<span itemprop="reviewCount" content="1"></span>
	</div>
    <span itemprop="brand" content="<?= explode(' ',$arResult['NAME'])[0] ?>"></span>
	<div class="container">
		<div class="row">
			<div class="col-xl-9 col-lg-8">
				<div class="big_img">

				<?if($arResult['SECTION']['UF_SHOW_ICON']):?>

					<div class="bas_catalog_icon">
						<img src="<?=$templateFolder?>/img/icon1.png" alt="" itemprop="image">
						<img src="<?=$templateFolder?>/img/icon2.png" alt="" itemprop="image">
						<img src="<?=$templateFolder?>/img/icon3.png" alt="" itemprop="image">
						<img src="<?=$templateFolder?>/img/icon4.png" alt="" itemprop="image">
					</div>

				<?endif?>

				<?if($arResult['PROPERTIES']['STAT']['VALUE_XML_ID'] === 'N'):?>

					<div class="catalog-label catalog-label_detail" <?= $arResult['PROPERTIES']['PRO_PHOTO']['VALUE']? 'style="right: 145px"' : '' ?>>
						<span class="catalog-label__inner">Новинка</span>
					</div>

				<?elseif($arResult['PROPERTIES']['STAT']['VALUE_XML_ID'] === 'H'):?>

					<div class="catalog-label catalog-label_detail catalog-label_red" <?= $arResult['PROPERTIES']['PRO_PHOTO']['VALUE']? 'style="right: 145px"' : '' ?>>
						<span class="catalog-label__inner">ХИТ</span>
					</div>

				<?endif?>

                <?php if ($arResult['PROPERTIES']['PRO_PHOTO']['VALUE']): ?>
                    <div class="catalog-label catalog-label_detail catalog-label_blue">
                        <span class="catalog-label__inner">
                            <span class="photo-icon"></span>
                            PRO
                        </span>
                    </div>
                <?php endif; ?>

                    <div class="bas_catalog_favorites_label" data-toggle="tooltip" title="Вам понравилось"><a class="favorite-btn" href="#" data-id="<?= $arResult['ID'] ?>"><i class="favorite-icon big"></i></a></div>

                    <?php $arItemsBig = CFile::ResizeImageGet($arResult['PROPERTIES']['MORE_PICT']['VALUE'][0], array('width' => 1694, 'height' => 1000), BX_RESIZE_IMAGE_PROPORTIONAL, false, false, false, 85); ?>
                    <span itemprop="image" content="https://<?= $_SERVER['SERVER_NAME'].$arItemsBig['src'] ?>"></span>
                    <span itemprop="sku" content="<?= $arResult['ID'] ?>"></span>

					<div id="fotorama" data-click="false" data-keyboard="true" data-allowfullscreen="true" data-thumbwidth="195" data-thumbheight="110" data-nav="thumbs" data-loop="true">

					<?foreach($arResult['PROPERTIES']['MORE_PICT']['VALUE'] as $intKey => $arItem):?>

						<?
						$arItemsSmall = CFile::ResizeImageGet($arItem, array('width' => 195, 'height' => 110), BX_RESIZE_IMAGE_EXACT, true, false, false, 85);
						$arItemsBig = CFile::ResizeImageGet($arItem, array('width' => 1694, 'height' => 1000), BX_RESIZE_IMAGE_PROPORTIONAL, false, false, false, 85);
						?>

						<a href="<?=$arItemsBig['src']?>">
							<img src="<?=$arItemsSmall['src']?>" alt="<?$APPLICATION->ShowTitle(false)?> (фото <?=($intKey + 1)?>)">
						</a>

					<?endforeach;?>

					</div>
				</div>

			<?if(!$arResult['SECTION']['UF_HIDE_BAN'] && $arResult['SECTION']['UF_BANNER_CART']):?>
            <? /*
				<div class="info_block text-center bas_our_margin">
					<div>
						<span><?=$arResult['SECTION']['UF_BANNER_CART']?></span>
					</div>
				</div>
            */?>
			<?endif?>

			</div>

			<div class="col-xl-3 col-lg-4 basTovarBlock">
                <div itemprop="review" itemscope itemtype="http://schema.org/Review" class="element-stars-block">
                    <span itemprop="author" class="d-none">Lucas</span>
                    <span itemprop="description" class="d-none"><?= $arResult['NAME'] ?> отлично</span>
                    <div style="color: orange" class="text-right mb-1 mr-1 mt-md-2 mt-lg-0" itemprop="reviewRating" itemscope itemtype="http://schema.org/Rating">
                        <meta itemprop="worstRating" content="1"/>
                        <meta itemprop="bestRating" content="5"/>
                        <meta itemprop="ratingValue" content="5"/>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                    </div>
                </div>
				<h1 class="text-left-sm text-center-xs basTovarName" itemprop="name"><?$APPLICATION->ShowTitle(false)?></h1>
				<div class="block text-left-sm text-center-xs">
					<div class="left" itemprop="offers" itemscope itemtype="https://schema.org/Offer">
                        <link itemprop="availability" href="http://schema.org/InStock" />
                        <span itemprop="priceValidUntil" content="<?= date('Y-m-d', time() + 3600*24*365) ?>"></span>
                        <span itemprop="url" content="https://<?= $_SERVER['SERVER_NAME'].$arResult['DETAIL_PAGE_URL'] ?>"></span>

                    <?if ($arParams["HIDE_PRICE"] !== 'Y' && !$arResult['SECTION']['UF_HIDE_PRICE']):?>

						<span class="price">
                            <?if($arResult['SECTION']['UF_SHOW_FROM']):?> от <?endif ?>
                            <span itemprop="price" content="<?= $arResult['PROPERTIES']['PRICE']['VALUE'] ?>"><?=number_format($arResult['PROPERTIES']['PRICE']['VALUE'], 0, '', ' ')?></span>
                            <span itemprop="priceCurrency" content="RUB">руб.</span>
                            <?if($arResult['SECTION']['UF_DESC_PRICE']!=""):?>
                                <span class="red_star">*</span>
                            <?endif?>
						</span>   
						<span class="ed"><?=$arResult['SECTION']['UF_ZA']?></span>
						<meta itemprop="priceCurrency" content="RUB" />

                    <?endif?>

					</div>
                    <?php /*
					<div class="right">
						<a href="javascript:;" class="btn btn-default bold basOrderMake">ЗАКАЗАТЬ</a>
					</div>*/ ?>
				</div>
				<div class="text-left-sm text-center-xs">
					<a href="/credit/" class="info">Информация о рассрочке</a>
				</div>

				<div class="link text-center row icon_sprite_one" style="margin-top: 40px;margin-bottom: 65px;">

                    <div class="col-lg-12 col-md-4">

                        <a href="javascript:;" class="link_num1 special-btn basOrderMake" form-name="Заказать дизайн">
                            <span> Заказать дизайн<br> и расчет <i>Бесплатно</i> </span>
                        </a>
                    </div>

                    <div class="col-lg-12 col-md-4">
                        <a href="javascript:;" class="link_num_studio special-btn basOrderMake" form-name="Записаться в студию">
                            <span> Записаться в студию </span>
                        </a>
                    </div>

                    <div class="col-lg-12 col-md-4">
                        <a href="#basOrderDisModal" class="link_num_order_call special-btn" data-toggle="modal">
                            <span> Заказать звонок </span>
                        </a>
                    </div>

				<?/*if($arResult['SECTION']['UF_SHOW_BTN_NUM1']):?>

					<div class="col-lg-12 col-md-4">

						<a href="javascript:;" class="link_num1 special-btn basOrderMake" form-name="Заказать дизайн">
                            <span> Заказать дизайн<br> и расчет <i>Бесплатно</i> </span>
						</a>
					</div>

				<?endif*/?>
				<?/*if($arResult['SECTION']['UF_SHOW_BTN_NUM2']):?>

					<div class="col-lg-12 col-md-4">
						<a href="javascript:;" class="link_num2 basOrderMake" form-name="Выезд дизайнера">
							Выезд дизайнера<br> 
							на дом <i>Бесплатно</i>
						</a>
					</div>

				<?endif*/?>
				<?/*if($arResult['SECTION']['UF_SHOW_BTN_NUM3']):?>

					<div class="col-lg-12 col-md-4">
					 
						<a href="javascript:;" class="link_num3 basOrderMake" form-name="Заказать расчет">
							Заказать расчет <br> стоимости
						</a>
					</div>

				<?endif*/?>

				<?/*if($arResult['SECTION']['UF_SHOW_BTN_ONE']):?>

					<div class="col-lg-12 col-md-4">
						<a href="javascript:;" class="link_num3 basOrderMake" form-name="Уточнить цену и узнать скидку">
							Уточнить цену и<br>
							получить скидку
						</a>
					</div>

				<?endif*/?>

				<?if($arResult['SECTION']['UF_DESC_PRICE']!=""):?>

					<div class="col-lg-12 col-md-4">
						<div class="tovcom">
							<span class="red_star">*</span> <?=$arResult['SECTION']['UF_DESC_PRICE']?>
						</div>
					</div>

				<?endif?>

				<?if($arResult['SECTION']['UF_TOV_COM']!=""):?>

					<div class="col-lg-12 col-md-4">
						<div class="tovcom">
							<span class="red_star">*</span> <?=$arResult['SECTION']['UF_TOV_COM']?>
						</div>
					</div>

				<?endif?>

				</div>
                <div style="padding: 10px 0 20px" class="share-block">
                    Поделиться:
                    <script src="//yastatic.net/es5-shims/0.0.2/es5-shims.min.js"></script>
                    <script src="//yastatic.net/share2/share.js"></script>
                    <div class="ya-share2" data-services="vkontakte,facebook,odnoklassniki,twitter,viber,whatsapp,skype,telegram"></div>
                </div>
			</div>
		</div>

	<?/* if($arResult['COLOR_VALUE']): */?>

		<div class="text_line">
			<div class="row" style="align-items: flex-start;">

                <div class="<?=($arResult['COLOR_VALUE'] ? 'col-lg-6 col-md-7 order-1 order-md-1' : 'col-12')?> d-block d-md-none">
                    <?php require( __DIR__ .'/_product_params.php')?>
                </div>

				<div class="<?=($arResult['COLOR_VALUE'] ? 'col-lg-6 col-md-7 order-3 order-md-1' : 'col-12')?>">

                    <div class="d-none d-md-block">
                        <?php require( __DIR__ .'/_product_params.php')?>
                    </div>

				<?if($arResult['DETAIL_TEXT']):?>

					<div class="title">Описание</div>
					<div class="text bas_our_margin" itemprop="description" >
						<?=$arResult['DETAIL_TEXT']?>
					</div>

				<?endif?>

				</div>

			<?if($arResult['COLOR_VALUE']):?>

				<div class="col-lg-6 col-md-5 order-2 order-md-2 product-colors-block">

                    <ul class="nav nav-tabs" id="myTab" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link active" id="colors-tab" data-toggle="tab" href="#colors-panel" role="tab"
                               aria-controls="colors-tab" aria-selected="true">
                                <div class="nav-text">Цвета</div>
                            </a>
                        </li>
                        <?php/*
                        <li class="nav-item">
                            <a class="nav-link" id="views-tab" data-toggle="tab" href="#views-panel" role="tab"
                               aria-controls="views" aria-selected="false"><div class="nav-text">Виды</div></a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="elements-tab" data-toggle="tab" href="#elements-panel" role="tab"
                               aria-controls="elements" aria-selected="false"><div class="nav-text">Элементы</div>
                            </a>
                        </li>*/?>
                    </ul>
                    <div class="tab-content">
                        <div class="tab-pane card fade show active" id="colors-panel" role="tabpanel" aria-labelledby="colors-tab">
                            <div class="card-body">
                                <?foreach($arResult['COLORS'] as $intKey => $coloredData):?>

                                    <div class="title">
                                        <?=$coloredData['TITLE'] ? $coloredData['TITLE'] : "Доступные цвета";?>
                                        <div class="btn_elem">
                                            <a href="javascript:;" class="btn btn-success btn-md d-none d-xl-inline-block btn-skew btn-style2"><span>Посмотреть все</span></a>
                                        </div>
                                    </div>
                                    <div class="color">
                                        <div class="slider">

                                            <?foreach($coloredData['VALUES'] as $idValue => $colorFile):?>

                                                <div class="item">
                                                    <a href="<?=$colorFile['FILE']?>" data-thumb="<?=$colorFile['FILE_TUMB']?>" class="fancybox_color" data-fancybox="bas_color<?=$intKey?>" data-caption="<?=$colorFile['NAME']?>">
                                                        <i>
                                                            <img src="<?=$colorFile['FILE_SMALL']?>" alt="<?=$colorFile['NAME']?>">
                                                        </i>
                                                        <span><?=$colorFile['NAME']?></span>
                                                    </a>
                                                </div>

                                            <?endforeach?>

                                        </div>
                                    </div>

                                    <?php if($intKey != count($arResult['COLORS']) - 1): ?>
                                    <hr>
                                    <?php endif; ?>

                                <?endforeach?>
                            </div>
                        </div>
                        <div class="tab-pane card fade" id="views-panel" role="tabpanel" aria-labelledby="views-tab">...</div>
                        <div class="tab-pane card fade" id="elements-panel" role="tabpanel" aria-labelledby="elements-tab">...</div>
                    </div>

				</div>

			<?endif?>

			</div>
		</div>

	<?/* endif */?>

	</div>
</div>
<?php
$cnt_komplekt_1 = CIBlockElement::GetList(array(),array('IBLOCK_ID' => '4', 'SECTION_ID' => '6', 'INCLUDE_SUBSECTIONS' => 'Y', 'ACTIVE' => 'Y'), true);
$split_cnt_komplekt_1 = str_split($cnt_komplekt_1);
$cnt_komplekt_2 = CIBlockElement::GetList(array(),array('IBLOCK_ID' => '4', 'SECTION_ID' => '5', 'INCLUDE_SUBSECTIONS' => 'Y', 'ACTIVE' => 'Y'), true);
$split_cnt_komplekt_2 = str_split($cnt_komplekt_2);
$cnt_komplekt_3 = CIBlockElement::GetList(array(),array('IBLOCK_ID' => '4', 'SECTION_ID' => '8', 'INCLUDE_SUBSECTIONS' => 'Y', 'ACTIVE' => 'Y'), true);
$split_cnt_komplekt_3 = str_split($cnt_komplekt_3);
?>
<div class="product-bottom-block">
    <div>&nbsp;</div>
    <?php if($arItem['IBLOCK_ID'] == '4'): ?>
    <?php
    $cnt_kitch = CIBlockElement::GetList(array(),array('IBLOCK_ID' => '20', 'SECTION_ID' => '46', 'INCLUDE_SUBSECTIONS' => 'Y', 'ACTIVE' => 'Y'), true);
    $split_cnt_kitch = str_split($cnt_kitch);
    $cnt_mebel = CIBlockElement::GetList(array(),array('IBLOCK_ID' => '20', 'SECTION_ID' => '47', 'INCLUDE_SUBSECTIONS' => 'Y', 'ACTIVE' => 'Y'), true);
    $split_cnt_mebel = str_split($cnt_mebel);
    ?>
    <div class="title_style_third"><div class="container"><span>Установленные проекты</span></div></div>
    <div class="row justify-content-center">
        <div class="col mr-lg-3" style="flex-grow: 0; margin-bottom: 2rem">
            <div style="background-image: url(/img/installed_prj_kitchen_bg.jpg); width: 556px; height: 334px" class="installed-projects-item">
                <div class="installed-projects-item__title">Кухни</div>
                <div class="installed-projects-item__counter">
                    <?php foreach ($split_cnt_kitch as $n): ?>
                    <div><?= $n ?></div>
                    <?php endforeach; ?>
                </div>
                <div class="installed-projects-item__button">
                    <a href="/our-works/kitchen/" class="btn btn-default btn-skew"><span>Посмотреть все</span></a>
                </div>
            </div>
        </div>
        <div class="col" style="flex-grow: 0; margin-bottom: 2rem">
            <div style="background-image: url(/img/installed_prj_mebel_bg.jpg); width: 556px; height: 334px" class="installed-projects-item">
                <div class="installed-projects-item__title">Шкафы-купе и другая мебель</div>
                <div class="installed-projects-item__counter">
                    <?php foreach ($split_cnt_mebel as $n): ?>
                        <div><?= $n ?></div>
                    <?php endforeach; ?>
                </div>
                <div class="installed-projects-item__button">
                    <a href="/our-works/wardrobes/" class="btn btn-default btn-skew"><span>Посмотреть все</span></a>
                </div>
            </div>
        </div>
    </div>
    <?php else: ?>
    <?php
    $cnt_kitch = CIBlockElement::GetList(array(),array('IBLOCK_ID' => '4', 'SECTION_ID' => '1', 'INCLUDE_SUBSECTIONS' => 'Y', 'ACTIVE' => 'Y'), true);
    $split_cnt_kitch = str_split($cnt_kitch);
    $cnt_mebel = CIBlockElement::GetList(array(),array('IBLOCK_ID' => '4', 'SECTION_ID' => '51', 'INCLUDE_SUBSECTIONS' => 'Y', 'ACTIVE' => 'Y'), true);
    $split_cnt_mebel = str_split($cnt_mebel);
    ?>
    <div class="title_style_third"><div class="container"><span>Каталог</span></div></div>
    <div class="row justify-content-center">
        <div class="col mr-lg-3" style="flex-grow: 0; margin-bottom: 2rem">
            <div style="background-image: url(/img/installed_prj_kitchen_bg.jpg); width: 556px; height: 334px" class="installed-projects-item">
                <div class="installed-projects-item__title">Кухни</div>
                <div class="installed-projects-item__counter">
                    <?php foreach ($split_cnt_kitch as $n): ?>
                    <div><?= $n ?></div>
                    <?php endforeach; ?>
                </div>
                <div class="installed-projects-item__button">
                    <a href="/catalog/kukhni/" class="btn btn-default btn-skew"><span>Посмотреть все</span></a>
                </div>
            </div>
        </div>
        <div class="col" style="flex-grow: 0; margin-bottom: 2rem">
            <div style="background-image: url(/img/installed_prj_mebel_bg.jpg); width: 556px; height: 334px" class="installed-projects-item">
                <div class="installed-projects-item__title">Шкафы-купе и другая мебель</div>
                <div class="installed-projects-item__counter">
                    <?php foreach ($split_cnt_mebel as $n): ?>
                        <div><?= $n ?></div>
                    <?php endforeach; ?>
                </div>
                <div class="installed-projects-item__button">
                    <a href="/catalog/mebel/" class="btn btn-default btn-skew"><span>Посмотреть все</span></a>
                </div>
            </div>
        </div>
    </div>
    <?php endif; ?>
    <div class="title_style_third"><div class="container"><span>Все для комплексной покупки</span></div></div>
    <div class="row justify-content-center">
        <div class="col mr-md-3 mb-3" style="flex-grow: 0">
            <div style="background-image: url(/img/komplekt-1.jpg); width: 358px; height: 334px" class="installed-projects-item">
                <div class="installed-projects-item__title">Техника</div>
                <div class="installed-projects-item__counter">
                    <?php foreach ($split_cnt_komplekt_1 as $n): ?>
                        <div><?= $n ?></div>
                    <?php endforeach; ?>
                </div>
                <div class="installed-projects-item__button">
                    <a href="/catalog/tekhnika/" class="btn btn-default btn-skew"><span>Посмотреть все</span></a>
                </div>
            </div>
        </div>
        <div class="col mb-3" style="flex-grow: 0">
            <div style="background-image: url(/img/komplekt-2.jpg); width: 358px; height: 334px" class="installed-projects-item">
                <div class="installed-projects-item__title">Комплектующие</div>
                <div class="installed-projects-item__counter">
                    <?php foreach ($split_cnt_komplekt_2 as $n): ?>
                        <div><?= $n ?></div>
                    <?php endforeach; ?>
                </div>
                <div class="installed-projects-item__button">
                    <a href="/catalog/komplektuyushchie/" class="btn btn-default btn-skew"><span>Посмотреть все</span></a>
                </div>
            </div>
        </div>
        <div class="col mb-3 mt-md-3 mt-xl-0" style="flex-grow: 0">
            <div style="background-image: url(/img/komplekt-3.jpg); width: 358px; height: 334px" class="installed-projects-item">
                <div class="installed-projects-item__title">Аксессуары</div>
                <div class="installed-projects-item__counter">
                    <?php foreach ($split_cnt_komplekt_3 as $n): ?>
                        <div><?= $n ?></div>
                    <?php endforeach; ?>
                </div>
                <div class="installed-projects-item__button">
                    <a href="/catalog/furnitura-i-aksessuary/" class="btn btn-default btn-skew"><span>Посмотреть все</span></a>
                </div>
            </div>
        </div>
    </div>
    <?php if(!empty($_SESSION['PRODUCTS_SEEN'])): ?>
    <div class="title_style_third"><div class="container"><span>Вы смотрели</span></div></div>
    <?
    global $arrFilter;

    $arrFilter = Array('ID' => false);
    ?>
    <div class="element-seen-block">
    <?$APPLICATION->IncludeComponent(
        "bitrix:catalog.section",
        "bas.catalog.carousel.seen",
        array(
            "ACTION_VARIABLE" => "action",
            "ADD_PROPERTIES_TO_BASKET" => "Y",
            "ADD_SECTIONS_CHAIN" => "N",
            "AJAX_MODE" => "N",
            "AJAX_OPTION_ADDITIONAL" => "",
            "AJAX_OPTION_HISTORY" => "N",
            "AJAX_OPTION_JUMP" => "N",
            "AJAX_OPTION_STYLE" => "Y",
            "BACKGROUND_IMAGE" => "-",
            "BASKET_URL" => "/personal/basket.php",
            "BAS_CLASS" => "grey",
            "BAS_NAME" => '',
            "BROWSER_TITLE" => "-",
            "CACHE_FILTER" => "N",
            "CACHE_GROUPS" => "Y",
            "CACHE_TIME" => "36000000",
            "CACHE_TYPE" => "A",
            "DETAIL_URL" => "",
            "DISABLE_INIT_JS_IN_COMPONENT" => "Y",
            "DISPLAY_BOTTOM_PAGER" => "N",
            "DISPLAY_TOP_PAGER" => "N",
            "ELEMENT_SORT_FIELD" => "sort",
            "ELEMENT_SORT_FIELD2" => "id",
            "ELEMENT_SORT_ORDER" => "asc",
            "ELEMENT_SORT_ORDER2" => "desc",
            "FILTER_NAME" => "arrFilter",
            "IBLOCK_ID" => "4",
            "IBLOCK_TYPE" => "catalog",
            "INCLUDE_SUBSECTIONS" => "Y",
            "LINE_ELEMENT_COUNT" => "1",
            "MESSAGE_404" => "",
            "MESS_BTN_ADD_TO_BASKET" => "В корзину",
            "MESS_BTN_BUY" => "Купить",
            "MESS_BTN_DETAIL" => "Подробнее",
            "MESS_BTN_SUBSCRIBE" => "Подписаться",
            "MESS_NOT_AVAILABLE" => "Нет в наличии",
            "META_DESCRIPTION" => "-",
            "META_KEYWORDS" => "-",
            "OFFERS_LIMIT" => "5",
            "PAGER_BASE_LINK_ENABLE" => "N",
            "PAGER_DESC_NUMBERING" => "N",
            "PAGER_DESC_NUMBERING_CACHE_TIME" => "36000",
            "PAGER_SHOW_ALL" => "N",
            "PAGER_SHOW_ALWAYS" => "N",
            "PAGER_TEMPLATE" => ".default",
            "PAGER_TITLE" => "Товары",
            "PAGE_ELEMENT_COUNT" => "15",
            "PARTIAL_PRODUCT_PROPERTIES" => "N",
            "PRICE_CODE" => array(
                0 => "PRICE",
            ),
            "PRICE_VAT_INCLUDE" => "Y",
            "PRODUCT_ID_VARIABLE" => "id",
            "PRODUCT_PROPERTIES" => array(
            ),
            "PRODUCT_PROPS_VARIABLE" => "prop",
            "PRODUCT_QUANTITY_VARIABLE" => "",
            "PROPERTY_CODE" => array(
                0 => "PRICE",
                1 => "COUNTRY",
                2 => "STAT",
                3 => "",
                4 => "",
            ),
            "SECTION_CODE" => "",
            "SECTION_ID" => "",
            "SECTION_ID_VARIABLE" => "SECTION_ID",
            "SECTION_URL" => "",
            "SECTION_USER_FIELDS" => array(
                0 => "",
                1 => "",
            ),
            "SEF_MODE" => "N",
            "SET_BROWSER_TITLE" => "N",
            "SET_LAST_MODIFIED" => "N",
            "SET_META_DESCRIPTION" => "N",
            "SET_META_KEYWORDS" => "N",
            "SET_STATUS_404" => "N",
            "SET_TITLE" => "N",
            "SHOW_404" => "N",
            "SHOW_ALL_WO_SECTION" => "Y",
            "SHOW_PRICE_COUNT" => "1",
            "TEMPLATE_THEME" => "blue",
            "USE_MAIN_ELEMENT_SECTION" => "N",
            "USE_PRICE_COUNT" => "N",
            "USE_PRODUCT_QUANTITY" => "N",
            "COMPONENT_TEMPLATE" => "bas.catalog.carousel.inner"
        ),
        false
    );?>
    </div>
    <?php endif ?>
</div>