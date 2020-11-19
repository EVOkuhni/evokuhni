<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();

use Bitrix\Main\Loader;
use Bitrix\Main\ModuleManager;


$this->setFrameMode(true);
 
if ($arResult["VARIABLES"]["SECTION_CODE"]=="komplektuyushchie"
	|| $arResult["VARIABLES"]["SECTION_CODE"]=="tekhnika"
	|| $arResult["VARIABLES"]["SECTION_CODE"]=="mebel"
	|| $arResult["VARIABLES"]["SECTION_CODE"]=="stoly-i-stulya"
	|| $arResult["VARIABLES"]["SECTION_CODE"]=="stoleshnitsy"
	|| $arResult["VARIABLES"]["SECTION_CODE"]=="furnitura-i-aksessuary"){
	
	include "sections.php";
	return;
}

$arFilter = array(
	"IBLOCK_ID" => $arParams["IBLOCK_ID"],
	"ACTIVE" => "Y",
	"GLOBAL_ACTIVE" => "Y",
);
 
if (0 < intval($arResult["VARIABLES"]["SECTION_ID"]))
	$arFilter["ID"] = $arResult["VARIABLES"]["SECTION_ID"];
elseif ('' != $arResult["VARIABLES"]["SECTION_CODE"])
	$arFilter["=CODE"] = $arResult["VARIABLES"]["SECTION_CODE"];

$obCache = new CPHPCache();
if ($obCache->InitCache(36000, serialize($arFilter), "/iblock/catalog"))
{
	$arCurSection = $obCache->GetVars();
}
elseif ($obCache->StartDataCache())
{
	$arCurSection = array();

	if (Loader::includeModule("iblock"))
	{
		$dbRes = CIBlockSection::GetList(array(), $arFilter, false, array("ID", "UF_SORT_BY", "UF_SORT_ORDER"));

		if(defined("BX_COMP_MANAGED_CACHE"))
		{
			global $CACHE_MANAGER;
			$CACHE_MANAGER->StartTagCache("/iblock/catalog");

			if ($arCurSection = $dbRes->Fetch())
				$CACHE_MANAGER->RegisterTag("iblock_id_".$arParams["IBLOCK_ID"]);

			$CACHE_MANAGER->EndTagCache();
		}
		else
		{
			if(!$arCurSection = $dbRes->Fetch())
				$arCurSection = array();
		}
	}
	$obCache->EndDataCache($arCurSection);
}

if (!isset($arCurSection)) $arCurSection = array();?>
 
<div class="container"> 
	<h1><?$APPLICATION->ShowTitle(false)?></h1>
