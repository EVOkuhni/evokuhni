<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();

$this->setFrameMode(true);?>

<div class="photo-list">
	<div class="title"><?=$arParams['TITLE_H2']?></div>

<?foreach($arResult["ITEMS"] as $arItem):?>

	<?$file = CFile::ResizeImageGet($arItem["PREVIEW_PICTURE"]['ID'], array('width'=>270, 'height'=>206), BX_RESIZE_IMAGE_PROPORTIONAL_ALT, true);	?>

	<div class="photo-item">
		<a href="<?=$arItem["PREVIEW_PICTURE"]["SRC"]?>" data-fancybox="bas_photo">
			<img src="<?=$file["src"]?>" alt="<?=$arItem["PREVIEW_PICTURE"]["ALT"]?>">
		</a>				
	</div>

<?endforeach;?>

</div>