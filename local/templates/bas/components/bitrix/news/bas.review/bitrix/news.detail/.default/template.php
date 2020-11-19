<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();

$this->setFrameMode(true);?>

<div class="bas_review_detail_head">
	<h1><?=$arResult["NAME"];?></h1>
</div>
<div class="bas_review_detail">
	<div class="text">
		<?=$arResult["DETAIL_TEXT"];?>
	</div>
	<div class="info">
		<div class="name"><?=$arResult['DISPLAY_PROPERTIES']['AUTOR']['DISPLAY_VALUE']?></div>
		<div class="soc">
			<script src="//yastatic.net/es5-shims/0.0.2/es5-shims.min.js"></script>
			<script src="//yastatic.net/share2/share.js"></script>
			<div class="ya-share2" data-services="vkontakte,facebook,twitter,gplus"></div>
		</div>
	</div>
</div>