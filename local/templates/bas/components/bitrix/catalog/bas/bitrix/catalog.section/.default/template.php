<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();

$bxajaxid = CAjax::GetComponentID($component->__name, $component->__template->__name, $component->arParams['AJAX_OPTION_ADDITIONAL']);

$this->setFrameMode(true);

global $filterSelectedBadges;

?>

<?if(isset($_REQUEST['bxajaxid']) && isset($_REQUEST['SHOW_MORE'])):?>

<?else:?>

    <div class="container" id="top_catalog">
        <div class="bas_catalog_section bas_catalog_section_style">

        <?if(is_object($arResult["NAV_RESULT"]) && is_subclass_of($arResult["NAV_RESULT"], "CAllDBResult")):?>

            <input type="hidden" value='<?=$arResult["NAV_RESULT"]->nSelectedCount?>' id="basCoutProduct">
            <input type="hidden" value='<?=str_replace("filter/clear/apply/", "", $APPLICATION->GetCurPage(false))?>' id="basSeCurPage">
            <input type="hidden" value='<?php $APPLICATION->ShowTitle(false) ?>' id="basCurTitle">
            <input type="hidden" value='<?php $APPLICATION->ShowProperty('title') ?>' id="basCurMetaTitle">
            <input type="hidden" value='<?php $APPLICATION->ShowProperty('description') ?>' id="basCurMetaDescription">
            <input type="hidden" value='<?= json_encode($filterSelectedBadges) ?>' id="basCurFilterBadges">
            <noindex>
                <div style="display: none" id="basCurBreadcrumbs">
                    <?$APPLICATION->IncludeComponent(
                        "bitrix:breadcrumb",
                        "bas",
                        Array(
                            "PATH" => "",
                            "SITE_ID" => "s1",
                            "START_FROM" => "0"
                        )
                    );?>
                </div>
            </noindex>

        <?endif?>

        <?if($arParams["DISPLAY_TOP_PAGER"]):?>
            <?=$arResult["NAV_STRING"]?>
        <?endif;?>

            <div class="row ajax_box position-relative">
                <div class="overload-cat"></div>
                <div class="overload-cat-img"></div>