</div>
<div class="container">
    <div class="position_relative">
        <?$APPLICATION->IncludeComponent(
            "bitrix:catalog.smart.filter",
            "",
            array(
                "HIDE_PRICE" => $arParams["HIDE_PRICE"],
                "IBLOCK_TYPE" => $arParams["IBLOCK_TYPE"],
                "IBLOCK_ID" => $arParams["IBLOCK_ID"],
                "SECTION_ID" => $arCurSection['ID'],
                "FILTER_NAME" => 'basFilter',
                "PRICE_CODE" => $arParams["PRICE_CODE"],
                "CACHE_TYPE" => $arParams["CACHE_TYPE"],
                "CACHE_TIME" => $arParams["CACHE_TIME"],
                "CACHE_GROUPS" => $arParams["CACHE_GROUPS"],
                "SAVE_IN_SESSION" => "N",
                "FILTER_VIEW_MODE" => 'HORIZONTAL',
                "XML_EXPORT" => "Y",
                "SECTION_TITLE" => "NAME",
                "SECTION_DESCRIPTION" => "DESCRIPTION",
                'HIDE_NOT_AVAILABLE' => $arParams["HIDE_NOT_AVAILABLE"],
                "TEMPLATE_THEME" => $arParams["TEMPLATE_THEME"],
                'CONVERT_CURRENCY' => $arParams['CONVERT_CURRENCY'],
                'CURRENCY_ID' => $arParams['CURRENCY_ID'],
                "SEF_MODE" => $arParams["SEF_MODE"],
                "SEF_RULE" => $arResult["FOLDER"].$arResult["URL_TEMPLATES"]["smart_filter"],
                "SMART_FILTER_PATH" => $arResult["VARIABLES"]["SMART_FILTER_PATH"],
                "PAGER_PARAMS_NAME" => $arParams["PAGER_PARAMS_NAME"],
                "INSTANT_RELOAD" => $arParams["INSTANT_RELOAD"],
            ),
            $component,
            array('HIDE_ICONS' => 'Y')
        );?>
        <?$APPLICATION->IncludeComponent(
           "sotbit:seo.meta",
           ".default",
           Array(
                "FILTER_NAME" => 'basFilter',
                "SECTION_ID" => $arCurSection['ID'],
                "CACHE_TYPE" => 'N',
                "CACHE_TIME" => $arParams["CACHE_TIME"],
           )
        );?>
        <?php
        //Компонент выше не выдает мета инфо, неясно почему
        CustomSotbitHandler::handle();
        ?>
    </div>
    <div class="position-relative">
        <?
        $arAvailableSort = array("PROPERTY_PRICE", "SORT", "CREATED");
        $arAvailableOrder = array("ASC", "DESC");
        $arAvailableTitle = array(
            "PROPERTY_PRICE_ASC" => 'Сначала дешёвые',
            "PROPERTY_PRICE_DESC" => 'Сначала дорогие',
            "CREATED_ASC" => 'Сначала новые',
            "CREATED_DESC" => 'Сначала старые',
        );


        if (isset($_GET['sort'])) $sort = $_REQUEST['sort'];
        else $sort = 'SORT';
        //else $sort = $_SESSION['bas_' . $arResult['VARIABLES']['SECTION_CODE'] . '_sort'];

        if (isset($_GET['order'])) $order = $_REQUEST['order'];
        else $order = 'ASC';
        //else $order = $_SESSION['bas_' . $arResult['VARIABLES']['SECTION_CODE'] . '_order'];

        if (!in_array($sort, $arAvailableSort)) $sort = 'SORT';
        if (!in_array($order, $arAvailableOrder)) $order = 'ASC';

        $_SESSION['bas_' . $arResult['VARIABLES']['SECTION_CODE'] . '_sort'] = $sort;
        $_SESSION['bas_' . $arResult['VARIABLES']['SECTION_CODE'] . '_order'] = $order;

        $toUrl = ($order === 'DESC') ? "ASC" : "DESC"
        ?>

        <div class="bas_catalog_sort text-center">
            <a class="<?=($sort === 'PROPERTY_PRICE') ? 'active' : ''?>" href="?sort=PROPERTY_PRICE&order=<?=$toUrl?>"><?=$arAvailableTitle["PROPERTY_PRICE_" . $toUrl]?></a>

        <?if($arParams['IBLOCK_ID'] == 20):?> 

            <a class="<?=($sort === 'CREATED') ? 'active' : ''?>" href="?sort=CREATED&order=<?=$toUrl?>"><?=$arAvailableTitle["CREATED_" . $toUrl]?></a>

        <?endif?>

        </div>
    </div>
