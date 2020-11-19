<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();

$bxajaxid = CAjax::GetComponentID($component->__name, $component->__template->__name, $component->arParams['AJAX_OPTION_ADDITIONAL']);

$this->setFrameMode(true);?>

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
<?php if(count($arResult['ITEMS']) > 0): ?>
            <?foreach($arResult['ITEMS'] as $arItem):?>
                <?php
                $arItem['DISPLAY_PROPERTIES'] = $arItem['PROPERTIES'];
                ?>
                <div class="col-lg-4 col-sm-6">
                    <div class="basTovarBlockWrap">
                        <?if($arItem['DISPLAY_PROPERTIES']['STAT']['VALUE_XML_ID'] === 'N'):?>

                            <div class="catalog-label">
                                <span class="catalog-label__inner">Новинка</span>
                            </div>

                        <?elseif($arItem['DISPLAY_PROPERTIES']['STAT']['VALUE_XML_ID'] === 'H'):?>

                            <div class="catalog-label catalog-label_red">
                                <span class="catalog-label__inner">ХИТ</span>
                            </div>

                        <?endif?>
                        <div class="block bas_block_shadow bas_our_margin basTovarBlock">

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

                                    <?if ($arParams["HIDE_PRICE"] !== 'Y' && $arResult['IBLOCK_ID'] == 4):?>

                                        <span class="price">
                                            <b>
                                                <?if($arResult['SECTION']['UF_SHOW_FROM']):?>от <?endif?>
                                                <?=number_format($arItem['DISPLAY_PROPERTIES']['PRICE']['VALUE'], 0, '', ' ')?>
                                                руб.
                                            </b>
                                            <br/><?=$arResult['SECTION']['UF_ZA']?>
                                        </span>

                                    <?endif?>

                                    </div>
                                    <?php
                                    $btn_type = 'default';


                                    if (in_array($arItem['IBLOCK_SECTION_ID'], [
                                            6, //Техника
                                            9, //Мойки
                                            8, //Фурнитура и аксессуары
                                            5, //Комплектующие
                                            7, 10, 11, 20, 12, 13, 14, 15, 16, 17, 18, 19, 27, 32, 31, 39, 33, 36, 35, 38, 34, 37, 40,
                                    ]))
                                    {
                                        $btn_type = 'detail';
                                    }
                                    else
                                        $btn_type = 'form';
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
<?php else: ?>
<div class="col-12">
    <h2 class="text-center d-block mb-5 text-muted">Нет товаров</h2>
</div>
<?php endif; ?>
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