<?endif?>

            <?foreach($arResult['ITEMS'] as $arItem):?>

                <div class="col-lg-4 col-sm-6">
                    <div class="basTovarBlockWrap">
                        <?if($arItem['DISPLAY_PROPERTIES']['STAT']['VALUE_XML_ID'] === 'N'):?>

                            <div class="catalog-label" <?= $arItem['DISPLAY_PROPERTIES']['PRO_PHOTO']['VALUE']? 'style="right: 106px"' : '' ?>>
                                <span class="catalog-label__inner">Новинка</span>
                            </div>

                        <?elseif($arItem['DISPLAY_PROPERTIES']['STAT']['VALUE_XML_ID'] === 'H'):?>

                            <div class="catalog-label catalog-label_red" <?= $arItem['DISPLAY_PROPERTIES']['PRO_PHOTO']['VALUE']? 'style="right: 106px"' : '' ?>>
                                <span class="catalog-label__inner">ХИТ</span>
                            </div>

                        <?endif?>

                        <?php if($arParams['IBLOCK_ID'] == 4 && $arItem['IBLOCK_ID'] == 20): ?>
                            <div class="catalog-label" style="right: 106px;">
                                <span class="catalog-label__inner">Наша работа</span>
                            </div>
                        <?php endif; ?>

                        <?php if ($arItem['DISPLAY_PROPERTIES']['PRO_PHOTO']['VALUE']): ?>
                            <div class="catalog-label catalog-label_blue">
                                <span class="catalog-label__inner">
                                    <span class="photo-icon"></span>
                                    PRO
                                </span>
                            </div>
                        <?php endif; ?>

                        <div class="block bas_block_shadow bas_our_margin basTovarBlock <?= ($arParams['IBLOCK_ID'] == 4 && $arItem['IBLOCK_ID'] == 20)?'basTovarBlock__OurWork':'' ?>">

                            <a class="img <?=$arResult['SECTION']['UF_CENTER_PICT'] ? 'bas_center' : ''?>" <?=(COption::GetOptionString("askaron.settings", "UF_SHOW_IN_NEW_TAB") ? 'target="_blank"' : '')?> href="<?=$arItem['DETAIL_PAGE_URL']?>">

                            <?if($arItem['PREVIEW_PICTURE']['SRC']):?>

                                <?$arItemsSmall = CFile::ResizeImageGet($arItem['PREVIEW_PICTURE'], array('width' => 1000, 'height' => 250), BX_RESIZE_IMAGE_PROPORTIONAL, false, false, false, 85);?>

                                <img src="<?=$arItemsSmall['src']?>" alt="<?=$arItem['PREVIEW_PICTURE']['ALT']?>">

                            <?else:?>

                                <img src="<?=SITE_TEMPLATE_PATH?>/img/no.pict.jpg" alt="No Photo" title="<?=$arItem['NAME']?>">

                            <?endif?>

                            </a>
                            <?foreach($arItem['PROPERTIES'] as $key=>$prop)
                            {
                                if( (strpos($key, 'MAT')!==false && strpos($key,'SYYL_MAT_OBIV')===false&&($key!="OBED_MATKAR")&&($key!="OBED_MATOB")
                                        ||($key=="VP_TIP")
                                        ||($key=="BYTIJ_SETUP")
                                        ||($key=="PM_TIP_YSTAN")
                                        ||($key=="MICROWAVE_RASPOLG")
                                        ||($key=="XOLOD_RASPOLG")
                                        ||($key=="STIRAL_RASPOLG")
                                        ||($key=="ALL_STYLE"&&$arParams['SECTION_CODE']=="parovarki")
                                        ||($key=="KOFE_TIP")
                                        ||($key=="DYX_PODKL")
                                        ||($key=="VIDV_BRAND")
                                        ||($key=="SUSHKI_BRAND")
                                        ||($key=="VEDRA_BRAND")
                                        ||($key=="OSVEH_TIPSVEH")
                                        ||($key=="PODM_BRAND")
                                        ||($key=="LOTKI_BRAND")
                                        ||($key=="REIL_BRAND")
                                        ||($key=="BAR_BRAND")
                                        ||($key=="DRUG_BRAND")
                                        )&&$prop['VALUE']) {

                                    $mat = (is_array( $prop['VALUE'] )) ? implode(", ",$prop['VALUE']) : $prop['VALUE'];
                                }
                            }?>
                            <div class="info">
                                <a href="<?=$arItem['DETAIL_PAGE_URL']?>" class="name basTovarName" <?=(COption::GetOptionString("askaron.settings", "UF_SHOW_IN_NEW_TAB") ? 'target="_blank"' : '')?>><?=$arItem['NAME']?></a>
                                <div class="top row no-gutters justify-content-between">
                                    <div class="left">
                                        <span class="mat" data-toggle="tooltip" data-placement="top" title="<?=$mat?>">
                                            <?=$mat?>
                                        </span>
                                    </div>
                                    <div class="right">
                                        <div class="country">

                                        <?if($arResult['COUNTRY'][$arItem['DISPLAY_PROPERTIES']['COUNTRY']['VALUE']]):?>

                                            <span>Произведено:</span>
                                            <img src="<?=$arResult['COUNTRY'][$arItem['DISPLAY_PROPERTIES']['COUNTRY']['VALUE']]?>" alt="<?=$arItem['DISPLAY_PROPERTIES']['COUNTRY']['DISPLAY_VALUE']?>">

                                        <?endif?>

                                        </div>
                                    </div>
                                </div>
                                <div class="row no-gutters justify-content-between align-items-center">
                                    <div class="left">
                                    <?if ($arParams["HIDE_PRICE"] !== 'Y' && $arItem['IBLOCK_ID'] != 20 && !$arResult['SECTION']['UF_HIDE_PRICE']):?>

                                        <span class="price">
                                            <b>
                                                <?if($arResult['SECTION']['UF_SHOW_FROM']):?>от <?endif?>
                                                <?=number_format($arItem['DISPLAY_PROPERTIES']['PRICE']['VALUE'], 0, '', ' ')?> руб.
                                            </b>
                                            <br/>
                                            <?=$arResult['SECTION']['UF_ZA']?>
                                        </span>

                                    <?endif?>

                                    </div>
                                    <?php
                                    $btn_type = 'default';


                                    if(strpos($_SERVER['REQUEST_URI'], '/catalog/kukhni/') === 0
                                        || $arResult['IBLOCK_SECTION_ID'] == 51
                                        || strpos($_SERVER['REQUEST_URI'], '/our-works/') === 0
                                    )
                                        $btn_type = 'form';
                                    elseif (in_array($arResult['IBLOCK_SECTION_ID'], [
                                            6, //Техника
                                            9, //Мойки
                                            8, //Фурнитура и аксессуары
                                            5, //Комплектующие
                                    ]))
                                        $btn_type = 'detail';
                                    ?>
                                    <div class="right">
                                        <?php if($btn_type == 'form'): ?>
                                        <a href="javascript:;" class="btn btn-default bold btn-detail basOrderMake btn-skew"><span>ЗАКАЗАТЬ <span style="font-weight: normal">РАСЧЕТ</span></span></a>
                                        <?php elseif($btn_type == 'detail'): ?>
                                        <a href="<?= $arItem['DETAIL_PAGE_URL'] ?>" class="btn btn-default btn-detail btn-detail-one bold btn-skew" style="font-weight: normal"><span>ПОДРОБНЕЕ</span></a>
                                        <?php else: ?>
                                        <a href="javascript:;" class="btn btn-default bold btn-detail btn-detail-one basOrderMake btn-skew"><span>ЗАКАЗАТЬ</span></a>
                                        <?php endif; ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            <?endforeach;?>

			<?/*if($arResult["NAV_RESULT"]->nEndPage > 1 && $arResult["NAV_RESULT"]->NavPageNomer<$arResult["NAV_RESULT"]->nEndPage):?>

                <?
                $intLostElem = $arResult["NAV_RESULT"]->NavRecordCount - ($arResult["NAV_RESULT"]->NavPageNomer * $arResult["NAV_RESULT"]->NavPageSize);

                if ($intLostElem > $arResult["NAV_RESULT"]->NavPageSize) $intDownCount = $arResult["NAV_RESULT"]->NavPageSize;
                else $intDownCount = $intLostElem;
                ?>

				<div class="text-center bas_our_margin col-12" id="btn_<?=$bxajaxid?>">
					<a href="javascript:;" class="btn btn-primary" data-ajax-id="<?=$bxajaxid?>" data-show-more="<?=$arResult["NAV_RESULT"]->NavNum?>" data-next-page="<?=($arResult["NAV_RESULT"]->NavPageNomer + 1)?>" data-max-page="<?=$arResult["NAV_RESULT"]->nEndPage?>">показать ещё <?=$intDownCount?> из <?=$intLostElem?></a>
				</div>

			<?endif*/?>