</div>
<div id="bas_ajax_block">

	<?if ($_REQUEST['BAS_AJAX_CALL']) $APPLICATION->RestartBuffer();?>

    <?php
    $params_after_filter = CustomCatalogHelper::prepareParamsAfterFilter($arParams['IBLOCK_ID']);
    ?>

	<?$APPLICATION->IncludeComponent(
		"bitrix:catalog.section",
		"",
		array(
            'BOTTOM_SLIDER_LINK' => $params_after_filter['BOTTOM_SLIDER_LINK'],
            'OUR_WORK_ITEMS' => $params_after_filter['OUR_WORK_ITEMS'],
            'BOTTOM_SLIDER_FILTER' => $params_after_filter['BOTTOM_SLIDER_FILTER'],
            "AJAX_MODE" => 'Y',
            "AJAX_OPTION_JUMP" => 'Y',
            "AJAX_OPTION_HISTORY" => 'Y',
            "AJAX_OPTION_STYLE" => 'N',
            "HIDE_PRICE" => $arParams["HIDE_PRICE"],
			"IBLOCK_TYPE" => $arParams["IBLOCK_TYPE"],
			"IBLOCK_ID" => $arParams["IBLOCK_ID"],
			"ELEMENT_SORT_FIELD" => $sort,
			"ELEMENT_SORT_ORDER" => $order,
			"ELEMENT_SORT_FIELD2" => 'NAME',
			"ELEMENT_SORT_ORDER2" => 'ASC',
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
			"FILTER_NAME" => 'basFilter',
			"CACHE_TYPE" => 'N',
			"CACHE_TIME" => $arParams["CACHE_TIME"],
			"CACHE_FILTER" => $arParams["CACHE_FILTER"],
			"CACHE_GROUPS" => $arParams["CACHE_GROUPS"],
			"SET_TITLE" => $arParams["SET_TITLE"],
			"MESSAGE_404" => $arParams["MESSAGE_404"],
			"SET_STATUS_404" => $arParams["SET_STATUS_404"],
			"SHOW_404" => $arParams["SHOW_404"],
			"FILE_404" => $arParams["FILE_404"],
			"DISPLAY_COMPARE" => $arParams["USE_COMPARE"],
			"PAGE_ELEMENT_COUNT" => $params_after_filter['OUR_WORK_ITEMS'] ? $arParams["PAGE_ELEMENT_COUNT"] - count($params_after_filter['OUR_WORK_ITEMS']) : $arParams["PAGE_ELEMENT_COUNT"],
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
			'DISABLE_INIT_JS_IN_COMPONENT' => (isset($arParams['DISABLE_INIT_JS_IN_COMPONENT']) ? $arParams['DISABLE_INIT_JS_IN_COMPONENT'] : '')
		),
		$component
	);?>

    <?
         global $sotbitSeoMetaTitle;
         global $sotbitSeoMetaKeywords;
         global $sotbitSeoMetaDescription;
         global $sotbitSeoMetaBreadcrumbTitle;
         global $sotbitSeoMetaH1;

         global $sotbitFilterSelected;

         if(empty($sotbitSeoMetaH1) && !empty($sotbitFilterSelected)
             && (strpos($_SERVER['REQUEST_URI'] , '/catalog/kukhni/') === 0 || strpos($_SERVER['REQUEST_URI'] , '/our-works/') === 0))
         {
             if(strpos($_SERVER['REQUEST_URI'] , '/our-works/') === 0)
                $sotbitSeoMetaH1 = filterDataToTitle($sotbitFilterSelected, $APPLICATION->GetTitle());
             else
                $sotbitSeoMetaH1 = filterDataToTitle($sotbitFilterSelected);

             $sotbitSeoMetaTitle = $sotbitSeoMetaH1 . ' на заказ в Москве от "EVO Кухни"';
             $sotbitSeoMetaDescription = $sotbitSeoMetaH1 . ' - заказать от производителя с доставкой по Москве и МО. Заказывая кухню от "EVO Кухни" вы гарантированно получаете качественную продукцию по оптимальной цене!';
         }

         if(!empty($sotbitSeoMetaH1))
         {
            if(empty($sotbitSeoMetaBreadcrumbTitle))
                $APPLICATION->AddChainItem($sotbitSeoMetaH1);

            if(!empty($sotbitSeoMetaKeywords))
                $APPLICATION->SetTitle($sotbitSeoMetaKeywords);
            else
                $APPLICATION->SetTitle($sotbitSeoMetaH1);
         }
         if(!empty($sotbitSeoMetaTitle))
         {
          $APPLICATION->SetPageProperty("title", $sotbitSeoMetaTitle);
         }
         if(!empty($sotbitSeoMetaKeywords))
         {
          $APPLICATION->SetPageProperty("keywords", $sotbitSeoMetaKeywords);
         }
         if(!empty($sotbitSeoMetaDescription))
         {
          $APPLICATION->SetPageProperty("description", $sotbitSeoMetaDescription);
         }
         if(!empty($sotbitSeoMetaBreadcrumbTitle) ) {
          $APPLICATION->AddChainItem($sotbitSeoMetaBreadcrumbTitle);
         }
        ?>

	<?if ($_REQUEST['BAS_AJAX_CALL']) die();?>

</div>