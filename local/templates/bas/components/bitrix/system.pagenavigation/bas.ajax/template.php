<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();

if ($arResult["NavPageNomer"] >= $arResult["nEndPage"]) return;

if (!$arResult["NavShowAlways"])
{
	if ($arResult["NavRecordCount"] == 0 || ($arResult["NavPageCount"] == 1 && $arResult["NavShowAll"] == false)) return;

}?>

<div class="bas_pagination_ajax text-center bas_our_margin">

	<?$strNavQueryString = ($arResult["NavQueryString"] != "" ? $arResult["NavQueryString"]."&amp;" : "");?>

	<a class="btn btn-primary" data-numb="<?=($arResult["NavPageNomer"]+1)?>" href="<?=$arResult["sUrlPath"]?>?<?=$strNavQueryString?>PAGEN_<?=$arResult["NavNum"]?>=<?=($arResult["NavPageNomer"]+1)?>">показать ещё</a>

</div>

<script>
maxPageCount=<?=intval($arResult['NavPageCount'])?>;
pagerNumb="<?=$arResult["NavNum"]?>";
</script>