<?if(isset($_REQUEST['bxajaxid']) && isset($_REQUEST['SHOW_MORE'])):?>
<?else:?>

            </div>

        <?if($arParams["DISPLAY_TOP_PAGER"]):?>
            <?=$arResult["NAV_STRING"]?>
        <?endif;?>

        </div>
    </div>

<?php if(isset($_REQUEST['BAS_AJAX_CALL'])): ?>
<script>
$(function(){

	$('.bas_catalog_carousel').each(function(){

		var basElem = $(this).find('.carousel').owlCarousel({
			loop				: true,
			margin				: 30,
			nav					: false,
			pagination			: false,
			autoplay			: false,
			responsive:{
				0:{
					items:1
				},
				576:{
					items:2
				},
				992:{
					items:3
				}
			}
		});

		$(this).find('.control_next').click(function() {
			basElem.trigger('next.owl.carousel');
		});

		$(this).find('.control_prev').click(function() {
			basElem.trigger('prev.owl.carousel');
		});
	});
});
</script>
<?php endif ?>

<?php if($arResult['ORIGINAL_PARAMETERS']['SECTION_CODE'] == 'kukhni' || $arResult['ORIGINAL_PARAMETERS']['SECTION_CODE'] == 'kitchen'): ?>

<div class="bg-gray py-4">
    <div class="container">

        <div class="title-yellow">
			<span><?= $arResult['IBLOCK_ID'] == 4 ? 'Наши работы' : 'Каталог' ?></span>
		</div>

        <div class="catalog-slider-subtitle">Подходящие под ваши параметры</div>

        <?php

        global $arrFilter;

        $arrFilter = $arResult['BOTTOM_SLIDER_FILTER'];

        $APPLICATION->IncludeComponent(
            "bitrix:catalog.section",
            "bas.catalog.carousel",
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
                "BAS_NAME" => "Хит продаж",
                "BAS_NAME_WHITE" => "Хит продаж",
                "BROWSER_TITLE" => "-",
                "CACHE_FILTER" => "N",
                "CACHE_GROUPS" => "N",
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
                "IBLOCK_ID" => $arResult['IBLOCK_ID'] == 4 ? 20 : 4,
                "IBLOCK_TYPE" => "catalog",
                "INCLUDE_SUBSECTIONS" => "Y",
                "LINE_ELEMENT_COUNT" => "3",
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
                "PAGE_ELEMENT_COUNT" => "20",
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
                    2 => "",
                ),
                "SECTION_CODE" => "",
                "SECTION_ID" => $arResult['IBLOCK_ID'] == 4 ? 46 : 1,
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
                "SHOW_ALL_WO_SECTION" => "N",
                "SHOW_PRICE_COUNT" => "1",
                "TEMPLATE_THEME" => "blue",
                "USE_MAIN_ELEMENT_SECTION" => "N",
                "USE_PRICE_COUNT" => "N",
                "USE_PRODUCT_QUANTITY" => "N",
                "COMPONENT_TEMPLATE" => "bas.catalog.carousel",
                "BAS_NAME_LINK" => $arResult['BOTTOM_SLIDER_SHOW_ALL_LINK'],
                "COMPATIBLE_MODE" => "N",
                "BAS_NAME_MAIN" => "Хит продаж",
                "COMPOSITE_FRAME_MODE" => "A",
                "COMPOSITE_FRAME_TYPE" => "AUTO",
                "DISPLAY_COMPARE" => "N",
                "BAS_BEFORE_PRICE" => "от "
            ),
            $component
        );?>
    </div>
</div>
<?php endif; ?>

    <?if(!isset($_REQUEST['PAGEN_1'])):?>

        <?global $sotbitSeoMetaBottomDesc;?>

        <?if($sotbitSeoMetaBottomDesc):?>

            <div class="bas_grey_text_block">
                <div class="container">
                    <?=$sotbitSeoMetaBottomDesc?>
                </div>
            </div>

        <?elseif($arResult['DESCRIPTION'] && !$arResult['ORIGINAL_PARAMETERS']['GLOBAL_FILTER']):?>

            <div class="bas_grey_text_block">
                <div class="container">
                    <?=$arResult['DESCRIPTION']?>
                </div>
            </div>

        <?endif?>

    <?endif?>

<?endif?>