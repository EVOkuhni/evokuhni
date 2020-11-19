<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();

$this->setFrameMode(true);?>

<?if (count($arResult['ITEMS']) < 1) return;?>

<div class="bas_certificate_list">
	<div class="header">

	<?if (count($arResult['ITEMS']) > 3):?>

		<span class="carousel_control d-none d-md-block">
			<a class="control_prev btn-skew" href="javascript:;">‹</a>
			<a class="control_next btn-skew" href="javascript:;">›</a>
		</span>

	<?endif;?>

	</div>
	<div class="carousel">

	<?foreach($arResult['ITEMS'] as $arItem):?>

		<?$arItemsSmall = CFile::ResizeImageGet($arItem['PREVIEW_PICTURE'], array('width' => 270, 'height' => 385), BX_RESIZE_IMAGE_EXACT);?>

		<div class="item">
			<a href="<?=$arItem['PREVIEW_PICTURE']['SRC']?>" data-fancybox="bas_photo">
				<img src="<?=$arItemsSmall['src']?>" alt="<?=$arItem['PREVIEW_PICTURE']['ALT']?>">
			</a>
		</div>

	<?endforeach;?>

	</div>
</div>