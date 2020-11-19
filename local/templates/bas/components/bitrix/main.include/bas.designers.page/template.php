<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();

$this->setFrameMode(true);?>

<div class="designers-page">
	<div class="container">
		<div class="row">
			<div class="col-xl-7 col-xs-12">
				<?if ($arResult["FILE"] <> '') include($arResult["FILE"]);?>
			</div>
		</div>
	</div>
	<img src="<?=$templateFolder?>/img/img.png" class="designers-page__img" alt="">
</div>