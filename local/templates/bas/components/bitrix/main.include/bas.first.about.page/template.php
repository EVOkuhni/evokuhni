<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();

$this->setFrameMode(true);?>

<div class="bas_first_about_page">
	<div class="row">
		<div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
			<?if ($arResult["FILE"] <> '') include($arResult["FILE"]);?>
		</div>
	</div>
</div>