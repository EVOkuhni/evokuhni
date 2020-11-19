<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();

$bas_folder = explode('/', $APPLICATION->GetCurPage(false));
global $sotbitFilterSelected;

$this->setFrameMode(true);


?>

<div class="catalog-filter-wrap">

    <div class="catalog-filter-title">Фильтр по параметрам</div>

    <div class="bx_filter show_filter bx_horizontal our_form_styler">
        <?/*<div class="bas_filter_info"></div>*/?>
        <div class="bx_filter_section">
            <form name="<?echo $arResult["FILTER_NAME"]."_form"?>" action="<?echo $arResult["FORM_ACTION"]?>" method="get" class="smartfilter">

                <?foreach($arResult["HIDDEN"] as $arItem):?>
                <input type="hidden" name="<?echo $arItem["CONTROL_NAME"]?>" id="<?echo $arItem["CONTROL_ID"]?>" value="<?echo $arItem["HTML_VALUE"]?>" />
                <?endforeach;?>

                <div class="d-flex flex-wrap">

                <?foreach($arResult["ITEMS"] as $key => $arItem)
                {
                    if($arItem['CODE'] == 'PRO_PHOTO') {
                        $proPhotoItem = $arItem;
                    }
                    if (empty($arItem["VALUES"])) continue;?>

                    <div class="bx_filter_parameters_box bx_filter_code__<?=$arItem['CODE'];?> <?= ($arItem['CODE'] == 'PRO_PHOTO')?'d-none':'' ?>" <?= $arItem['CODE'] == 'ST_COLLECTION' ? 'style="display: none"' : '' ?>>
                        <span class="bx_filter_container_modef"></span>
                        <div class="bx_filter_parameters_box_title"><?=$arItem["NAME"]?></div>
                        <div class="bx_filter_block">
                            <div class="bx_filter_parameters_box_container">

                            <?foreach($arItem["VALUES"] as $val => $ar):?>

                                <label data-role="label_<?=$ar["CONTROL_ID"]?>" class="bx_filter_param_label <?=$ar["DISABLED"] ? 'disabled': '' ?>" for="<?=$ar["CONTROL_ID"] ?>" data-collection="<?= $arItem['CODE'] == 'ST_COLLECTION'?'1':'0' ?>">
                                    <span class="bx_filter_input_checkbox">
                                        <input
                                            type="checkbox"
                                            value="<?=$ar["HTML_VALUE"] ?>"
                                            name="<?=$ar["CONTROL_NAME"] ?>"
                                            id="<?=$ar["CONTROL_ID"] ?>"
                                            <?=$ar["CHECKED"]? 'checked': '' ?>
                                            <?=$ar["DISABLED"] ? 'disabled': '' ?>
                                        >

                                    <?if($arItem['CODE'] === 'KITCH_CVET'):?>

                                        <span class="color color<?=$ar["URL_ID"]?>"></span>

                                    <?endif?>

                                        <span class="bx_filter_param_text" title="<?=$ar["VALUE"];?>"><?=$ar["VALUE"];?></span>
                                    </span>
                                </label>

                            <?endforeach;?>

                            </div>
                        </div>
                    </div>

                <?}?>

                </div>
                <div class="bx_filter_button_box active">
                    <div class="row justify-content-between no-gutters">
                        <div class="filter-footer__left">

                        <?if($bas_folder[1] === 'catalog' && !$arResult['SECTION']['UF_HIDE_PRICE']):?>

                            <?$arItem = $arResult["PRICE"];?>

                            <div class="bx_filter_parameters_box bx_filter_code__<?=$arItem['CODE'];?>">
                                <div class="bx_filter_parameters_box_container">

                                    <?
                                    $arItem["VALUES"]["MIN"]["VALUE"] = ($arItem["VALUES"]["MIN"]["FILTERED_VALUE"] ? $arItem["VALUES"]["MIN"]["FILTERED_VALUE"] : $arItem["VALUES"]["MIN"]["VALUE"]);
                                    $arItem["VALUES"]["MAX"]["VALUE"] = ($arItem["VALUES"]["MAX"]["FILTERED_VALUE"] ? $arItem["VALUES"]["MAX"]["FILTERED_VALUE"] : $arItem["VALUES"]["MAX"]["VALUE"]);
                                    ?>

                                    <input class="min-price" type="hidden" name="<?=$arItem["VALUES"]["MIN"]["CONTROL_NAME"]?>" id="<?=$arItem["VALUES"]["MIN"]["CONTROL_ID"]?>" placeholder="<?=$arItem["VALUES"]["MIN"]["VALUE"]?>" value="">
                                    <input class="max-price" type="hidden" name="<?=$arItem["VALUES"]["MAX"]["CONTROL_NAME"]?>" id="<?=$arItem["VALUES"]["MAX"]["CONTROL_ID"]?>" placeholder="<?=$arItem["VALUES"]["MAX"]["VALUE"]?>" value="">

                                    <div class="bx_ui_slider_track" id="drag_track_<?=$key?>">

                                        <?
                                        $value1 = $arItem["VALUES"]["MIN"]["HTML_VALUE"] ? $arItem["VALUES"]["MIN"]["HTML_VALUE"] : $arItem["VALUES"]["MIN"]["VALUE"];
                                        $value5 = $arItem["VALUES"]["MAX"]["HTML_VALUE"] ? $arItem["VALUES"]["MAX"]["HTML_VALUE"] : $arItem["VALUES"]["MAX"]["VALUE"];
                                        ?>

                                        <div class="bx_ui_slider_part p1">
                                            <span><?=$value1?></span> р.
                                        </div>
                                        <div class="bx_ui_slider_part p5">
                                            <span><?=$value5?></span> р.
                                        </div>

                                        <div class="main_line"></div>
                                        <div class="bx_ui_slider_pricebar_VD" style="left: 0;right: 0;" id="colorUnavailableActive_<?=$key?>"></div>
                                        <div class="bx_ui_slider_pricebar_VN" style="left: 0;right: 0;" id="colorAvailableInactive_<?=$key?>"></div>
                                        <div class="bx_ui_slider_pricebar_V"  style="left: 0;right: 0;" id="colorAvailableActive_<?=$key?>"></div>
                                        <div class="bx_ui_slider_range" id="drag_tracker_<?=$key?>"  style="left: 0;right: 0;">
                                            <a class="bx_ui_slider_handle left"  style="left:0;" href="javascript:void(0)" id="left_slider_<?=$key?>"></a>
                                            <a class="bx_ui_slider_handle right" style="right:0;" href="javascript:void(0)" id="right_slider_<?=$key?>"></a>
                                        </div>
                                    </div>

                                    <?$arJsParams = array(
                                        "leftSlider" => 'left_slider_'.$key,
                                        "rightSlider" => 'right_slider_'.$key,
                                        "tracker" => "drag_tracker_".$key,
                                        "trackerWrap" => "drag_track_".$key,
                                        "minInputId" => $arItem["VALUES"]["MIN"]["CONTROL_ID"],
                                        "maxInputId" => $arItem["VALUES"]["MAX"]["CONTROL_ID"],
                                        "minPrice" => $arItem["VALUES"]["MIN"]["VALUE"],
                                        "maxPrice" => $arItem["VALUES"]["MAX"]["VALUE"],
                                        "curMinPrice" => $arItem["VALUES"]["MIN"]["HTML_VALUE"],
                                        "curMaxPrice" => $arItem["VALUES"]["MAX"]["HTML_VALUE"],
                                        "fltMinPrice" => intval($arItem["VALUES"]["MIN"]["FILTERED_VALUE"]) ? $arItem["VALUES"]["MIN"]["FILTERED_VALUE"] : $arItem["VALUES"]["MIN"]["VALUE"] ,
                                        "fltMaxPrice" => intval($arItem["VALUES"]["MAX"]["FILTERED_VALUE"]) ? $arItem["VALUES"]["MAX"]["FILTERED_VALUE"] : $arItem["VALUES"]["MAX"]["VALUE"],
                                        "precision" => $arItem["DECIMALS"]? $arItem["DECIMALS"]: 0,
                                        "colorUnavailableActive" => 'colorUnavailableActive_'.$key,
                                        "colorAvailableActive" => 'colorAvailableActive_'.$key,
                                        "colorAvailableInactive" => 'colorAvailableInactive_'.$key,
                                    );?>

                                    <script type="text/javascript">
                                        var smartFilter;

                                        BX.ready(function(){
                                            smartFilter = new BX.Iblock.SmartFilter(<?=CUtil::PhpToJSObject($arJsParams)?>);
                                        });
                                    </script>

                                </div>
                            </div>

                        <?endif?>

                        </div>
                        <div class="filter-footer__right">
                            <div class="count_info">
                                Выбрано: <b></b>
                            </div>
                            <input type="hidden" name="BAS_AJAX_FILTER_INFO" value="Y">
                            <input type="hidden" name="set_filter" value="Y">
                            <a href="<?=str_replace("filter/clear/apply/", "", $arResult['SEF_DEL_FILTER_URL'])?>">Сбросить фильтр</a>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <?php if (!empty($proPhotoItem)): ?>
    <div>
        <script>
            $(function () {
                $('.jq-pro-photo').on('click', function () {
                    if(!$(this).find('.jq-checkbox').hasClass('checked'))
                    {
                        $(this).find('.jq-checkbox').addClass('checked');
                        $(this).find('.jq-checkbox').find('.jq-checkbox__div').show();
                    }else
                    {
                        $(this).find('.jq-checkbox').removeClass('checked');
                        $(this).find('.jq-checkbox').find('.jq-checkbox__div').hide();
                    }
                })
            })
        </script>
        <?foreach($proPhotoItem["VALUES"] as $val => $ar):?>

            <label data-role="label_<?=$ar["CONTROL_ID"]?>" class="bx_filter_param_label jq-pro-photo <?=$ar["DISABLED"] ? 'disabled': '' ?>" for="<?=$ar["CONTROL_ID"] ?>">
                <span class="bx_filter_input_checkbox">
                    <div class="jq-checkbox <?=$ar["CHECKED"]? 'checked': '' ?>" style="user-select: none;display: inline-block; position: relative; overflow: hidden; margin-right: 5px">
                        <input
                            type="checkbox"
                            value="<?=$ar["HTML_VALUE"] ?>"
                            name="<?=$ar["CONTROL_NAME"] ?>"
                            id="<?=$ar["CONTROL_ID"] ?>"
                            <?=$ar["CHECKED"]? 'checked': '' ?>
                            <?=$ar["DISABLED"] ? 'disabled': '' ?>
                            style="position: absolute;z-index: -1; opacity: 0; margin: 0px; padding: 0px;"
                        >
                        <div class="jq-checkbox__div" <?= $ar['CHECKED']?'':'style="display: none"' ?>></div>
                    </div>
                    <span class="photo-icon-blue"></span>
                    <span class="bx_filter_param_text">Проекты с профессиональными фото</span>
                </span>
            </label>

        <div class="question-mark">
            <div class="question-mark-tooltip">
                Фотографии проектов выполнены профессиональным фотографом EVO Кухни
            </div>
        </div>

        <?endforeach;?>
    </div>
    <?php endif ?>
    <div class="catalog-filter-selected-wrap" <?= empty($arResult['SELECTED_BADGES'])?'style="display: none"':'' ?>>
        <strong>Вы выбрали: </strong>
        <div class="catalog-filter-selected">
            <?php foreach ($arResult['SELECTED_BADGES'] as $badge): ?>
            <a class="filter-badge" href="#" data-control="<?= $badge['CONTROL_ID'] ?>"><?= $badge['NAME'] ?> <span class="filter-badge-close"></span></a>
            <?php endforeach; ?>
        </div>
    </div>
</div>