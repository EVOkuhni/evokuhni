<?if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>

<?$strCurPage = $APPLICATION->GetCurPage(false);?>

<?if (!empty($arResult)):?>

<ul class="bas_menu_bottom row no-gutters justify-content-between">

<?$previousLevel = 0;

foreach($arResult as $arItem):?>

	<?if ($previousLevel && $arItem["DEPTH_LEVEL"] < $previousLevel):?>
		<?=str_repeat("</ul></li>", ($previousLevel - $arItem["DEPTH_LEVEL"]));?>
	<?endif?>

	<?if ($arItem["IS_PARENT"]):?>

		<?if ($arItem["DEPTH_LEVEL"] == 1):?>

			<li <?= $arItem['PARAMS']['HIDE_LG']?'class="d-lg-none d-xl-block"':'' ?>>
				<div class="strong"><?=$arItem["TEXT"]?></div>
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

				<ul>

		<?endif?>

	<?else:?>

		<?if ($arItem["DEPTH_LEVEL"] == 1):?>

			<li>
				<div class="strong">

                <?if($arItem["LINK"] === $strCurPage):?>

                    <span>
                        <?=$arItem["TEXT"]?>
                    </span>

                <?else:?>

					<a href="<?=$arItem["LINK"] ? $arItem["LINK"] : 'javascript:;'?>">
						<?=$arItem["TEXT"]?>
					</a>

                <?endif?>

				</div>
			</li>

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
		

	<?endif?>

	<?$previousLevel = $arItem["DEPTH_LEVEL"];?>

<?endforeach?>

<?if ($previousLevel > 1):?>
	<?=str_repeat("</ul></li>", ($previousLevel-1) );?>
<?endif?>

</ul>

<?endif?>