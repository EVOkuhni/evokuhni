<?if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>

<?if (!empty($arResult)):?>

<div class="bas_map">
	<ul>

	<?$previousLevel = 0;

	foreach($arResult as $arItem):?>

		<?if($previousLevel && $arItem["DEPTH_LEVEL"] < $previousLevel):?>
			<?=str_repeat("</ul></li>", ($previousLevel - $arItem["DEPTH_LEVEL"]));?>
		<?endif?>

		<?if($arItem["IS_PARENT"]):?>

			<li class="parent">
				<a href="<?=$arItem["LINK"] ? $arItem["LINK"] : 'javascript:;'?>" class="<?=$arItem["LINK"] ? '' : 'dis'?> <?=$arItem["SELECTED"] ? 'active' : ''?>">
					<?=$arItem["TEXT"]?>
				</a>
				<ul>

		<?else:?>

			<li>
				<a href="<?=$arItem["LINK"] ? $arItem["LINK"] : 'javascript:;'?>" class="<?=$arItem["PARAMS"]["COLOR"] ? $arItem["PARAMS"]["COLOR"] : ''?> <?=$arItem["LINK"] ? '' : 'dis'?> <?=$arItem["SELECTED"] ? 'active' : ''?>">
					<?=$arItem["TEXT"]?>
				</a>
			</li>

		<?endif?>

		<?$previousLevel = $arItem["DEPTH_LEVEL"];?>

	<?endforeach?>

	<?if ($previousLevel > 1):?>
		<?=str_repeat("</ul></li>", ($previousLevel-1) );?>
	<?endif?>

	</ul>
</div>

<?endif?>