<?if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>

<?if(count($arResult['ITEMS']) > 0):?>

<div class="bas_prime_news_page text-center">
	<div class="title">
		<div class="title_style_first">
			<?=$arResult['NAME']?>
		</div>
	</div>
	<div class="block">
		<div class="row">

		<?foreach($arResult['ITEMS'] as $intKey => $arItem):?>

			<div class="col-lg-12 col-md-4 col-sm-6">
				<div class="pict">
					<img src="<?=$templateFolder?>/img/<?=$intKey?>.svg" alt="<?=$arItem['PREVIEW_PICTURE']['ALT']?>">
					<img src="<?=$templateFolder?>/img/<?=$intKey?>h.svg" alt="<?=$arItem['PREVIEW_PICTURE']['ALT']?>">
				</div>
				<div class="text"><?=$arItem['PREVIEW_TEXT']?></div>
			</div>

		<?endforeach?>

		</div>
	</div>
</div>

<?endif;?>