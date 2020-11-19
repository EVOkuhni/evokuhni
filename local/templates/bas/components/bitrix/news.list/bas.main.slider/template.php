<?if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>

<?if(count($arResult['ITEMS']) > 0):?>

<?foreach($arResult['ITEMS'] as $intKey => $arItem):?>
    <?php
    $img_mobile = $arItem['PROPERTIES']['IMG_MOBILE']['VALUE'];
    $img_mobile = CFile::GetPath($img_mobile);
    $arResult['ITEMS'][$intKey]['MOBILE_PICTURE']['SRC'] = $img_mobile;
    ?>
    <style>
        .slide-img-<?= $intKey ?> {
            background-image: url(<?=$arItem['PREVIEW_PICTURE']['SRC']?>);
        }
        @media screen and (max-width: 576px) {
            .slide-img-<?= $intKey ?> {
                background-image: url(<?= $img_mobile?$img_mobile:$arItem['PREVIEW_PICTURE']['SRC'] ?>);
            }
        }
    </style>
<?php endforeach; ?>

<div class="bas_main_slider">

<?foreach($arResult['ITEMS'] as $intKey => $arItem):?>

	<div class="item">
		<a href="<?=$arItem['DISPLAY_PROPERTIES']['LINK']['VALUE'] ? $arItem['DISPLAY_PROPERTIES']['LINK']['VALUE'] : 'javascript:;'?>">
            <img src="<?=$arItem['PREVIEW_PICTURE']['SRC']?>" alt="<?=$arItem['PREVIEW_PICTURE']['ALT']?>" class="d-none d-md-inline">
            <img src="<?=$arItem['MOBILE_PICTURE']['SRC']?>" alt="<?=$arItem['PREVIEW_PICTURE']['ALT']?>" class="d-md-none">
			<?if(!$arItem['DISPLAY_PROPERTIES']['HAS_TEXT']['VALUE']):?>
			<div class="block text-center-xs text-left-md">
				<div class="title"><?=$arItem['NAME']?></div>
				<div class="text"><?=$arItem['PREVIEW_TEXT']?></div>
			</div>
			<?endif;?>
		</a>
	</div>

<?endforeach?>

</div>

<?endif;?>