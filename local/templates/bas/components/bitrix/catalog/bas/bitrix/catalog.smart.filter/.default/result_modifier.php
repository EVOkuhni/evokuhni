<?if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();

if ($_REQUEST['BAS_AJAX_FILTER_INFO'])
{
	$APPLICATION->RestartBuffer();

	$arTemp = Array();

	foreach ($arResult['ITEMS'] as $arItem)
	{
		foreach ($arItem['VALUES'] as $arValue)
		{
			$arTemp['DISABLED'][$arValue['CONTROL_ID']] = $arValue['DISABLED'];
		}
	}

	$arTemp['URL'] = $arResult['SEF_SET_FILTER_URL'] . '?BAS_AJAX_CALL=Y';

	echo json_encode($arTemp);

	die();
}

global $sotbitFilterResult;

$sotbitFilterResult = $arResult;

global $sotbitFilterSelected;

$selectedBadges = array();

$arTemp = Array();

foreach ($arResult['ITEMS'] as $item)
{
    if (isset($item['VALUES']))
    {
        $selected = [];

        foreach ($item['VALUES'] as $value)
        {
            if ($value['CHECKED'])
            {
                $selected[] = $value;
                $selectedBadges[] = array(
                    'NAME' => $value['VALUE'],
                    'CONTROL_ID' => $value['CONTROL_ID'],
                );
            }
        }

        if ($selected)
        {
            $item['SELECTED_VALUES'] = $selected;

            $sotbitFilterSelected[$item['CODE']] = $item;
        }
    }

	if ($item['CODE'] === 'PRICE')
	{
		$arResult['PRICE'] = $item;
	}
	else
	{
		$arTemp[] = $item;
	}
}

$arFilter = Array(
    'IBLOCK_ID'	=> $arParams['IBLOCK_ID'],
    'ID'		=> $arParams['SECTION_ID'],
);

$res = CIBlockSection::GetList(
    Array(),
    $arFilter,
    false,
    Array(
        'UF_HIDE_PRICE',
    )
);

if ($res = $res->GetNext())
{
    $arResult['SECTION']['UF_HIDE_PRICE'] = $res['UF_HIDE_PRICE'];
}

global $filterSelectedBadges;
$filterSelectedBadges = $selectedBadges;

$arResult['ITEMS'] = $arTemp;
$arResult['SELECTED_BADGES'] = $selectedBadges;