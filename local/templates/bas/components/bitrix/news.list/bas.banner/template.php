<?if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>

<?if(count($arResult['ITEMS']) > 0):?>

<div class="bas_banner">

<?foreach($arResult['ITEMS'] as $intKey => $arItem):?>

<?php
$img_mobile = $arItem['PROPERTIES']['IMG_MOBILE']['VALUE'];
$img_mobile = CFile::GetPath($img_mobile);
?>

	<a href="<?=$arItem['DISPLAY_PROPERTIES']['LINK']['VALUE']?>">
		<?/*<div class="slide-catalog-img slide-img-<?= $intKey ?>"></div>*/?>
        <img src="<?=$arItem['PREVIEW_PICTURE']['SRC']?>" alt="<?=$arItem['PREVIEW_PICTURE']['ALT']?>" class="d-none d-md-inline">
        <div class="row d-md-none">
            <img src="<?=$img_mobile?>" alt="<?=$arItem['PREVIEW_PICTURE']['ALT']?>">
        </div>
	</a>

<?endforeach?>

</div>

<?endif?>