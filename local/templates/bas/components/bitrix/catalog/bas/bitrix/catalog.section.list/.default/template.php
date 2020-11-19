<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();

$this->setFrameMode(true);

if (count($arResult['SECTIONS']) < 1) return;?>
 
<div class="container">
	<div class="bas_our_margin">
	<?if($arResult['SECTION']["IPROPERTY_VALUES"]["SECTION_PAGE_TITLE"]):?>
		<h1><?=$arResult['SECTION']["IPROPERTY_VALUES"]["SECTION_PAGE_TITLE"]?></h1>
	<?else:?>	
			<h1><?=($arResult['SECTION']['NAME'] ? $arResult['SECTION']['NAME'] : $APPLICATION->ShowTitle(true))?></h1>
	<?endif;?>
	</div>
	<div class="bas_catalog_section_list">
		<div class="row">

	<?foreach($arResult['SECTIONS'] as $arItem):?>

		<?if($arItem['UF_SYS'] != 2||1):?>

			<div class="col-lg-4 col-sm-6">
				<div class="block bas_block_shadow bas_our_margin">
					<a class="img" href="<?=$arItem['SECTION_PAGE_URL']?>">

					<?if($arItem['PICTURE']['SRC']):?>

						<?$arItemsSmall = CFile::ResizeImageGet($arItem['PICTURE'], array('width' => 360, 'height' => 250), BX_RESIZE_IMAGE_EXACT, false, false, false, 85);?>

						<img src="<?=$arItemsSmall['src']?>" alt="<?=$arItem['PICTURE']['ALT']?>">

					<?else:?>

						<img src="<?=SITE_TEMPLATE_PATH?>/img/no.pict.jpg" alt="No Photo" title="<?=$arItem['NAME']?>">

					<?endif?>

					</a>
					<div class="info text-center">
						<div class="top">
							<a href="<?=$arItem['SECTION_PAGE_URL']?>"><?=$arItem['NAME']?></a>
						</div>
						<div class="bottom">
							<a href="<?=$arItem['SECTION_PAGE_URL']?>" class="btn btn-default bold" rel="nofollow">ПЕРЕЙТИ</a>
						</div>
					</div>
				</div>
			</div>

		<?endif?>

	<?endforeach;?>

		</div>
	</div>
</div>

<?if($arResult['DESCRIPTION']):?>

<div class="bas_grey_text_block">
	<div class="container">
		<?=$arResult['DESCRIPTION']?>
	</div>
</div>

<?endif?>