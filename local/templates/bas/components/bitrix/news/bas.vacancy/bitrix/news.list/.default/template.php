<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();

$this->setFrameMode(true);?>

<div class="bas_action_list">

<?foreach($arResult["ITEMS"] as $arItem):?>

	<div class="line">
		<div class="left">
			<a href="<?=$arItem['DETAIL_PAGE_URL']?>">

			<?if($arItem['PREVIEW_PICTURE']):?>

				<?$arItemsSmall = CFile::ResizeImageGet($arItem['PREVIEW_PICTURE'], array('width' => 250, 'height' => 255), BX_RESIZE_IMAGE_EXACT);?>

			<?else:?>

				<?$arItemsSmall['src'] = SITE_TEMPLATE_PATH . '/img/no.pict.news.jpg'?>

			<?endif?>

				<img src="<?=$arItemsSmall['src']?>" alt="<?=$arItem['PREVIEW_PICTURE']['ALT']?>">
			</a>

		<?if($arItem['DISPLAY_PROPERTIES']['PL']['DISPLAY_VALUE']):?>

			<div class="bas_label"><?=$arItem['DISPLAY_PROPERTIES']['PL']['DISPLAY_VALUE']?></div>

		<?endif?>

		</div>
		<div class="right">
			<div>
				<div class="name">
					<a href="<?=$arItem['DETAIL_PAGE_URL']?>" class="title_style_first"><?=$arItem['NAME']?></a>
				</div>
				<div class="text">
					<?=$arItem['PREVIEW_TEXT']?>
				</div>
			</div>
			<div class="into-block">
				<div>
					<a href="<?=$arItem['DETAIL_PAGE_URL']?>" class="btn btn-style1 btn-xl btn-skew">
						<span>Подробнее</span>
					</a>
				</div>
				<div>
					<a href="<?=$arItem['DETAIL_PAGE_URL']?>#toq" data-toggle="modal" data-target="#basVacancyModal" class="btn btn-default bold btn-skew" data-title="<?=$arItem['NAME']?>">
						<span>ОТПРАВИТЬ РЕЗЮМЕ</span>
					</a>
				</div>
			</div>
		</div>
	</div>

<?endforeach;?>

</div>

<?if($arParams["DISPLAY_BOTTOM_PAGER"]):?>
	<?=$arResult["NAV_STRING"]?>
<?endif;?>