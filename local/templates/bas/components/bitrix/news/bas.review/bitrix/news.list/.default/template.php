<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();

$this->setFrameMode(true);?>

<div class="bas_review_list">
	<div class="block">

	<?foreach($arResult["ITEMS"] as $arItem):?>

		<div class="line bas_block_shadow">
			<div class="left">
				<a href="<?=$arItem['DETAIL_PAGE_URL']?>">

				<?if($arItem['PREVIEW_PICTURE']):?>

					<?$arItemsSmall = CFile::ResizeImageGet($arItem['PREVIEW_PICTURE'], array('width' => 250, 'height' => 255), BX_RESIZE_IMAGE_EXACT);?>

				<?else:?>

					<?$arItemsSmall['src'] = SITE_TEMPLATE_PATH . '/img/no.pict.news.jpg'?>

				<?endif?>

					<img src="<?=$arItemsSmall['src']?>" alt="<?=$arItem['PREVIEW_PICTURE']['ALT']?>">
				</a>
			</div>
			<div class="right">
				<div class="block">
					<div class="title">
						<a href="<?=$arItem['DETAIL_PAGE_URL']?>" class="title_style_first"><?=$arItem['NAME']?></a>
					</div>
					<div class="text">
						<?=$arItem['PREVIEW_TEXT']?>
					</div>
				</div>
				<div class="info">
					<div class="name"><?=$arItem['DISPLAY_PROPERTIES']['AUTOR']['DISPLAY_VALUE']?></div>
					<a href="<?=$arItem['DETAIL_PAGE_URL']?>" class="more">Читать дальше</a>
				</div>
			</div>
		</div>

	<?endforeach;?>

	</div>

	<?if($arParams["DISPLAY_BOTTOM_PAGER"]):?>
		<?=$arResult["NAV_STRING"]?>
	<?endif;?>

</div>