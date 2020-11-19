<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>

<?global $$APPLICATION;?>

<?$APPLICATION->IncludeComponent(
	"bitrix:form.result.new", 
	"bas.num3", 
	array(
		"CACHE_TIME" => "3600",
		"CACHE_TYPE" => "A",
		"CHAIN_ITEM_LINK" => "",
		"CHAIN_ITEM_TEXT" => "",
		"EDIT_URL" => "",
		"IGNORE_CUSTOM_TEMPLATE" => "N",
		"LIST_URL" => "",
		"SEF_FOLDER" => $APPLICATION->GetCurPage(false),
		"SEF_MODE" => "Y",
		"SUCCESS_URL" => $APPLICATION->GetCurPage(false) . "?bas_ok=Y",
		"USE_EXTENDED_ERRORS" => "N",
		"WEB_FORM_ID" => "1",
		"COMPONENT_TEMPLATE" => "bas.num1",
		"BAS_BTN_NAME" => "Участвовать",
		"BAS_FORM_NAME" => $arResult['NAME'],
		"BAS_FORM_TITLE" => "Для участия в акции заполните форму:"
	),
	false
);?>