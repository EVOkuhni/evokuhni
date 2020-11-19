<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();

if (CModule::IncludeModule('highloadblock'))
{
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
	$sectionsId=array();

	foreach($arResult['ITEMS'] as $arItem)
    {
		if(intval($arItem['IBLOCK_SECTION_ID'])>0)$sectionsId[]=$arItem['IBLOCK_SECTION_ID'];
	}

	if (count($sectionsId)>0)
    {
		$arFilter = Array(
            'IBLOCK_ID'	=> $arResult['ORIGINAL_PARAMETERS']['IBLOCK_ID'],
            'ID'		=> $sectionsId
        );

        $arSelect = Array('UF_HIDE_BAN', 'UF_SHOW_BTN_NUM1', 'UF_SHOW_BTN_NUM2', 'UF_SHOW_BTN_NUM3', 'UF_ZA', 'UF_BANNER_CART', 'UF_SHOW_BTN_ONE','UF_SHOW_FROM');

		$res = CIBlockSection::GetList(Array(), $arFilter, false, $arSelect);

        $sections=array();

		while ($item = $res->GetNext())
        {
			$sections[$item['ID']]=$item;
		}

		foreach($arResult['ITEMS'] as &$arItem)
        {
			$arItem['SECTION_DATA'] = $sections[$arItem['IBLOCK_SECTION_ID']];
		}

		unset($arItem);
	}
}?>