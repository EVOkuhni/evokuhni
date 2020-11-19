<?if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();?>

<div class="bas_search_page">
	<?if($arParams["SHOW_TAGS_CLOUD"] == "Y")
	{
		$arCloudParams = Array(
			"SEARCH" => $arResult["REQUEST"]["~QUERY"],
			"TAGS" => $arResult["REQUEST"]["~TAGS"],
			"CHECK_DATES" => $arParams["CHECK_DATES"],
			"arrFILTER" => $arParams["arrFILTER"],
			"SORT" => $arParams["TAGS_SORT"],
			"PAGE_ELEMENTS" => $arParams["TAGS_PAGE_ELEMENTS"],
			"PERIOD" => $arParams["TAGS_PERIOD"],
			"URL_SEARCH" => $arParams["TAGS_URL_SEARCH"],
			"TAGS_INHERIT" => $arParams["TAGS_INHERIT"],
			"FONT_MAX" => $arParams["FONT_MAX"],
			"FONT_MIN" => $arParams["FONT_MIN"],
			"COLOR_NEW" => $arParams["COLOR_NEW"],
			"COLOR_OLD" => $arParams["COLOR_OLD"],
			"PERIOD_NEW_TAGS" => $arParams["PERIOD_NEW_TAGS"],
			"SHOW_CHAIN" => "N",
			"COLOR_TYPE" => $arParams["COLOR_TYPE"],
			"WIDTH" => $arParams["WIDTH"],
			"CACHE_TIME" => $arParams["CACHE_TIME"],
			"CACHE_TYPE" => $arParams["CACHE_TYPE"],
			"RESTART" => $arParams["RESTART"],
		);

		if(is_array($arCloudParams["arrFILTER"]))
		{
			foreach($arCloudParams["arrFILTER"] as $strFILTER)
			{
				if($strFILTER=="main")
				{
					$arCloudParams["arrFILTER_main"] = $arParams["arrFILTER_main"];
				}
				elseif($strFILTER=="forum" && IsModuleInstalled("forum"))
				{
					$arCloudParams["arrFILTER_forum"] = $arParams["arrFILTER_forum"];
				}
				elseif(strpos($strFILTER,"iblock_")===0)
				{
					foreach($arParams["arrFILTER_".$strFILTER] as $strIBlock)
						$arCloudParams["arrFILTER_".$strFILTER] = $arParams["arrFILTER_".$strFILTER];
				}
				elseif($strFILTER=="blog")
				{
					$arCloudParams["arrFILTER_blog"] = $arParams["arrFILTER_blog"];
				}
				elseif($strFILTER=="socialnetwork")
				{
					$arCloudParams["arrFILTER_socialnetwork"] = $arParams["arrFILTER_socialnetwork"];
				}
			}
		}
		$APPLICATION->IncludeComponent("bitrix:search.tags.cloud", ".default", $arCloudParams, $component, array("HIDE_ICONS" => "Y"));
	}
	?>
	<form action="" method="get">
		<input type="hidden" name="tags" value="<?echo $arResult["REQUEST"]["TAGS"]?>" />
		<input type="hidden" name="how" value="<?echo $arResult["REQUEST"]["HOW"]=="d"? "d": "r"?>" />
		<table width="100%" class="form_style_num1">
			<tbody>
				<tr>
					<td style="width: 100%;">
						<?if($arParams["USE_SUGGEST"] === "Y"):
							if(strlen($arResult["REQUEST"]["~QUERY"]) && is_object($arResult["NAV_RESULT"]))
							{
								$arResult["FILTER_MD5"] = $arResult["NAV_RESULT"]->GetFilterMD5();
								$obSearchSuggest = new CSearchSuggest($arResult["FILTER_MD5"], $arResult["REQUEST"]["~QUERY"]);
								$obSearchSuggest->SetResultCount($arResult["NAV_RESULT"]->NavRecordCount);
							}
							?>
							<?$APPLICATION->IncludeComponent(
								"bitrix:search.suggest.input",
								"",
								array(
									"NAME" => "q",
									"VALUE" => $arResult["REQUEST"]["~QUERY"],
									"INPUT_SIZE" => -1,
									"DROPDOWN_SIZE" => 10,
									"FILTER_MD5" => $arResult["FILTER_MD5"],
								),
								$component, array("HIDE_ICONS" => "Y")
							);?>
						<?else:?>
							<input class="search-query" type="text" name="q" value="<?=$arResult["REQUEST"]["QUERY"]?>" />
						<?endif;?>
					</td>
					<td>
						&nbsp;
					</td>
					<td>
						<input class="btn btn-default btn-llg" type="submit" value="<?echo GetMessage("CT_BSP_GO")?>" />
					</td>
				</tr>
			</tbody>
		</table>

		<noindex>
		<div class="search-advanced">
			<div class="search-advanced-result">
				<?if(is_object($arResult["NAV_RESULT"])):?>
					<div class="search-result"><?echo GetMessage("CT_BSP_FOUND")?>: <?echo $arResult["NAV_RESULT"]->SelectedRowsCount()?></div>
				<?endif;?>
				<?
				$arWhere = array();

				if(!empty($arResult["TAGS_CHAIN"]))
				{
					$tags_chain = '';
					foreach($arResult["TAGS_CHAIN"] as $arTag)
					{
						$tags_chain .= ' '.$arTag["TAG_NAME"].' [<a href="'.$arTag["TAG_WITHOUT"].'" class="search-tags-link" rel="nofollow">x</a>]';
					}

					$arWhere[] = GetMessage("CT_BSP_TAGS").' &mdash; '.$tags_chain;
				}

				if($arParams["SHOW_WHERE"])
				{
					$where = GetMessage("CT_BSP_EVERYWHERE");
					foreach($arResult["DROPDOWN"] as $key=>$value)
						if($arResult["REQUEST"]["WHERE"]==$key)
							$where = $value;

					$arWhere[] = GetMessage("CT_BSP_WHERE").' &mdash; '.$where;
				}

				if($arParams["SHOW_WHEN"])
				{
					if($arResult["REQUEST"]["FROM"] && $arResult["REQUEST"]["TO"])
						$when = GetMessage("CT_BSP_DATES_FROM_TO", array("#FROM#" => $arResult["REQUEST"]["FROM"], "#TO#" => $arResult["REQUEST"]["TO"]));
					elseif($arResult["REQUEST"]["FROM"])
						$when = GetMessage("CT_BSP_DATES_FROM", array("#FROM#" => $arResult["REQUEST"]["FROM"]));
					elseif($arResult["REQUEST"]["TO"])
						$when = GetMessage("CT_BSP_DATES_TO", array("#TO#" => $arResult["REQUEST"]["TO"]));
					else
						$when = GetMessage("CT_BSP_DATES_ALL");

					$arWhere[] = GetMessage("CT_BSP_WHEN").' &mdash; '.$when;
				}

				if(count($arWhere))
					echo GetMessage("CT_BSP_WHERE_LABEL"),': ',implode(", ", $arWhere);
				?>
			</div><?//div class="search-advanced-result"?>
			<?if($arParams["SHOW_WHERE"] || $arParams["SHOW_WHEN"]):?>
				<script>
				function switch_search_params()
				{
					var sp = document.getElementById('search_params');
					if(sp.style.display == 'none')
					{
						disable_search_input(sp, false);
						sp.style.display = 'block'
					}
					else
					{
						disable_search_input(sp, true);
						sp.style.display = 'none';
					}
					return false;
				}

				function disable_search_input(obj, flag)
				{
					var n = obj.childNodes.length;
					for(var j=0; j<n; j++)
					{
						var child = obj.childNodes[j];
						if(child.type)
						{
							switch(child.type.toLowerCase())
							{
								case 'select-one':
								case 'file':
								case 'text':
								case 'textarea':
								case 'hidden':
								case 'radio':
								case 'checkbox':
								case 'select-multiple':
									child.disabled = flag;
									break;
								default:
									break;
							}
						}
						disable_search_input(child, flag);
					}
				}
				</script>
				<div class="search-advanced-filter"><a href="#" onclick="return switch_search_params()"><?echo GetMessage('CT_BSP_ADVANCED_SEARCH')?></a></div>
		</div><?//div class="search-advanced"?>
				<div id="search_params" class="search-filter" style="display:<?echo $arResult["REQUEST"]["FROM"] || $arResult["REQUEST"]["TO"] || $arResult["REQUEST"]["WHERE"]? 'block': 'none'?>">
					<h2><?echo GetMessage('CT_BSP_ADVANCED_SEARCH')?></h2>
					<table class="search-filter" cellspacing="0"><tbody>
						<?if($arParams["SHOW_WHERE"]):?>
						<tr>
							<td class="search-filter-name"><?echo GetMessage("CT_BSP_WHERE")?></td>
							<td class="search-filter-field">
								<select class="select-field" name="where">
									<option value=""><?=GetMessage("CT_BSP_ALL")?></option>
									<?foreach($arResult["DROPDOWN"] as $key=>$value):?>
										<option value="<?=$key?>"<?if($arResult["REQUEST"]["WHERE"]==$key) echo " selected"?>><?=$value?></option>
									<?endforeach?>
								</select>
							</td>
						</tr>
						<?endif;?>
						<?if($arParams["SHOW_WHEN"]):?>
						<tr>
							<td class="search-filter-name"><?echo GetMessage("CT_BSP_WHEN")?></td>
							<td class="search-filter-field">
								<?$APPLICATION->IncludeComponent(
									'bitrix:main.calendar',
									'',
									array(
										'SHOW_INPUT' => 'Y',
										'INPUT_NAME' => 'from',
										'INPUT_VALUE' => $arResult["REQUEST"]["~FROM"],
										'INPUT_NAME_FINISH' => 'to',
										'INPUT_VALUE_FINISH' =>$arResult["REQUEST"]["~TO"],
										'INPUT_ADDITIONAL_ATTR' => 'class="input-field" size="10"',
									),
									null,
									array('HIDE_ICONS' => 'Y')
								);?>
							</td>
						</tr>
						<?endif;?>
						<tr>
							<td class="search-filter-name">&nbsp;</td>
							<td class="search-filter-field"><input class="search-button" value="<?echo GetMessage("CT_BSP_GO")?>" type="submit"></td>
						</tr>
					</tbody></table>
				</div>
			<?else:?>
		</div><?//div class="search-advanced"?>
			<?endif;//if($arParams["SHOW_WHERE"] || $arParams["SHOW_WHEN"])?>
		</noindex>
	</form>

