<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();

if (CModule::IncludeModule("iblock") && isset($_REQUEST['ID_ELM']))
{ 
	$res = CIBlockElement::GetByID(intval($_REQUEST['ID_ELM']));

	if ($res = $res->GetNext()) $arResult['BAS_TOVAR_NAME'] = $res['NAME'];
}?>