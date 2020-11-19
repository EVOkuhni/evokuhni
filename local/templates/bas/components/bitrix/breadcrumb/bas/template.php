<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();

global $APPLICATION;

if (empty($arResult)) return "";

$strReturn = '';

$strReturn .= '<ol class="breadcrumb" itemscope="" itemtype="http://schema.org/BreadcrumbList" id="breadcrumbs">';

$itemSize = count($arResult);

for($index = 0; $index < $itemSize; $index++)
{
	$title = htmlspecialcharsex($arResult[$index]["TITLE"]);

	$nextRef = ($index < $itemSize-2 && $arResult[$index+1]["LINK"] <> ""? ' itemref="bx_breadcrumb_'.($index+1).'"' : '');
	$child = ($index > 0? ' itemprop="child"' : '');

	if($arResult[$index]["LINK"] <> "" && $index != $itemSize-1)
	{
		$strReturn .= '
				<li><span itemscope itemprop="itemListElement" itemtype="http://schema.org/ListItem">
				<a href="'.$arResult[$index]["LINK"].'" id="bx_breadcrumb_'.$index.'"  href="https://example.com/" itemprop="item">
					<span>'.$title.'</span>
					<meta itemprop="name" content="'.$title.'">
				</a>
				<meta itemprop="position" content="'.($index+1).'">
				</span></li>';
	}
	else
	{
		$strReturn .= '
				<li><span itemscope itemprop="itemListElement" itemtype="http://schema.org/ListItem">'.$title.'
					<meta itemprop="name" content="'.$title.'">
	<link itemprop="item" href="'.$arResult[$index]["LINK"].'">
	<meta itemprop="position" content="'.($index+1).'"></span></li>';
	}
}

	

$strReturn .= '</ol>';

return $strReturn;?>