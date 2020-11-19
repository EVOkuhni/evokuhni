<?if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>

<?if(count($arResult['ITEMS']) > 0):?>

<div class="bas_step_main_page text-center">
	<div class="inner">
		<div class="container">
			<div class="title d-none d-lg-block"><?=$arResult['NAME']?></div>
			<div class="row">

			<?foreach($arResult['ITEMS'] as $intKey => $arItem):?>

				<?$addClass = '';

				switch ($intKey)
				{
					case 0:
						
					break;
					case 1:
						
					break;
					case 2:
						$addClass = 'order-sm-3 order-4';
					break;
					case 3:
						$addClass = 'order-sm-6 order-3';
					break;
					case 4:
						$addClass = 'order-sm-5 order-5';
					break;
					case 5:
						$addClass = 'order-sm-4 order-6';
					break;
				}?>

				<div class="col-lg-2 col-sm-4 col-6 order-lg-<?=($intKey + 1)?> <?=$addClass?>">
					<div class="pict">
						<img src="<?=$arItem['PREVIEW_PICTURE']['SRC']?>" alt="<?=$arItem['PREVIEW_PICTURE']['ALT']?>">
					</div>
					<div class="text"><?=$arItem['NAME']?></div>
				</div>

			<?endforeach?>

			</div>
		</div>
	</div>
</div>

<?endif;?>