<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();

$ids = array_slice(array_reverse($_SESSION['PRODUCTS_SEEN']), 0, count($_SESSION['PRODUCTS_SEEN'])?count($_SESSION['PRODUCTS_SEEN']):10);

$q = CIBlockElement::GetList(array(),
    array('IBLOCK_ID' => array(4, 20), 'ID' => $ids),
    false,
    false
);

$arResult['ITEMS'] = array();
while ($res = $q->GetNextElement())
{
    $item = $res->GetFields();
    $item['PROPERTIES'] = $res->GetProperties();
    $arResult['ITEMS'][] = $item;
}

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
	$sectionsId=array();
	foreach($arResult['ITEMS'] as $arItem){		
		if(intval($arItem['IBLOCK_SECTION_ID'])>0)$sectionsId[]=$arItem['IBLOCK_SECTION_ID'];
	}
	
	
	if(count($sectionsId)>0){
		$arFilter = Array(
				'IBLOCK_ID'	=> $arResult['ORIGINAL_PARAMETERS']['IBLOCK_ID'],
				'ID'		=> $sectionsId
				);
		
		$res = CIBlockSection::GetList(Array(), $arFilter, false, Array('UF_HIDE_BAN', 'UF_SHOW_BTN_NUM1', 'UF_SHOW_BTN_NUM2', 'UF_SHOW_BTN_NUM3', 'UF_ZA', 'UF_BANNER_CART', 'UF_SHOW_BTN_ONE'));
		$sections=array();
		while ($item = $res->GetNext()){
			$sections[$item['ID']]=$item;
		}
		
		foreach($arResult['ITEMS'] as &$arItem){
			$arItem['SECTION_DATA']=$sections[$arItem['IBLOCK_SECTION_ID']];
			
		}
		unset($arItem);
		
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