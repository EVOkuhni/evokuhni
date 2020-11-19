<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();

foreach($arResult["ITEMS"] as $intKey => &$arItem)
{
	$arTemp = Array();

	if(isset($arItem['DISPLAY_PROPERTIES']['MORE_PICT']['FILE_VALUE']['ID']))
    {
        $arItem['DISPLAY_PROPERTIES']['MORE_PICT']['FILE_VALUE'] = array($arItem['DISPLAY_PROPERTIES']['MORE_PICT']['FILE_VALUE']);
    }

	foreach($arItem['DISPLAY_PROPERTIES']['MORE_PICT']['FILE_VALUE'] as $intK => $arV)
	{
		$file = CFile::ResizeImageGet($arV, array('width' => 100, 'height' => 75), BX_RESIZE_IMAGE_EXACT);

		$arV['SRC_SMALL'] = $file['src'];

		if ($intK == 0) $arResult["ITEMS"][$intKey]['DISPLAY_PROPERTIES']['MORE_PICT']['BAS_FIRST'] = $arV;
		else $arTemp[] = $arV;
	}

	$arResult["ITEMS"][$intKey]['DISPLAY_PROPERTIES']['MORE_PICT']['FILE_VALUE'] = $arTemp;
}
