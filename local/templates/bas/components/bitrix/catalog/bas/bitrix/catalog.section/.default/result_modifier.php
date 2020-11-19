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

    $res = CIBlockSection::GetList(
        Array(),
        $arFilter,
        false,
        Array(
            'UF_HIDE_BAN',
            'UF_CENTER_PICT',
            'UF_SHOW_BTN_NUM1',
            'UF_SHOW_BTN_NUM2',
            'UF_SHOW_BTN_NUM3',
            'UF_ZA',
            'UF_BANNER_CART',
            'UF_SHOW_BTN_ONE',
            'UF_SHOW_FROM',
            'UF_HIDE_PRICE',
        )
    );

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
		$arResult['SECTION']['UF_HIDE_PRICE'] = $res['UF_HIDE_PRICE'];
	}
}

if($arParams['OUR_WORK_ITEMS'])
{
    foreach ($arParams['OUR_WORK_ITEMS'] as $k => $item)
    {
        $offset = ((5 * ($k + 1)) - 1) + $k;
        
        if(count($arResult['ITEMS']) <= $offset) continue;

        $arResult['OUR_WORK_ITEM'] = $item;
        array_splice( $arResult['ITEMS'], ((5 * ($k + 1)) - 1) + $k, 0, array($arResult['OUR_WORK_ITEM']) );
    }
}

$arResult['BOTTOM_SLIDER_SHOW_ALL_LINK'] = $arParams['BOTTOM_SLIDER_LINK'];
$arResult['BOTTOM_SLIDER_FILTER'] = $arParams['BOTTOM_SLIDER_FILTER'];