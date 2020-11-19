<?if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>

<?if(count($arResult['ITEMS']) > 0):?>

<?foreach($arResult['ITEMS'] as $arItem):?>

	<style type="text/css">
		main.main {
			background-image: url("<?=$arItem['PREVIEW_PICTURE']['SRC']?>");

		<?if($arItem['DISPLAY_PROPERTIES']['POLOG']['VALUE_XML_ID'] === 'C'):?>

			background-position: center top;

		<?endif?>

		}
		.bas_first_about_page {min-height: <?=$arItem['PREVIEW_PICTURE']['HEIGHT'] - 160?>px;}

	</style>

<?endforeach?>

<?endif;?>