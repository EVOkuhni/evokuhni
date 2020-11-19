<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();

$this->setFrameMode(true);?>

<?if (count($arResult['ITEMS']) < 1) return;?>

<div class="bas_partner_list">
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

		<?$arItemsSmall = CFile::ResizeImageGet($arItem['PREVIEW_PICTURE'], array('width' => 120, 'height' => 100), BX_RESIZE_IMAGE_PROPORTIONAL);?>

		<div class="item">
			<a <?=$arItem['DISPLAY_PROPERTIES']['LINK']['VALUE'] ? 'href="' . $arItem['DISPLAY_PROPERTIES']['LINK']['VALUE'] . '" target="_blank"' : 'href="javascript:;"'?>>
				<img src="<?=$arItemsSmall['src']?>" alt="<?=$arItem['PREVIEW_PICTURE']['ALT']?>">
			</a>
		</div>

	<?endforeach;?>

	</div>
</div>