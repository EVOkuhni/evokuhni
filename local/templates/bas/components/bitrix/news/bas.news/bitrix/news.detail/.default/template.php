<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();

$this->setFrameMode(true);?>

<div class="bas_news_detail_head">
	<h1><?=$arResult["NAME"];?></h1>
</div>
<div class="bas_news_detail">
	<div class="text">
		<?=$arResult["DETAIL_TEXT"];?>
	</div>
	<div class="info <?=($arParams["BAS_SHOW_FORM"] === 'Y') ? '' : 'set_border'?>">
		<div class="soc">
			<script src="//yastatic.net/es5-shims/0.0.2/es5-shims.min.js"></script>
			<script src="//yastatic.net/share2/share.js"></script>
			<div class="ya-share2" data-services="vkontakte,facebook,twitter,gplus"></div>
		</div>
		<div class="counter"><?=intval($arResult['SHOW_COUNTER'])?></div>
		<div class="date"><?=$arResult['DISPLAY_ACTIVE_FROM']?></div>
	</div>
</div>