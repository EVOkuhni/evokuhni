<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>

<div class="bas_our_office bas_our_margin" id="place<?=$arResult['SORT']?>">

<?if($arResult['DISPLAY_PROPERTIES']['NEW']['VALUE'] === 'Y'):?>

    <i>New!</i>

<?endif?>

    <h2>Студия <?=$arResult['NAME']?></h2>
	<div class="info">
		<div class="row">
			<div class="col-lg-5 col-md-6 col-sm-6 col-xs-12">
				<a href="tel:<?=$arResult['DISPLAY_PROPERTIES']['PHONE']['DESCRIPTION']?>" class="phone"><?=$arResult['DISPLAY_PROPERTIES']['PHONE']['DISPLAY_VALUE']?></a>
			</div>
			<div class="col-lg-7 col-md-6 col-sm-6 col-xs-12">
				<span class="time"><?=$arResult['DISPLAY_PROPERTIES']['TIME']['DISPLAY_VALUE']?></span>
			</div>
			<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
				<a href="javascript:;" data-toggle="tooltip" title="Скопировать" class="js-emaillink bas_tooltip email"><?=$arResult['DISPLAY_PROPERTIES']['EMAIL']['DISPLAY_VALUE']?></a>
<!--				<a href="//maps.yandex.ru/?pt=37.439077,55.634740&ll=37.439077,55.634740&z=16&oid=181047608966" target="_blank" class="addr"><?=$arResult['DISPLAY_PROPERTIES']['ADDR']['DISPLAY_VALUE']?></a>-->
                <span class="addr"><?=$arResult['DISPLAY_PROPERTIES']['ADDR']['DISPLAY_VALUE']?></span>
			</div>
		</div>
	</div>
	<div class="info">
		<?=$arResult['PREVIEW_TEXT']?>
	</div>
</div>