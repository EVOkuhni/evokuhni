<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();

if (CModule::IncludeModule('highloadblock')) {

	$arHLBlock = Bitrix\Highloadblock\HighloadBlockTable::getById(3)->fetch();
	$obEntity = Bitrix\Highloadblock\HighloadBlockTable::compileEntity($arHLBlock);
	$strEntityDataClass = $obEntity->getDataClass();

	$rsData = $strEntityDataClass::getList(
		array(
			'select' => array('UF_XML_ID', 'UF_FILE')
		)
	);

	while ($arItem = $rsData->Fetch()) {

		$arResult['COUNTRY'][$arItem['UF_XML_ID']] = CFile::GetPath($arItem['UF_FILE']);
	}
}

if (CModule::IncludeModule("iblock"))
{ 
	$arFilter = Array(
		'IBLOCK_ID'	=> $arResult['ORIGINAL_PARAMETERS']['IBLOCK_ID'],
		'ID'		=> $arResult['NAV_RESULT']->arSectionContext['ID']
	);

	$res = CIBlockSection::GetList(Array(), $arFilter, false, Array('UF_HIDE_BAN', 'UF_CENTER_PICT', 'UF_SHOW_BTN_NUM1', 'UF_SHOW_BTN_NUM2', 'UF_SHOW_BTN_NUM3', 'UF_ZA', 'UF_BANNER_CART', 'UF_SHOW_BTN_ONE', 'UF_SHOW_FROM'));

	if ($res = $res->GetNext())
	{
		$arResult['SECTION']['UF_HIDE_BAN'] = $res['UF_HIDE_BAN'];
		$arResult['SECTION']['UF_CENTER_PICT'] = $res['UF_CENTER_PICT'];
		$arResult['SECTION']['UF_SHOW_BTN_NUM1'] = $res['UF_SHOW_BTN_NUM1'];
		$arResult['SECTION']['UF_SHOW_BTN_NUM2'] = $res['UF_SHOW_BTN_NUM2'];
		$arResult['SECTION']['UF_SHOW_BTN_NUM3'] = $res['UF_SHOW_BTN_NUM3'];
		$arResult['SECTION']['UF_ZA'] = $res['UF_ZA'];
		$arResult['SECTION']['UF_BANNER_CART'] = $res['UF_BANNER_CART'];
		$arResult['SECTION']['UF_SHOW_BTN_ONE'] = $res['UF_SHOW_BTN_ONE'];
		$arResult['SECTION']['UF_SHOW_FROM'] = $res['UF_SHOW_FROM'];
	}
}


$arTmpItems = array_flip(array_reverse($_SESSION['PRODUCTS_SEEN']));

foreach ($arResult['ITEMS'] as $arItem)
{
    $arTmpItems[$arItem['ID']] = $arItem;
}

foreach ($arTmpItems as $k => $v)
{
    if(!is_array($v))
        unset($arTmpItems[$k]);
}

$arResult['ITEMS'] = $arTmpItems;