<?if(isset($arResult["REQUEST"]["ORIGINAL_QUERY"])):
	?>
	<div class="search-language-guess">
		<?echo GetMessage("CT_BSP_KEYBOARD_WARNING", array("#query#"=>'<a href="'.$arResult["ORIGINAL_QUERY_URL"].'">'.$arResult["REQUEST"]["ORIGINAL_QUERY"].'</a>'))?>
	</div><br /><?
endif;?>

	<div class="search-result">
	<?if($arResult["REQUEST"]["QUERY"] === false && $arResult["REQUEST"]["TAGS"] === false):?>
	<?elseif($arResult["ERROR_CODE"]!=0):?>
		<p><?=GetMessage("CT_BSP_ERROR")?></p>
		<?ShowError($arResult["ERROR_TEXT"]);?>
		<p><?=GetMessage("CT_BSP_CORRECT_AND_CONTINUE")?></p>
		<br /><br />
		<p><?=GetMessage("CT_BSP_SINTAX")?><br /><b><?=GetMessage("CT_BSP_LOGIC")?></b></p>
		<table border="0" cellpadding="5">
			<tr>
				<td align="center" valign="top"><?=GetMessage("CT_BSP_OPERATOR")?></td><td valign="top"><?=GetMessage("CT_BSP_SYNONIM")?></td>
				<td><?=GetMessage("CT_BSP_DESCRIPTION")?></td>
			</tr>
			<tr>
				<td align="center" valign="top"><?=GetMessage("CT_BSP_AND")?></td><td valign="top">and, &amp;, +</td>
				<td><?=GetMessage("CT_BSP_AND_ALT")?></td>
			</tr>
			<tr>
				<td align="center" valign="top"><?=GetMessage("CT_BSP_OR")?></td><td valign="top">or, |</td>
				<td><?=GetMessage("CT_BSP_OR_ALT")?></td>
			</tr>
			<tr>
				<td align="center" valign="top"><?=GetMessage("CT_BSP_NOT")?></td><td valign="top">not, ~</td>
				<td><?=GetMessage("CT_BSP_NOT_ALT")?></td>
			</tr>
			<tr>
				<td align="center" valign="top">( )</td>
				<td valign="top">&nbsp;</td>
				<td><?=GetMessage("CT_BSP_BRACKETS_ALT")?></td>
			</tr>
		</table>
	<?elseif(count($arResult["SEARCH"])>0):?>
		<?if($arParams["DISPLAY_TOP_PAGER"] != "N") echo $arResult["NAV_STRING"]?>

		<?global $arFtSearch;?>

		<?foreach($arResult["SEARCH"] as $arItem)
		{
			if($arItem['MODULE_ID']=="iblock")$arFtSearch["ID"][]=$arItem['ITEM_ID'];
		}?>

		<?$arParams=array(
			"ACTION_VARIABLE" => "action",
			"ADD_ELEMENT_CHAIN" => "Y",
			"ADD_PROPERTIES_TO_BASKET" => "Y",
			"ADD_SECTIONS_CHAIN" => "Y",
			"AJAX_MODE" => "N",
			"AJAX_OPTION_ADDITIONAL" => "",
			"AJAX_OPTION_HISTORY" => "N",
			"AJAX_OPTION_JUMP" => "N",
			"AJAX_OPTION_STYLE" => "Y",
			"BASKET_URL" => "/personal/basket.php",
			"CACHE_FILTER" => "N",
			"CACHE_GROUPS" => "N",
			"CACHE_TIME" => "36000000",
			"CACHE_TYPE" => "A",
			"DETAIL_ADD_DETAIL_TO_SLIDER" => "N",
			"DETAIL_BACKGROUND_IMAGE" => "-",
			"DETAIL_BRAND_USE" => "N",
			"DETAIL_BROWSER_TITLE" => "-",
			"DETAIL_CHECK_SECTION_ID_VARIABLE" => "N",
			"DETAIL_DETAIL_PICTURE_MODE" => "IMG",
			"DETAIL_DISPLAY_NAME" => "Y",
			"DETAIL_DISPLAY_PREVIEW_TEXT_MODE" => "E",
			"DETAIL_META_DESCRIPTION" => "-",
			"DETAIL_META_KEYWORDS" => "-",
			"DETAIL_PROPERTY_CODE" => array(
				0 => "ALL_STYLE",
				1 => "COUNTRY",
				2 => "KITCH_MAT",
				3 => "KITCH_FORM",
				4 => "KORPMEB_TIP",
				5 => "KORPMEB_MATER",
				6 => "KORPMEB_CVET",
				7 => "TABLE_FORM",
				8 => "TABLE_MAT_STOL",
				9 => "TABLE_CVET",
				10 => "STYL_MAT_NO_OBIV",
				11 => "SYYL_MAT_OBIV",
				12 => "STUL_CVET",
				13 => "SHKAF_KUPE_KOLL_DVER",
				14 => "SHKAF_KUPE_TIP",
				15 => "SHKAF_KUPE_MAT_DVER",
				16 => "SHKAF_KUPE_CVET",
				17 => "DYX_BRAND",
				18 => "DYX_PODKL",
				19 => "DYX_FUNCTION",
				20 => "DYX_OCHISTKA",
				21 => "VP_BRAND",
				22 => "VP_TIP",
				23 => "VP_KOLL_KOMF",
				24 => "VP_FUNCTION",
				25 => "BYTIJ_BRAND",
				26 => "BYTIJ_SETUP",
				27 => "BYTIJ_MESTOVSTR",
				28 => "BYTIJ_WORK",
				29 => "PM_BRAND",
				30 => "PM_TIP_YSTAN",
				31 => "PM_TIP",
				32 => "PM_FUNCTION",
				33 => "MICROWAVE_BRAND",
				34 => "MICROWAVE_RASPOLG",
				35 => "MICROWAVE_FUNCTION",
				36 => "MICROWAVE_POWER",
				37 => "XOLOD_BRAND",
				38 => "XOLOD_RASPOLG",
				39 => "XOLOD_MOR_KAM",
				40 => "XOLOD_FUNCTION",
				41 => "STIRAL_BRAND",
				42 => "STIRAL_RASPOLG",
				43 => "STIRAL_BEL_ZAGR",
				44 => "STIRAL_FUNCTION",
				45 => "PAROV_BRAND",
				46 => "PAROV_KOLL_YAR",
				47 => "PAROV_FUNCTION",
				48 => "FASAD_MAT",
				49 => "STOL_STEN_TIP",
				50 => "STOL_STEN_MAT",
				51 => "FYRN_BRAND",
				52 => "FYRN_CATAL",
				53 => "MOIKA_BRAND",
				54 => "MOIKA_USTANOVKA",
				55 => "MOIKA_KOLL_CHASH",
				56 => "MOIKA_MAT",
				57 => "MOIKA_FORM",
				58 => "SMES_BRAND",
				59 => "SMES_TIP",
				60 => "SMES_MAT",
				61 => "DECOR_CVET",
				62 => "RAZM_2",
				63 => "RAZM_3",
				64 => "RAZM_1",
				65 => "MOIKI_FORM",
				66 => "ALL_COUNTRY",
				67 => "STYLE",
				68 => "FORM",
				69 => "FORM1",
				70 => "BRAND",
				71 => "DUH_BRAND",
				72 => "VAROCH_BRAND",
				73 => "VITAZH_BRAND",
				74 => "POSUD_BRAND",
				75 => "HOLOD_BRAND",
				76 => "VAPE_BRAND",
				77 => "BEL",
				78 => "CATAL",
				79 => "COUNT_CHASH",
				80 => "YAR",
				81 => "KITCHEN_MAT",
				82 => "MAT1",
				83 => "KORPUS_MAT",
				84 => "STOLESH_MAT",
				85 => "MAT_NO_OB",
				86 => "MAT_DORE",
				87 => "MAT_OB",
				88 => "MAT_TABLE",
				89 => "PLACE",
				90 => "MK",
				91 => "POWER",
				92 => "OCH_DUH",
				93 => "WORK",
				94 => "PODKL",
				95 => "SETUP",
				96 => "M_USTANOVKA",
				97 => "FORM_TABLE",
				98 => "DORE",
				99 => "COUNT_COM",
				100 => "FUNCTION",
				101 => "FUNCTION1",
				102 => "FUNCTION2",
				103 => "FUNCTION3",
				104 => "FUNCTION4",
				105 => "FUNCTION5",
				106 => "FUNCTION6",
				107 => "TYPE",
				108 => "TYPE1",
				109 => "TYPE2",
				110 => "TYPE4",
				111 => "TYPE5",
				112 => "TYPE6",
				113 => "TYPE3",
				114 => "",
			),
			"DETAIL_SET_CANONICAL_URL" => "N",
			"DETAIL_USE_COMMENTS" => "N",
			"DETAIL_USE_VOTE_RATING" => "N",
			"DISABLE_INIT_JS_IN_COMPONENT" => "Y",
			"DISPLAY_BOTTOM_PAGER" => "Y",
			"DISPLAY_TOP_PAGER" => "N",
			"ELEMENT_SORT_FIELD" => "sort",
			"ELEMENT_SORT_FIELD2" => "id",
			"ELEMENT_SORT_ORDER" => "asc",
			"ELEMENT_SORT_ORDER2" => "desc",
			"FILE_404" => "",
			"FILTER_FIELD_CODE" => array(
				0 => "",
				1 => "",
			),
			"FILTER_NAME" => "arFtSearch",
			"FILTER_PRICE_CODE" => array(
				0 => "PRICE",
			),
			"FILTER_PROPERTY_CODE" => array(
				0 => "",
				1 => "",
			),
			"FILTER_VIEW_MODE" => "HORIZONTAL",
			"IBLOCK_ID" => "4",
			"IBLOCK_TYPE" => "catalog",
			"INCLUDE_SUBSECTIONS" => "Y",
			"INSTANT_RELOAD" => "Y",
			"LINE_ELEMENT_COUNT" => "3",
			"LINK_ELEMENTS_URL" => "link.php?PARENT_ELEMENT_ID=#ELEMENT_ID#",
			"LINK_IBLOCK_ID" => "",
			"LINK_IBLOCK_TYPE" => "",
			"LINK_PROPERTY_SID" => "",
			"LIST_BROWSER_TITLE" => "-",
			"LIST_META_DESCRIPTION" => "-",
			"LIST_META_KEYWORDS" => "-",
			"LIST_PROPERTY_CODE" => array(
				0 => "PRICE",
				1 => "COUNTRY",
				2 => "STAT",
				3 => "STYLE",
				4 => "FORM",
				5 => "",
			),
			"MESSAGE_404" => "",
			"MESS_BTN_ADD_TO_BASKET" => "В корзину",
			"MESS_BTN_BUY" => "Купить",
			"MESS_BTN_COMPARE" => "Сравнение",
			"MESS_BTN_DETAIL" => "Подробнее",
			"MESS_NOT_AVAILABLE" => "Нет в наличии",
			"PAGER_BASE_LINK_ENABLE" => "N",
			"PAGER_DESC_NUMBERING" => "N",
			"PAGER_DESC_NUMBERING_CACHE_TIME" => "36000",
			"PAGER_SHOW_ALL" => "N",
			"PAGER_SHOW_ALWAYS" => "N",
			"PAGER_TEMPLATE" => "bas.ajax",
			"PAGER_TITLE" => "Товары",
			"PAGE_ELEMENT_COUNT" => "9",
			"PARTIAL_PRODUCT_PROPERTIES" => "N",
			"PRICE_CODE" => array(
			),
			"PRICE_VAT_INCLUDE" => "Y",
			"PRICE_VAT_SHOW_VALUE" => "N",
			"PRODUCT_ID_VARIABLE" => "id",
			"PRODUCT_PROPERTIES" => array(
			),
			"PRODUCT_PROPS_VARIABLE" => "prop",
			"PRODUCT_QUANTITY_VARIABLE" => "",
			"SECTIONS_SHOW_PARENT_NAME" => "Y",
			"SECTIONS_VIEW_MODE" => "LINE",
			"SECTION_BACKGROUND_IMAGE" => "-",
			"SECTION_COUNT_ELEMENTS" => "N",
			"SECTION_ID_VARIABLE" => "SECTION_ID",
			"SECTION_TOP_DEPTH" => "1",
			"SEF_FOLDER" => "/catalog/",
			"SEF_MODE" => "Y",
			"SET_LAST_MODIFIED" => "Y",
			"SET_STATUS_404" => "Y",
			"SET_TITLE" => "Y",
			"SHOW_404" => "Y",
			"SHOW_DEACTIVATED" => "N",
			"SHOW_PRICE_COUNT" => "1",
			"SHOW_TOP_ELEMENTS" => "N",
			"SIDEBAR_DETAIL_SHOW" => "Y",
			"SIDEBAR_PATH" => "",
			"SIDEBAR_SECTION_SHOW" => "Y",
			"TEMPLATE_THEME" => "blue",
			"TOP_ELEMENT_COUNT" => "9",
			"TOP_ELEMENT_SORT_FIELD" => "sort",
			"TOP_ELEMENT_SORT_FIELD2" => "id",
			"TOP_ELEMENT_SORT_ORDER" => "asc",
			"TOP_ELEMENT_SORT_ORDER2" => "desc",
			"TOP_LINE_ELEMENT_COUNT" => "3",
			"TOP_PROPERTY_CODE" => array(
				0 => "",
				1 => "",
			),
			"TOP_VIEW_MODE" => "SECTION",
			"USE_COMPARE" => "N",
			"USE_ELEMENT_COUNTER" => "N",
			"USE_FILTER" => "N",
			"USE_MAIN_ELEMENT_SECTION" => "N",
			"USE_PRICE_COUNT" => "N",
			"USE_PRODUCT_QUANTITY" => "N",
			"USE_STORE" => "N",
			"COMPONENT_TEMPLATE" => "bas",
			"ADD_PICT_PROP" => "-",
			"LABEL_PROP" => "-",
			"DETAIL_STRICT_SECTION_CHECK" => "N",
			"COMPATIBLE_MODE" => "N",
			"SHOW_ALL_WO_SECTION"=>"Y",
			"SEF_URL_TEMPLATES" => array(
				"sections" => "",
				"section" => "#SECTION_CODE#/",
				"element" => "#SECTION_CODE#/#ELEMENT_CODE#/",
				"compare" => "",
				"smart_filter" => "",
			)
		);?>
		<?$APPLICATION->IncludeComponent(
			"bitrix:catalog.section",
			"bas.search.catalog",
			array(
				"BAS_TITLE" => 'Каталог',
				"IBLOCK_TYPE" => $arParams["IBLOCK_TYPE"],
				"IBLOCK_ID" => $arParams["IBLOCK_ID"],
				"ELEMENT_SORT_FIELD" => $sort,
				"ELEMENT_SORT_ORDER" => $order,
				"ELEMENT_SORT_FIELD2" => $arParams["ELEMENT_SORT_FIELD2"],
				"ELEMENT_SORT_ORDER2" => $arParams["ELEMENT_SORT_ORDER2"],
				"PROPERTY_CODE" => $arParams["LIST_PROPERTY_CODE"],
				"META_KEYWORDS" => $arParams["LIST_META_KEYWORDS"],
				"META_DESCRIPTION" => $arParams["LIST_META_DESCRIPTION"],
				"BROWSER_TITLE" => $arParams["LIST_BROWSER_TITLE"],
				"SET_LAST_MODIFIED" => $arParams["SET_LAST_MODIFIED"],
				"INCLUDE_SUBSECTIONS" => $arParams["INCLUDE_SUBSECTIONS"],
				"BASKET_URL" => $arParams["BASKET_URL"],
				"ACTION_VARIABLE" => $arParams["ACTION_VARIABLE"],
				"PRODUCT_ID_VARIABLE" => $arParams["PRODUCT_ID_VARIABLE"],
				"SECTION_ID_VARIABLE" => $arParams["SECTION_ID_VARIABLE"],
				"PRODUCT_QUANTITY_VARIABLE" => $arParams["PRODUCT_QUANTITY_VARIABLE"],
				"PRODUCT_PROPS_VARIABLE" => $arParams["PRODUCT_PROPS_VARIABLE"],
				"FILTER_NAME" => 'arFtSearch',
				"CACHE_TYPE" => $arParams["CACHE_TYPE"],
				"CACHE_TIME" => $arParams["CACHE_TIME"],
				"CACHE_FILTER" => $arParams["CACHE_FILTER"],
				"CACHE_GROUPS" => $arParams["CACHE_GROUPS"],
				"SET_TITLE" => $arParams["SET_TITLE"],
				"MESSAGE_404" => $arParams["MESSAGE_404"],
				"SET_STATUS_404" => $arParams["SET_STATUS_404"],
				"SHOW_404" => $arParams["SHOW_404"],
				"FILE_404" => $arParams["FILE_404"],
				"DISPLAY_COMPARE" => $arParams["USE_COMPARE"],
				"PAGE_ELEMENT_COUNT" => 12,
				"LINE_ELEMENT_COUNT" => $arParams["LINE_ELEMENT_COUNT"],
				"PRICE_CODE" => $arParams["PRICE_CODE"],
				"USE_PRICE_COUNT" => $arParams["USE_PRICE_COUNT"],
				"SHOW_PRICE_COUNT" => $arParams["SHOW_PRICE_COUNT"],

				"PRICE_VAT_INCLUDE" => $arParams["PRICE_VAT_INCLUDE"],
				"USE_PRODUCT_QUANTITY" => $arParams['USE_PRODUCT_QUANTITY'],
				"ADD_PROPERTIES_TO_BASKET" => (isset($arParams["ADD_PROPERTIES_TO_BASKET"]) ? $arParams["ADD_PROPERTIES_TO_BASKET"] : ''),
				"PARTIAL_PRODUCT_PROPERTIES" => (isset($arParams["PARTIAL_PRODUCT_PROPERTIES"]) ? $arParams["PARTIAL_PRODUCT_PROPERTIES"] : ''),
				"PRODUCT_PROPERTIES" => $arParams["PRODUCT_PROPERTIES"],

				"DISPLAY_TOP_PAGER" => $arParams["DISPLAY_TOP_PAGER"],
				"DISPLAY_BOTTOM_PAGER" => $arParams["DISPLAY_BOTTOM_PAGER"],
				"PAGER_TITLE" => $arParams["PAGER_TITLE"],
				"PAGER_SHOW_ALWAYS" => $arParams["PAGER_SHOW_ALWAYS"],
				"PAGER_TEMPLATE" => $arParams["PAGER_TEMPLATE"],
				"PAGER_DESC_NUMBERING" => $arParams["PAGER_DESC_NUMBERING"],
				"PAGER_DESC_NUMBERING_CACHE_TIME" => $arParams["PAGER_DESC_NUMBERING_CACHE_TIME"],
				"PAGER_SHOW_ALL" => $arParams["PAGER_SHOW_ALL"],
				"PAGER_BASE_LINK_ENABLE" => $arParams["PAGER_BASE_LINK_ENABLE"],
				"PAGER_BASE_LINK" => $arParams["PAGER_BASE_LINK"],
				"PAGER_PARAMS_NAME" => $arParams["PAGER_PARAMS_NAME"],

				"OFFERS_CART_PROPERTIES" => $arParams["OFFERS_CART_PROPERTIES"],
				"OFFERS_FIELD_CODE" => $arParams["LIST_OFFERS_FIELD_CODE"],
				"OFFERS_PROPERTY_CODE" => $arParams["LIST_OFFERS_PROPERTY_CODE"],
				"OFFERS_SORT_FIELD" => $arParams["OFFERS_SORT_FIELD"],
				"OFFERS_SORT_ORDER" => $arParams["OFFERS_SORT_ORDER"],
				"OFFERS_SORT_FIELD2" => $arParams["OFFERS_SORT_FIELD2"],
				"OFFERS_SORT_ORDER2" => $arParams["OFFERS_SORT_ORDER2"],
				"OFFERS_LIMIT" => $arParams["LIST_OFFERS_LIMIT"],

				"SECTION_ID" => $arResult["VARIABLES"]["SECTION_ID"],
				"SECTION_CODE" => $arResult["VARIABLES"]["SECTION_CODE"],
				"SECTION_URL" => $arResult["FOLDER"].$arResult["URL_TEMPLATES"]["section"],
				"DETAIL_URL" => $arResult["FOLDER"].$arResult["URL_TEMPLATES"]["element"],
				"USE_MAIN_ELEMENT_SECTION" => $arParams["USE_MAIN_ELEMENT_SECTION"],
				'CONVERT_CURRENCY' => $arParams['CONVERT_CURRENCY'],
				'CURRENCY_ID' => $arParams['CURRENCY_ID'],
				'HIDE_NOT_AVAILABLE' => $arParams["HIDE_NOT_AVAILABLE"],

				'LABEL_PROP' => $arParams['LABEL_PROP'],
				'ADD_PICT_PROP' => $arParams['ADD_PICT_PROP'],
				'PRODUCT_DISPLAY_MODE' => $arParams['PRODUCT_DISPLAY_MODE'],

				'OFFER_ADD_PICT_PROP' => $arParams['OFFER_ADD_PICT_PROP'],
				'OFFER_TREE_PROPS' => $arParams['OFFER_TREE_PROPS'],
				'PRODUCT_SUBSCRIPTION' => $arParams['PRODUCT_SUBSCRIPTION'],
				'SHOW_DISCOUNT_PERCENT' => $arParams['SHOW_DISCOUNT_PERCENT'],
				'SHOW_OLD_PRICE' => $arParams['SHOW_OLD_PRICE'],
				'MESS_BTN_BUY' => $arParams['MESS_BTN_BUY'],
				'MESS_BTN_ADD_TO_BASKET' => $arParams['MESS_BTN_ADD_TO_BASKET'],
				'MESS_BTN_SUBSCRIBE' => $arParams['MESS_BTN_SUBSCRIBE'],
				'MESS_BTN_DETAIL' => $arParams['MESS_BTN_DETAIL'],
				'MESS_NOT_AVAILABLE' => $arParams['MESS_NOT_AVAILABLE'],

				'TEMPLATE_THEME' => (isset($arParams['TEMPLATE_THEME']) ? $arParams['TEMPLATE_THEME'] : ''),
				"ADD_SECTIONS_CHAIN" => "Y",
				'ADD_TO_BASKET_ACTION' => $basketAction,
				'SHOW_CLOSE_POPUP' => isset($arParams['COMMON_SHOW_CLOSE_POPUP']) ? $arParams['COMMON_SHOW_CLOSE_POPUP'] : '',
				'COMPARE_PATH' => $arResult['FOLDER'].$arResult['URL_TEMPLATES']['compare'],
				'BACKGROUND_IMAGE' => (isset($arParams['SECTION_BACKGROUND_IMAGE']) ? $arParams['SECTION_BACKGROUND_IMAGE'] : ''),
				'DISABLE_INIT_JS_IN_COMPONENT' => (isset($arParams['DISABLE_INIT_JS_IN_COMPONENT']) ? $arParams['DISABLE_INIT_JS_IN_COMPONENT'] : ''),
					"SHOW_ALL_WO_SECTION"=>"Y",
			),
			$component
		);?>

		<?$arParams=array(
			"ACTION_VARIABLE" => "action",
			"ADD_ELEMENT_CHAIN" => "Y",
			"ADD_PROPERTIES_TO_BASKET" => "Y",
			"ADD_SECTIONS_CHAIN" => "Y",
			"AJAX_MODE" => "N",
			"AJAX_OPTION_ADDITIONAL" => "",
			"AJAX_OPTION_HISTORY" => "N",
			"AJAX_OPTION_JUMP" => "N",
			"AJAX_OPTION_STYLE" => "Y",
			"BASKET_URL" => "/personal/basket.php",
			"CACHE_FILTER" => "N",
			"CACHE_GROUPS" => "N",
			"CACHE_TIME" => "36000000",
			"CACHE_TYPE" => "A",
			"DETAIL_ADD_DETAIL_TO_SLIDER" => "N",
			"DETAIL_BACKGROUND_IMAGE" => "-",
			"DETAIL_BRAND_USE" => "N",
			"DETAIL_BROWSER_TITLE" => "-",
			"DETAIL_CHECK_SECTION_ID_VARIABLE" => "N",
			"DETAIL_DETAIL_PICTURE_MODE" => "IMG",
			"DETAIL_DISPLAY_NAME" => "Y",
			"DETAIL_DISPLAY_PREVIEW_TEXT_MODE" => "E",
			"DETAIL_META_DESCRIPTION" => "-",
			"DETAIL_META_KEYWORDS" => "-",
			"DETAIL_PROPERTY_CODE" => array(
				0 => "ALL_STYLE",
				1 => "COUNTRY",
				2 => "KITCH_MAT",
				3 => "KITCH_FORM",
				4 => "KORPMEB_TIP",
				5 => "KORPMEB_MATER",
				6 => "KORPMEB_CVET",
				7 => "TABLE_FORM",
				8 => "TABLE_MAT_STOL",
				9 => "TABLE_CVET",
				10 => "STYL_MAT_NO_OBIV",
				11 => "SYYL_MAT_OBIV",
				12 => "STUL_CVET",
				13 => "SHKAF_KUPE_KOLL_DVER",
				14 => "SHKAF_KUPE_TIP",
				15 => "SHKAF_KUPE_MAT_DVER",
				16 => "SHKAF_KUPE_CVET",
				17 => "DYX_BRAND",
				18 => "DYX_PODKL",
				19 => "DYX_FUNCTION",
				20 => "DYX_OCHISTKA",
				21 => "VP_BRAND",
				22 => "VP_TIP",
				23 => "VP_KOLL_KOMF",
				24 => "VP_FUNCTION",
				25 => "BYTIJ_BRAND",
				26 => "BYTIJ_SETUP",
				27 => "BYTIJ_MESTOVSTR",
				28 => "BYTIJ_WORK",
				29 => "PM_BRAND",
				30 => "PM_TIP_YSTAN",
				31 => "PM_TIP",
				32 => "PM_FUNCTION",
				33 => "MICROWAVE_BRAND",
				34 => "MICROWAVE_RASPOLG",
				35 => "MICROWAVE_FUNCTION",
				36 => "MICROWAVE_POWER",
				37 => "XOLOD_BRAND",
				38 => "XOLOD_RASPOLG",
				39 => "XOLOD_MOR_KAM",
				40 => "XOLOD_FUNCTION",
				41 => "STIRAL_BRAND",
				42 => "STIRAL_RASPOLG",
				43 => "STIRAL_BEL_ZAGR",
				44 => "STIRAL_FUNCTION",
				45 => "PAROV_BRAND",
				46 => "PAROV_KOLL_YAR",
				47 => "PAROV_FUNCTION",
				48 => "FASAD_MAT",
				49 => "STOL_STEN_TIP",
				50 => "STOL_STEN_MAT",
				51 => "FYRN_BRAND",
				52 => "FYRN_CATAL",
				53 => "MOIKA_BRAND",
				54 => "MOIKA_USTANOVKA",
				55 => "MOIKA_KOLL_CHASH",
				56 => "MOIKA_MAT",
				57 => "MOIKA_FORM",
				58 => "SMES_BRAND",
				59 => "SMES_TIP",
				60 => "SMES_MAT",
				61 => "DECOR_CVET",
				62 => "RAZM_2",
				63 => "RAZM_3",
				64 => "RAZM_1",
				65 => "MOIKI_FORM",
				66 => "ALL_COUNTRY",
				67 => "STYLE",
				68 => "FORM",
				69 => "FORM1",
				70 => "BRAND",
				71 => "DUH_BRAND",
				72 => "VAROCH_BRAND",
				73 => "VITAZH_BRAND",
				74 => "POSUD_BRAND",
				75 => "HOLOD_BRAND",
				76 => "VAPE_BRAND",
				77 => "BEL",
				78 => "CATAL",
				79 => "COUNT_CHASH",
				80 => "YAR",
				81 => "KITCHEN_MAT",
				82 => "MAT1",
				83 => "KORPUS_MAT",
				84 => "STOLESH_MAT",
				85 => "MAT_NO_OB",
				86 => "MAT_DORE",
				87 => "MAT_OB",
				88 => "MAT_TABLE",
				89 => "PLACE",
				90 => "MK",
				91 => "POWER",
				92 => "OCH_DUH",
				93 => "WORK",
				94 => "PODKL",
				95 => "SETUP",
				96 => "M_USTANOVKA",
				97 => "FORM_TABLE",
				98 => "DORE",
				99 => "COUNT_COM",
				100 => "FUNCTION",
				101 => "FUNCTION1",
				102 => "FUNCTION2",
				103 => "FUNCTION3",
				104 => "FUNCTION4",
				105 => "FUNCTION5",
				106 => "FUNCTION6",
				107 => "TYPE",
				108 => "TYPE1",
				109 => "TYPE2",
				110 => "TYPE4",
				111 => "TYPE5",
				112 => "TYPE6",
				113 => "TYPE3",
				114 => "",
			),
			"DETAIL_SET_CANONICAL_URL" => "N",
			"DETAIL_USE_COMMENTS" => "N",
			"DETAIL_USE_VOTE_RATING" => "N",
			"DISABLE_INIT_JS_IN_COMPONENT" => "Y",
			"DISPLAY_BOTTOM_PAGER" => "Y",
			"DISPLAY_TOP_PAGER" => "N",
			"ELEMENT_SORT_FIELD" => "sort",
			"ELEMENT_SORT_FIELD2" => "id",
			"ELEMENT_SORT_ORDER" => "asc",
			"ELEMENT_SORT_ORDER2" => "desc",
			"FILE_404" => "",
			"FILTER_FIELD_CODE" => array(
				0 => "",
				1 => "",
			),
			"FILTER_NAME" => "arFtSearch",
			"FILTER_PRICE_CODE" => array(
				0 => "PRICE",
			),
			"FILTER_PROPERTY_CODE" => array(
				0 => "",
				1 => "",
			),
			"FILTER_VIEW_MODE" => "HORIZONTAL",
			"IBLOCK_ID" => "20",
			"IBLOCK_TYPE" => "catalog",
			"INCLUDE_SUBSECTIONS" => "Y",
			"INSTANT_RELOAD" => "Y",
			"LINE_ELEMENT_COUNT" => "3",
			"LINK_ELEMENTS_URL" => "link.php?PARENT_ELEMENT_ID=#ELEMENT_ID#",
			"LINK_IBLOCK_ID" => "",
			"LINK_IBLOCK_TYPE" => "",
			"LINK_PROPERTY_SID" => "",
			"LIST_BROWSER_TITLE" => "-",
			"LIST_META_DESCRIPTION" => "-",
			"LIST_META_KEYWORDS" => "-",
			"LIST_PROPERTY_CODE" => array(
				0 => "PRICE",
				1 => "COUNTRY",
				2 => "STAT",
				3 => "STYLE",
				4 => "FORM",
				5 => "",
			),
			"MESSAGE_404" => "",
			"MESS_BTN_ADD_TO_BASKET" => "В корзину",
			"MESS_BTN_BUY" => "Купить",
			"MESS_BTN_COMPARE" => "Сравнение",
			"MESS_BTN_DETAIL" => "Подробнее",
			"MESS_NOT_AVAILABLE" => "Нет в наличии",
			"PAGER_BASE_LINK_ENABLE" => "N",
			"PAGER_DESC_NUMBERING" => "N",
			"PAGER_DESC_NUMBERING_CACHE_TIME" => "36000",
			"PAGER_SHOW_ALL" => "N",
			"PAGER_SHOW_ALWAYS" => "N",
			"PAGER_TEMPLATE" => "bas.ajax",
			"PAGER_TITLE" => "Товары",
			"PAGE_ELEMENT_COUNT" => "9",
			"PARTIAL_PRODUCT_PROPERTIES" => "N",
			"PRICE_CODE" => array(
			),
			"PRICE_VAT_INCLUDE" => "Y",
			"PRICE_VAT_SHOW_VALUE" => "N",
			"PRODUCT_ID_VARIABLE" => "id",
			"PRODUCT_PROPERTIES" => array(
			),
			"PRODUCT_PROPS_VARIABLE" => "prop",
			"PRODUCT_QUANTITY_VARIABLE" => "",
			"SECTIONS_SHOW_PARENT_NAME" => "Y",
			"SECTIONS_VIEW_MODE" => "LINE",
			"SECTION_BACKGROUND_IMAGE" => "-",
			"SECTION_COUNT_ELEMENTS" => "N",
			"SECTION_ID_VARIABLE" => "SECTION_ID",
			"SECTION_TOP_DEPTH" => "1",
			"SEF_FOLDER" => "/catalog/",
			"SEF_MODE" => "Y",
			"SET_LAST_MODIFIED" => "Y",
			"SET_STATUS_404" => "Y",
			"SET_TITLE" => "Y",
			"SHOW_404" => "Y",
			"SHOW_DEACTIVATED" => "N",
			"SHOW_PRICE_COUNT" => "1",
			"SHOW_TOP_ELEMENTS" => "N",
			"SIDEBAR_DETAIL_SHOW" => "Y",
			"SIDEBAR_PATH" => "",
			"SIDEBAR_SECTION_SHOW" => "Y",
			"TEMPLATE_THEME" => "blue",
			"TOP_ELEMENT_COUNT" => "9",
			"TOP_ELEMENT_SORT_FIELD" => "sort",
			"TOP_ELEMENT_SORT_FIELD2" => "id",
			"TOP_ELEMENT_SORT_ORDER" => "asc",
			"TOP_ELEMENT_SORT_ORDER2" => "desc",
			"TOP_LINE_ELEMENT_COUNT" => "3",
			"TOP_PROPERTY_CODE" => array(
				0 => "",
				1 => "",
			),
			"TOP_VIEW_MODE" => "SECTION",
			"USE_COMPARE" => "N",
			"USE_ELEMENT_COUNTER" => "N",
			"USE_FILTER" => "N",
			"USE_MAIN_ELEMENT_SECTION" => "N",
			"USE_PRICE_COUNT" => "N",
			"USE_PRODUCT_QUANTITY" => "N",
			"USE_STORE" => "N",
			"COMPONENT_TEMPLATE" => "bas",
			"ADD_PICT_PROP" => "-",
			"LABEL_PROP" => "-",
			"DETAIL_STRICT_SECTION_CHECK" => "N",
			"COMPATIBLE_MODE" => "N",
			"SHOW_ALL_WO_SECTION"=>"Y",
			"SEF_URL_TEMPLATES" => array(
				"sections" => "",
				"section" => "#SECTION_CODE#/",
				"element" => "#SECTION_CODE#/#ELEMENT_CODE#/",
				"compare" => "",
				"smart_filter" => "",
			)
		);?>
		<?$APPLICATION->IncludeComponent(
			"bitrix:catalog.section",
			"bas.search.catalog",
			array(
                "NO_PRICE" => true,
				"BAS_TITLE" => 'Наши работы',
				"IBLOCK_TYPE" => $arParams["IBLOCK_TYPE"],
				"IBLOCK_ID" => $arParams["IBLOCK_ID"],
				"ELEMENT_SORT_FIELD" => $sort,
				"ELEMENT_SORT_ORDER" => $order,
				"ELEMENT_SORT_FIELD2" => $arParams["ELEMENT_SORT_FIELD2"],
				"ELEMENT_SORT_ORDER2" => $arParams["ELEMENT_SORT_ORDER2"],
				"PROPERTY_CODE" => $arParams["LIST_PROPERTY_CODE"],
				"META_KEYWORDS" => $arParams["LIST_META_KEYWORDS"],
				"META_DESCRIPTION" => $arParams["LIST_META_DESCRIPTION"],
				"BROWSER_TITLE" => $arParams["LIST_BROWSER_TITLE"],
				"SET_LAST_MODIFIED" => $arParams["SET_LAST_MODIFIED"],
				"INCLUDE_SUBSECTIONS" => $arParams["INCLUDE_SUBSECTIONS"],
				"BASKET_URL" => $arParams["BASKET_URL"],
				"ACTION_VARIABLE" => $arParams["ACTION_VARIABLE"],
				"PRODUCT_ID_VARIABLE" => $arParams["PRODUCT_ID_VARIABLE"],
				"SECTION_ID_VARIABLE" => $arParams["SECTION_ID_VARIABLE"],
				"PRODUCT_QUANTITY_VARIABLE" => $arParams["PRODUCT_QUANTITY_VARIABLE"],
				"PRODUCT_PROPS_VARIABLE" => $arParams["PRODUCT_PROPS_VARIABLE"],
				"FILTER_NAME" => 'arFtSearch',
				"CACHE_TYPE" => $arParams["CACHE_TYPE"],
				"CACHE_TIME" => $arParams["CACHE_TIME"],
				"CACHE_FILTER" => $arParams["CACHE_FILTER"],
				"CACHE_GROUPS" => $arParams["CACHE_GROUPS"],
				"SET_TITLE" => $arParams["SET_TITLE"],
				"MESSAGE_404" => $arParams["MESSAGE_404"],
				"SET_STATUS_404" => $arParams["SET_STATUS_404"],
				"SHOW_404" => $arParams["SHOW_404"],
				"FILE_404" => $arParams["FILE_404"],
				"DISPLAY_COMPARE" => $arParams["USE_COMPARE"],
				"PAGE_ELEMENT_COUNT" => 12,
				"LINE_ELEMENT_COUNT" => $arParams["LINE_ELEMENT_COUNT"],
				"PRICE_CODE" => $arParams["PRICE_CODE"],
				"USE_PRICE_COUNT" => $arParams["USE_PRICE_COUNT"],
				"SHOW_PRICE_COUNT" => $arParams["SHOW_PRICE_COUNT"],

				"PRICE_VAT_INCLUDE" => $arParams["PRICE_VAT_INCLUDE"],
				"USE_PRODUCT_QUANTITY" => $arParams['USE_PRODUCT_QUANTITY'],
				"ADD_PROPERTIES_TO_BASKET" => (isset($arParams["ADD_PROPERTIES_TO_BASKET"]) ? $arParams["ADD_PROPERTIES_TO_BASKET"] : ''),
				"PARTIAL_PRODUCT_PROPERTIES" => (isset($arParams["PARTIAL_PRODUCT_PROPERTIES"]) ? $arParams["PARTIAL_PRODUCT_PROPERTIES"] : ''),
				"PRODUCT_PROPERTIES" => $arParams["PRODUCT_PROPERTIES"],

				"DISPLAY_TOP_PAGER" => $arParams["DISPLAY_TOP_PAGER"],
				"DISPLAY_BOTTOM_PAGER" => $arParams["DISPLAY_BOTTOM_PAGER"],
				"PAGER_TITLE" => $arParams["PAGER_TITLE"],
				"PAGER_SHOW_ALWAYS" => $arParams["PAGER_SHOW_ALWAYS"],
				"PAGER_TEMPLATE" => $arParams["PAGER_TEMPLATE"],
				"PAGER_DESC_NUMBERING" => $arParams["PAGER_DESC_NUMBERING"],
				"PAGER_DESC_NUMBERING_CACHE_TIME" => $arParams["PAGER_DESC_NUMBERING_CACHE_TIME"],
				"PAGER_SHOW_ALL" => $arParams["PAGER_SHOW_ALL"],
				"PAGER_BASE_LINK_ENABLE" => $arParams["PAGER_BASE_LINK_ENABLE"],
				"PAGER_BASE_LINK" => $arParams["PAGER_BASE_LINK"],
				"PAGER_PARAMS_NAME" => $arParams["PAGER_PARAMS_NAME"],

				"OFFERS_CART_PROPERTIES" => $arParams["OFFERS_CART_PROPERTIES"],
				"OFFERS_FIELD_CODE" => $arParams["LIST_OFFERS_FIELD_CODE"],
				"OFFERS_PROPERTY_CODE" => $arParams["LIST_OFFERS_PROPERTY_CODE"],
				"OFFERS_SORT_FIELD" => $arParams["OFFERS_SORT_FIELD"],
				"OFFERS_SORT_ORDER" => $arParams["OFFERS_SORT_ORDER"],
				"OFFERS_SORT_FIELD2" => $arParams["OFFERS_SORT_FIELD2"],
				"OFFERS_SORT_ORDER2" => $arParams["OFFERS_SORT_ORDER2"],
				"OFFERS_LIMIT" => $arParams["LIST_OFFERS_LIMIT"],

				"SECTION_ID" => $arResult["VARIABLES"]["SECTION_ID"],
				"SECTION_CODE" => $arResult["VARIABLES"]["SECTION_CODE"],
				"SECTION_URL" => $arResult["FOLDER"].$arResult["URL_TEMPLATES"]["section"],
				"DETAIL_URL" => $arResult["FOLDER"].$arResult["URL_TEMPLATES"]["element"],
				"USE_MAIN_ELEMENT_SECTION" => $arParams["USE_MAIN_ELEMENT_SECTION"],
				'CONVERT_CURRENCY' => $arParams['CONVERT_CURRENCY'],
				'CURRENCY_ID' => $arParams['CURRENCY_ID'],
				'HIDE_NOT_AVAILABLE' => $arParams["HIDE_NOT_AVAILABLE"],

				'LABEL_PROP' => $arParams['LABEL_PROP'],
				'ADD_PICT_PROP' => $arParams['ADD_PICT_PROP'],
				'PRODUCT_DISPLAY_MODE' => $arParams['PRODUCT_DISPLAY_MODE'],

				'OFFER_ADD_PICT_PROP' => $arParams['OFFER_ADD_PICT_PROP'],
				'OFFER_TREE_PROPS' => $arParams['OFFER_TREE_PROPS'],
				'PRODUCT_SUBSCRIPTION' => $arParams['PRODUCT_SUBSCRIPTION'],
				'SHOW_DISCOUNT_PERCENT' => $arParams['SHOW_DISCOUNT_PERCENT'],
				'SHOW_OLD_PRICE' => $arParams['SHOW_OLD_PRICE'],
				'MESS_BTN_BUY' => $arParams['MESS_BTN_BUY'],
				'MESS_BTN_ADD_TO_BASKET' => $arParams['MESS_BTN_ADD_TO_BASKET'],
				'MESS_BTN_SUBSCRIBE' => $arParams['MESS_BTN_SUBSCRIBE'],
				'MESS_BTN_DETAIL' => $arParams['MESS_BTN_DETAIL'],
				'MESS_NOT_AVAILABLE' => $arParams['MESS_NOT_AVAILABLE'],

				'TEMPLATE_THEME' => (isset($arParams['TEMPLATE_THEME']) ? $arParams['TEMPLATE_THEME'] : ''),
				"ADD_SECTIONS_CHAIN" => "Y",
				'ADD_TO_BASKET_ACTION' => $basketAction,
				'SHOW_CLOSE_POPUP' => isset($arParams['COMMON_SHOW_CLOSE_POPUP']) ? $arParams['COMMON_SHOW_CLOSE_POPUP'] : '',
				'COMPARE_PATH' => $arResult['FOLDER'].$arResult['URL_TEMPLATES']['compare'],
				'BACKGROUND_IMAGE' => (isset($arParams['SECTION_BACKGROUND_IMAGE']) ? $arParams['SECTION_BACKGROUND_IMAGE'] : ''),
				'DISABLE_INIT_JS_IN_COMPONENT' => (isset($arParams['DISABLE_INIT_JS_IN_COMPONENT']) ? $arParams['DISABLE_INIT_JS_IN_COMPONENT'] : ''),
					"SHOW_ALL_WO_SECTION"=>"Y",
			),
			$component
		);?>

		<?if ($arParams["DISPLAY_BOTTOM_PAGER"] != "N") echo $arResult["NAV_STRING"]?>

	<?else:?>
		<div class="alert alert-danger">
			<?=GetMessage("CT_BSP_NOTHING_TO_FOUND")?>
		</div>
	<?endif;?>

	</div>
</div>