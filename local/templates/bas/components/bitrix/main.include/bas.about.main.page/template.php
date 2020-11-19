<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();

$this->setFrameMode(true);?>

<div class="bas_about_main_page">
	<div class="block">
		<?if ($arResult["FILE"] <> '') include($arResult["FILE"]);?>
	</div>
	<a href="javascript:;" class="show_all">
		<span>Раскрыть текст</span>
		<span>Скрыть текст</span>
	</a>
</div>