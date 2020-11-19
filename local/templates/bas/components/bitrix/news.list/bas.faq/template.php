<?if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>

<?if(count($arResult['ITEMS']) > 0):?>

<div class="bas_faq_page">

<?foreach($arResult['ITEMS'] as $arItem):?>

	<div class="bas_our_margin">
		<div class="title"><?=$arItem['NAME']?></div>
		<div class="text"><?=$arItem['PREVIEW_TEXT']?></div>
	</div>

<?endforeach?>

</div>

<?endif;?>