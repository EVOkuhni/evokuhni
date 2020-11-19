<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();

$bas_folder = explode('/', $APPLICATION->GetCurPage(false));

$this->setFrameMode(true);?>

<div class="bx_filter show_filter bx_horizontal our_form_styler">
	<div class="bas_filter_info"></div>
	<div class="bx_filter_section">
		<form name="<?echo $arResult["FILTER_NAME"]."_form"?>" action="<?echo $arResult["FORM_ACTION"]?>" method="get" class="smartfilter">

			<?foreach($arResult["HIDDEN"] as $arItem):?>
			<input type="hidden" name="<?echo $arItem["CONTROL_NAME"]?>" id="<?echo $arItem["CONTROL_ID"]?>" value="<?echo $arItem["HTML_VALUE"]?>" />
			<?endforeach;

			foreach($arResult["ITEMS"] as $key => $arItem)
			{
                if ($arParams["HIDE_PRICE"] === 'Y' && $arItem["DISPLAY_TYPE"] === "A")
                {
                }
                else
                {
                    if (empty($arItem["VALUES"]) || isset($arItem["PRICE"])) continue;

                    if ($arItem["DISPLAY_TYPE"] == "A" && ($arItem["VALUES"]["MAX"]["VALUE"] - $arItem["VALUES"]["MIN"]["VALUE"] <= 0)) continue;

                    if ($arItem["DISPLAY_TYPE"] == "A" && $bas_folder[2] === 'kukhni') $arItem["NAME"] = 'Цена м/п';

                    if ($arItem["DISPLAY_TYPE"] == "A" && (isset($arItem["VALUES"]["MIN"]["HTML_VALUE"]) || isset($arItem["VALUES"]["MAX"]["HTML_VALUE"]))):?>
                        <i class="bas_set_price"></i>
                    <?endif?>
                    <div class="bx_filter_parameters_box bx_filter_code__<?=$arItem['CODE'];?>">
                        <span class="bx_filter_container_modef"></span>
                        <div class="bx_filter_parameters_box_title"><?=$arItem["NAME"]?></div>
                        <div class="bx_filter_block">
                            <div class="bx_filter_parameters_box_container">
                            <?
                            switch ($arItem["DISPLAY_TYPE"])
                            {
                                case "A":?>

                                    <?
                                    $arItem["VALUES"]["MIN"]["VALUE"] = ($arItem["VALUES"]["MIN"]["FILTERED_VALUE"] ? $arItem["VALUES"]["MIN"]["FILTERED_VALUE"] : $arItem["VALUES"]["MIN"]["VALUE"]);
                                    $arItem["VALUES"]["MAX"]["VALUE"] = ($arItem["VALUES"]["MAX"]["FILTERED_VALUE"] ? $arItem["VALUES"]["MAX"]["FILTERED_VALUE"] : $arItem["VALUES"]["MAX"]["VALUE"]);
                                    ?>

                                    <div class="bx_filter_parameters_box_container_block">
                                        <div class="bx_filter_input_container">
                                            <span>от</span><input class="min-price" type="text" name="<?=$arItem["VALUES"]["MIN"]["CONTROL_NAME"]?>" id="<?=$arItem["VALUES"]["MIN"]["CONTROL_ID"]?>" placeholder="<?=$arItem["VALUES"]["MIN"]["VALUE"]?>" value="">
                                            руб.
                                        </div>
                                    </div>
                                    <div class="bx_filter_parameters_box_container_block">
                                        <div class="bx_filter_input_container">
                                            <span>до</span><input class="max-price" type="text" name="<?=$arItem["VALUES"]["MAX"]["CONTROL_NAME"]?>" id="<?=$arItem["VALUES"]["MAX"]["CONTROL_ID"]?>" placeholder="<?=$arItem["VALUES"]["MAX"]["VALUE"]?>" value="">
                                            руб.
                                        </div>
                                    </div>
                                    <div style="clear: both;"></div>

                                    <div class="bx_ui_slider_track" id="drag_track_<?=$key?>">
                                        <?
                                        $value1 = $arItem["VALUES"]["MIN"]["VALUE"];
                                        $value5 = $arItem["VALUES"]["MAX"]["VALUE"];
                                        ?>
                                        <div class="bx_ui_slider_part p1"><span><?=$value1?></span></div>
                                        <div class="bx_ui_slider_part p5"><span><?=$value5?></span></div>

                                        <div class="bx_ui_slider_pricebar_VD" style="left: 0;right: 0;" id="colorUnavailableActive_<?=$key?>"></div>
                                        <div class="bx_ui_slider_pricebar_VN" style="left: 0;right: 0;" id="colorAvailableInactive_<?=$key?>"></div>
                                        <div class="bx_ui_slider_pricebar_V"  style="left: 0;right: 0;" id="colorAvailableActive_<?=$key?>"></div>
                                        <div class="bx_ui_slider_range" id="drag_tracker_<?=$key?>"  style="left: 0;right: 0;">
                                            <a class="bx_ui_slider_handle left"  style="left:0;" href="javascript:void(0)" id="left_slider_<?=$key?>"></a>
                                            <a class="bx_ui_slider_handle right" style="right:0;" href="javascript:void(0)" id="right_slider_<?=$key?>"></a>
                                        </div>
                                    </div>
                                    <?
                                    $arJsParams = array(
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
                                    );
                                    ?>
                                    <script type="text/javascript">
                                        BX.ready(function(){
                                            window['trackBar<?=$key?>'] = new BX.Iblock.SmartFilter(<?=CUtil::PhpToJSObject($arJsParams)?>);
                                        });
                                    </script>
                                <?
                                break;
                                default:?>

                                    <?if($arItem['CODE'] === 'KITCH_CVET'):?>

                                        <?foreach($arItem["VALUES"] as $val => $ar):?>

                                            <label data-role="label_<?=$ar["CONTROL_ID"]?>" class="bx_filter_param_label <?=$ar["DISABLED"] ? 'disabled': '' ?>" for="<?=$ar["CONTROL_ID"] ?>">
                                                <span class="bx_filter_input_checkbox">
                                                    <span class="color color<?=$ar["URL_ID"]?>"></span>
                                                    <input
                                                        class="nostyler d-none"
                                                        type="checkbox"
                                                        value="<?=$ar["HTML_VALUE"] ?>"
                                                        name="<?=$ar["CONTROL_NAME"] ?>"
                                                        id="<?=$ar["CONTROL_ID"] ?>"
                                                        <?=$ar["CHECKED"]? 'checked': '' ?>
                                                        <?=$ar["DISABLED"] ? 'disabled': '' ?>
                                                    >
                                                    <span class="bx_filter_param_text" title="<?=$ar["VALUE"];?>"><?=$ar["VALUE"];?></span>
                                                </span>
                                            </label>

                                        <?endforeach;?>

                                    <?else:?>

                                        <?foreach($arItem["VALUES"] as $val => $ar):?>

                                            <label data-role="label_<?=$ar["CONTROL_ID"]?>" class="bx_filter_param_label <?=$ar["DISABLED"] ? 'disabled': '' ?>" for="<?=$ar["CONTROL_ID"] ?>">
                                                <span class="bx_filter_input_checkbox">
                                                    <input
                                                        type="checkbox"
                                                        value="<?=$ar["HTML_VALUE"] ?>"
                                                        name="<?=$ar["CONTROL_NAME"] ?>"
                                                        id="<?=$ar["CONTROL_ID"] ?>"
                                                        <?=$ar["CHECKED"]? 'checked': '' ?>
                                                        <?=$ar["DISABLED"] ? 'disabled': '' ?>
                                                    >
                                                    <span class="bx_filter_param_text" title="<?=$ar["VALUE"];?>"><?=$ar["VALUE"];?></span>
                                                </span>
                                            </label>

                                        <?endforeach;?>

                                    <?endif?>

                                <?break;
                            }
                            ?>
                            </div>
                        </div>
                    </div>

			<?   }
			}
			?>

			<div class="bx_filter_button_box active">
                <div class="row justify-content-between align-items-center">
                    <div class="col-5">
                        <div class="count_info"></div>
                    </div>
                    <div class="col-7 text-right">
                        <input type="hidden" name="BAS_AJAX_FILTER_INFO" value="Y">
                        <input type="hidden" name="set_filter" value="Y">
                        <a href="<?=str_replace("filter/clear/apply/", "", $arResult['SEF_DEL_FILTER_URL'])?>">Сбросить фильтр</a>
                    </div>
                </div>
			</div>
		</form>
	</div>
</div>
<!--
<script>
	var smartFilter = new JCSmartFilter();
</script>-->
