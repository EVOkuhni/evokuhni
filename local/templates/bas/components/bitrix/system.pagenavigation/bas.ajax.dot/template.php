<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();

$templateData = array(
   "PREV" => "",
   "NEXT" => ""
);

if ($arResult["NavPageNomer"] > 1)
{
     if ($arResult["NavPageNomer"] == 2)
     {
        $templateData["PREV"] =  '<link rel="prev" href="'.$arResult["sUrlPath"].'">';
     }
     else
     {
        $templateData["PREV"] =  '<link rel="prev" href="'.$arResult["sUrlPath"].'?'.$strNavQueryString.'PAGEN_'.$arResult["NavNum"].'='.($arResult["NavPageNomer"]-1).'">';   
     }
}

if ($arResult["NavPageNomer"] < $arResult["NavPageCount"])
{
    $templateData["NEXT"] = '<link rel="next" href="'.$arResult["sUrlPath"].'?'.$strNavQueryString.'PAGEN_'.$arResult["NavNum"].'='.($arResult["NavPageNomer"]+1).'">';
}

if(!$arResult["NavShowAlways"])
{
	if ($arResult["NavRecordCount"] == 0 || ($arResult["NavPageCount"] == 1 && $arResult["NavShowAll"] == false))
	{
		echo '<div class="bas_pagination"></div>';

		return;
	}
}
?>
<div class="bas_pagination">
<?

$strNavQueryString = ($arResult["NavQueryString"] != "" ? $arResult["NavQueryString"]."&amp;" : "");
$strNavQueryStringFull = ($arResult["NavQueryString"] != "" ? "?".$arResult["NavQueryString"] : "");

if($arResult["bDescPageNumbering"] === true):

	$bFirst = true;

	if ($arResult["NavPageNomer"] < $arResult["NavPageCount"]):
		if($arResult["bSavePage"]):
?>
			
			<a class="prev" href="<?=$arResult["sUrlPath"]?>?PAGEN_<?=$arResult["NavNum"]?>=<?=($arResult["NavPageNomer"]+1)?>">
				<span><</span>
			</a>
<?
		else:
			if ($arResult["NavPageCount"] == ($arResult["NavPageNomer"]+1) ):
?>
			<a class="prev" href="<?=$arResult["sUrlPath"]?><?=$strNavQueryStringFull?>">
				<span><</span>
			</a>
<?
			else:
?>
			<a class="prev" href="<?=$arResult["sUrlPath"]?>?PAGEN_<?=$arResult["NavNum"]?>=<?=($arResult["NavPageNomer"]+1)?>">
				<span><</span>
			</a>
<?
			endif;
		endif;

	endif;
	do
	{
		$NavRecordGroupPrint = $arResult["NavPageCount"] - $arResult["nStartPage"] + 1;
		
		if ($arResult["nStartPage"] == $arResult["NavPageNomer"]):
?>
		<span>
			<span><?=$NavRecordGroupPrint?></span>
		</span>
<?
		elseif($arResult["nStartPage"] == $arResult["NavPageCount"] && $arResult["bSavePage"] == false):
?>
		<a href="<?=$arResult["sUrlPath"]?><?=$strNavQueryStringFull?>">
			<span><?=$NavRecordGroupPrint?></span>
		</a>
<?
		else:
?>
		<a href="<?=$arResult["sUrlPath"]?>?PAGEN_<?=$arResult["NavNum"]?>=<?=$arResult["nStartPage"]?>">
			<span><?=$NavRecordGroupPrint?></span>
		</a>
<?
		endif;
		
		$arResult["nStartPage"]--;
		$bFirst = false;
	} while($arResult["nStartPage"] >= $arResult["nEndPage"]);
	
	if ($arResult["NavPageNomer"] > 1):
		if ($arResult["nEndPage"] > 1):

?>
		<a href="<?=$arResult["sUrlPath"]?>?PAGEN_<?=$arResult["NavNum"]?>=1">
			<span><?=$arResult["NavPageCount"]?></span>
		</a>
<?
		endif;
	
?>
		<a class="next" href="<?=$arResult["sUrlPath"]?>?PAGEN_<?=$arResult["NavNum"]?>=<?=($arResult["NavPageNomer"]-1)?>">
			<span>></span>
		</a>
<?
	endif;

else:
	$bFirst = true;

	if ($arResult["NavPageNomer"] > 1):
		if($arResult["bSavePage"]):
?>
			<a class="prev" href="<?=$arResult["sUrlPath"]?>?PAGEN_<?=$arResult["NavNum"]?>=<?=($arResult["NavPageNomer"]-1)?>">
				<span><</span>
			</a>
<?
		else:
			if ($arResult["NavPageNomer"] > 2):
?>
			<a class="prev" href="<?=$arResult["sUrlPath"]?>?PAGEN_<?=$arResult["NavNum"]?>=<?=($arResult["NavPageNomer"]-1)?>">
				<span><</span>
			</a>
            <?php if($arResult["NavPageNomer"] > 3 && $arResult["nStartPage"] > 1): ?>
            <a href="<?=$arResult["sUrlPath"]?>">
                <span>1</span>
            </a>
            <?php if($arResult["NavPageNomer"] > 4): ?>
            <div class="nav-separator"><div>...</div></div>
            <?php endif; ?>
            <?php endif ?>
<?
			else:
?>
			<a class="prev" href="<?=$arResult["sUrlPath"]?><?=$strNavQueryStringFull?>">
				<span><</span>
			</a>
<?
			endif;
		endif;
	endif;

	do
	{
		if ($arResult["nStartPage"] == $arResult["NavPageNomer"]):
?>
		<span>
			<span><?=$arResult["nStartPage"]?></span>
		</span>
<?
		elseif($arResult["nStartPage"] == 1 && $arResult["bSavePage"] == false):
?>
		<a href="<?=$arResult["sUrlPath"]?><?=$strNavQueryStringFull?>" class="<?=($bFirst ? "modern-page-first" : "")?>">
			<span><?=$arResult["nStartPage"]?></span>
		</a>
<?
		else:
?>
		<a href="<?=$arResult["sUrlPath"]?>?PAGEN_<?=$arResult["NavNum"]?>=<?=$arResult["nStartPage"]?>">
			<span><?=$arResult["nStartPage"]?></span>
		</a>
<?
		endif;
		$arResult["nStartPage"]++;
		$bFirst = false;

	} while($arResult["nStartPage"] <= $arResult["nEndPage"]);
	
	if($arResult["NavPageNomer"] < $arResult["NavPageCount"]):

?>
        <?php if($arResult["NavPageCount"] - $arResult["NavPageNomer"] > 2 && $arResult["NavPageCount"] > $arResult["nEndPage"] ): ?>
        <?php if($arResult["NavPageCount"] - $arResult["NavPageNomer"] > 3): ?>
        <div class="nav-separator"><div>...</div></div>
        <?php endif; ?>
		<a href="<?=$arResult["sUrlPath"]?>?PAGEN_<?=$arResult["NavNum"]?>=<?=$arResult["NavPageCount"]?>">
			<span><?= $arResult["NavPageCount"] ?></span>
		</a>
        <?php endif; ?>
        <a class="next" href="<?=$arResult["sUrlPath"]?>?PAGEN_<?=$arResult["NavNum"]?>=<?=($arResult["NavPageNomer"]+1)?>">
			<span>></span>
		</a>
<?
	endif;
endif;?>

</div>