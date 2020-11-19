<?if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>

<?$strCurPage = $APPLICATION->GetCurPage(false);?>

<?if (!empty($arResult)):?>

	<a href="javascript:;" class="bas_menu_top_btn d-lg-none">
		<span class="icon">
			<span></span>
			<span></span>
			<span></span>
		</span>
		<span class="name">Меню</span>
	</a>
	<ul class="bas_menu_top">

	<?$previousLevel = 0;

	foreach($arResult as $arItem):?>

    <?php if($arItem['PARAMS']['NOT_TOP']) continue ?>

		<?if($previousLevel && $arItem["DEPTH_LEVEL"] < $previousLevel):?>
			<?=str_repeat("</ul></li>", ($previousLevel - $arItem["DEPTH_LEVEL"]));?>
		<?endif?>

		<?if($arItem["IS_PARENT"]):?>

			<li>

            <?if($arItem["LINK"] === $strCurPage):?>

				<span class="parent">
					<?=$arItem["TEXT"]?>
				</span>

            <?else:?>

				<a href="<?=$arItem["LINK"] ? $arItem["LINK"] :  'javascript:;'?>" class="parent <?=$arItem["SELECTED"] ? 'active' : ''?>">
					<?=$arItem["TEXT"]?>
				</a>

            <?endif?>

				<ul>

		<?else:?>

			<li>

            <?if($arItem["LINK"] === $strCurPage):?>

				<span>
					<?=$arItem["TEXT"]?>
				</span>

            <?else:?>

				<a href="<?=$arItem["LINK"] ? $arItem["LINK"] : 'javascript:;'?>" class="<?=$arItem["SELECTED"] ? 'active' : ''?>">
					<?=$arItem["TEXT"]?>
				</a>

            <?endif?>

			</li>

		<?endif?>

		<?$previousLevel = $arItem["DEPTH_LEVEL"];?>

	<?endforeach?>

	<?if ($previousLevel > 1):?>
		<?=str_repeat("</ul></li>", ($previousLevel-1) );?>
	<?endif?>

        <li class="d-lg-none">
            <a class="menu-catalog-close-btn" style="font-size: 11px !important;" href="#" onclick="$('.bas_menu_top').slideToggle(); return false;">свернуть</a>
        </li>

	</ul>

<?endif?>