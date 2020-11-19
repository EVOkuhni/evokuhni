<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();

$arResult['DETAIL_TEXT'] = str_replace('h1', 'h2', $arResult['DETAIL_TEXT']);

$arResult['DETAIL_TEXT'] = preg_replace("!<a.*?href=\"?'?http:\/\/([^ \"'>]+)\"?'?.*?>(.*?)</a>!is", "\\2", $arResult['DETAIL_TEXT']);
$arResult['DETAIL_TEXT'] = preg_replace("!<a.*?href=\"?'?https:\/\/([^ \"'>]+)\"?'?.*?>(.*?)</a>!is", "\\2", $arResult['DETAIL_TEXT']);

$arResult['COLOR_VALUE'] = false;

foreach($arResult['PROPERTIES'] as $key=>$value)
{
	if(strstr($key, 'CVET')!==false && $value['VALUE'])
	{ 
		$arResult['COLOR_VALUE'] = $value['VALUE'];
	}
}

$colorIbId = 16;

foreach($arResult['PROPERTIES'] as $propCode=>$arProp)
{
	if (strpos($propCode,"KUHNI_CVET_")!==false)
	{
		$numbProp=str_replace("KUHNI_CVET_","",$propCode);

		if (is_array($arResult['PROPERTIES'][$propCode]['VALUE'])&&count($arResult['PROPERTIES'][$propCode]['VALUE'])>0)
		{
			$arSelect = Array("ID", "NAME", "PREVIEW_PICTURE");
			$arFilter = Array("IBLOCK_ID"=>IntVal($colorIbId),  "ACTIVE"=>"Y","ID"=>$arResult['PROPERTIES'][$propCode]['VALUE']);
			$res = CIBlockElement::GetList(Array("sort"=>"asc"), $arFilter, false, false, $arSelect);
			$colores=array();
			$colores['NUMB']=$numbProp;
			$colores['TITLE']=$arResult['PROPERTIES']['CVET_TEXT'.$numbProp]['VALUE'];
			$countCl=0;

			while ($ob = $res->GetNextElement())
			{
				$arFields = $ob->GetFields();
				$tmp = CFile::ResizeImageGet($arFields['PREVIEW_PICTURE'], array('width' => 128, 'height' => 128), BX_RESIZE_IMAGE_PROPORTIONAL);
				$tumb = CFile::ResizeImageGet($arFields['PREVIEW_PICTURE'], array('width' => 100, 'height' => 75), BX_RESIZE_IMAGE_PROPORTIONAL);
				$countCl++;
				$colores['VALUES'][$arFields['ID']] = Array(
					'NAME' => $arFields['NAME'],
					'FILE' => CFile::GetPath($arFields['PREVIEW_PICTURE']),
					'FILE_SMALL' => $tmp['src'],
					'FILE_TUMB' => $tumb['src'],
				);
			}

			$arResult['COLORS'][] = $colores;

			if ($arResult['COLOR_CNT'] == "") $arResult['COLOR_CNT']=$countCl;
		}
	}
}

$cp = $this->__component;

if (is_object($cp))
{
    $cp->arResult['PREVIEW_TEXT'] = $arResult['PREVIEW_TEXT'];

	$cp->arResult['POLE1_NAME'] = $arResult['PROPERTIES']['POLE1']['NAME'];
	$cp->arResult['POLE1_VALUE'] = $arResult['PROPERTIES']['POLE1']['VALUE'];

	$cp->arResult['POLE2_NAME'] = $arResult['PROPERTIES']['POLE2']['NAME'];
	$cp->arResult['POLE2_VALUE'] = $arResult['PROPERTIES']['POLE2']['VALUE'];

    $cp->SetResultCacheKeys(array('PREVIEW_TEXT', 'POLE1_NAME', 'POLE1_VALUE', 'POLE2_NAME', 'POLE2_VALUE'));
}

