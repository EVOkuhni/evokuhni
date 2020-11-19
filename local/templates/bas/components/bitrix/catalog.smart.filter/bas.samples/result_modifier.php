<?if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();

if ($_REQUEST['BAS_AJAX_FILTER_INFO'])
{
    LocalRedirect($arResult['SEF_SET_FILTER_URL'] . '?BAS_AJAX_CALL=Y');
}

global $sotbitFilterResult;  
$sotbitFilterResult = $arResult;

global $sotbitFilterSelected;
foreach ($arResult['ITEMS'] as $item)
{
    if(isset($item['VALUES']))
    {
        $selected = [];
        foreach ($item['VALUES'] as $value)
        {
            if($value['CHECKED'])
            {
                $selected[] = $value;
            }
        }
        if($selected)
        {
            $item['SELECTED_VALUES'] = $selected;
            $sotbitFilterSelected[$item['CODE']] = $item;
        }
    }
}