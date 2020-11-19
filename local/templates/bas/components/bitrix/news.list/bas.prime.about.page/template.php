<?if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>

<?if(count($arResult['ITEMS']) > 0):?>

<div class="bas_prime_all_page bas_prime_about_page">
	<div class="container">
		<div class="row text-center triggers">

		<?foreach($arResult['ITEMS'] as $intKey => $arItem):?>

			<div class="col-lg-2 col-sm-4 col-6">
				<div class="item">
					<div class="pict">
						<img src="<?=$templateFolder?>/img/<?=$intKey?>.svg" alt="<?=$arItem['PREVIEW_PICTURE']['ALT']?>">
						<img src="<?=$templateFolder?>/img/<?=$intKey?>h.svg" alt="<?=$arItem['PREVIEW_PICTURE']['ALT']?>">
					</div>
					<div class="text"><?=$arItem['PREVIEW_TEXT']?></div>
				</div>
			</div>

		<?endforeach?>

		</div>
	</div>
</div>

<?endif;?>