if (CModule::IncludeModule("iblock"))
{ 
	$arFilter = Array(
		'IBLOCK_ID'	=> $arResult['IBLOCK_ID'],
		'ID'		=> $arResult['SECTION']['ID']
	);

	$arSelectSec=Array('UF_SHOW_FROM', 'UF_SHOW_ICON', 'UF_DESC_PRICE','UF_TOV_COM','UF_HIDE_BAN', 'UF_SHOW_BTN_NUM1', 'UF_SHOW_BTN_NUM2', 'UF_SHOW_BTN_NUM3', 'UF_ZA', 'UF_BANNER_CART', 'UF_SHOW_BTN_ONE');
	$res = CIBlockSection::GetList(Array(), $arFilter, false, $arSelectSec);

	if ($res = $res->GetNext())
	{
		$arResult['SECTION']['UF_SHOW_ICON'] = $res['UF_SHOW_ICON'];
		$arResult['SECTION']['UF_HIDE_BAN'] = $res['UF_HIDE_BAN'];
		$arResult['SECTION']['UF_SHOW_BTN_NUM1'] = $res['UF_SHOW_BTN_NUM1'];
		$arResult['SECTION']['UF_SHOW_BTN_NUM2'] = $res['UF_SHOW_BTN_NUM2'];
		$arResult['SECTION']['UF_SHOW_BTN_NUM3'] = $res['UF_SHOW_BTN_NUM3'];
		$arResult['SECTION']['UF_ZA'] = $res['UF_ZA'];
		$arResult['SECTION']['UF_BANNER_CART'] = $res['UF_BANNER_CART'];
		$arResult['SECTION']['UF_SHOW_BTN_ONE'] = $res['UF_SHOW_BTN_ONE'];
		$arResult['SECTION']['UF_DESC_PRICE'] = $res['UF_DESC_PRICE'];
		$arResult['SECTION']['UF_TOV_COM'] = $res['UF_TOV_COM'];
		$arResult['SECTION']['UF_SHOW_FROM'] = $res['UF_SHOW_FROM'];

		if ($arResult['SECTION']['UF_TOV_COM']=="" || $arResult['SECTION']['UF_DESC_PRICE']=="" || $arResult['SECTION']['UF_SHOW_FROM']=="")
		{
			$arFilter = Array(
				'IBLOCK_ID'	=> $arResult['IBLOCK_ID'],
				'ID'		=> $arResult['SECTION']['PATH'][0]['ID']
			);

			$res = CIBlockSection::GetList(Array(), $arFilter, false, $arSelectSec);
			
			if ($res = $res->GetNext())
			{
				if ($arResult['SECTION']['UF_TOV_COM'] == "") $arResult['SECTION']['UF_TOV_COM'] = $res['UF_TOV_COM'];
				if ($arResult['SECTION']['UF_DESC_PRICE'] == "") $arResult['SECTION']['UF_DESC_PRICE'] = $res['UF_DESC_PRICE'];
				if ($arResult['SECTION']['UF_SHOW_FROM'] == "") $arResult['SECTION']['UF_SHOW_FROM'] = $res['UF_SHOW_FROM'];
			}		
		}
	}
}

$arDispProp = Array();
$arRazmProp = Array();

foreach($arResult['DISPLAY_PROPERTIES'] as $intKey => $arItem) {

	if (strpos($arItem['CODE'], 'RAZM_') !== false) $arRazmProp[] = $arItem;
	else $arDispProp[] = $arItem;
}

$arResult['DISPLAY_PROPERTIES'] = $arDispProp;
$arResult['RAZM_PROPERTIES'] = $arRazmProp;

if (isset($_REQUEST['z'])) {

	global $APPLICATION;

	$APPLICATION->RestartBuffer();

	foreach($arResult['PROPERTIES']['MORE_PICT']['VALUE'] as $intKey => $arItem)
	{?>
		<img src="<?=CFile::GetPath($arItem)?>">
	<?}

	die();
}?>