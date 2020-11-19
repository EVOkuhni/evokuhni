<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();

$this->setFrameMode(true);?>

<div class="bas_video_list">
	<div class="block">

	<?foreach($arResult["ITEMS"] as $arItem):?>

		<?$arItem['DETAIL_PAGE_URL'] = str_replace('https://youtu.be/', 'https://www.youtube.com/embed/', $arItem['DISPLAY_PROPERTIES']['LINK']['VALUE'])?>

		<div class="line bas_block_shadow">
			<div class="left">
				<a href="<?=$arItem['DETAIL_PAGE_URL']?>" data-fancybox>

					<?$arItemsSmall = CFile::ResizeImageGet($arItem['PREVIEW_PICTURE'], array('width' => 250, 'height' => 255), BX_RESIZE_IMAGE_EXACT);?>

					<img src="<?=$arItemsSmall['src']?>" alt="<?=$arItem['PREVIEW_PICTURE']['ALT']?>">
				</a>
			</div>
			<div class="right">
				<div class="block">
					<div class="name">
						<a href="<?=$arItem['DETAIL_PAGE_URL']?>" data-fancybox class="title_style_first"><?=$arItem['NAME']?></a>
					</div>
					<div class="text">
						<?=$arItem['PREVIEW_TEXT']?>
					</div>
				</div>
				<div class="info">
					<div class="date"><?=$arItem['DISPLAY_ACTIVE_FROM']?></div>
					<a href="<?=$arItem['DETAIL_PAGE_URL']?>" data-fancybox class="more">Смотреть</a>
				</div>
			</div>
		</div>

	<?endforeach;?>

	</div>

	<?if($arParams["DISPLAY_BOTTOM_PAGER"]):?>
		<?=$arResult["NAV_STRING"]?>
	<?endif;?>

</div>