<?if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();

if ($_SERVER['REDIRECT_URL']) $strCurPage = $_SERVER['REDIRECT_URL'];
else $strCurPage = $APPLICATION->GetCurPage(false);?>

<?if (!empty($arResult)):?>

<div class="bs-navbar-collapse collapse" role="navigation">
	<ul class="bas_menu_main">

	<?$previousLevel = 0;

	foreach($arResult as $arItem):?>

		<?if($previousLevel && $arItem["DEPTH_LEVEL"] < $previousLevel):?>
			<?=str_repeat("</ul></li>", ($previousLevel - $arItem["DEPTH_LEVEL"]));?>
		<?endif?>

		<?if($arItem["IS_PARENT"]):?>

			<li class="parent">

            <?if($arItem["LINK"] === $strCurPage):?>

				<span class="<?=$arItem["LINK"] ? '' : 'dis'?> <?=$arItem["SELECTED"] ? 'active' : ''?>">
					<?=$arItem["TEXT"]?>
				</span>

            <?else:?>

				<a href="<?=$arItem["LINK"] ? $arItem["LINK"] : 'javascript:;'?>" class="<?=$arItem["LINK"] ? '' : 'dis'?> <?=$arItem["SELECTED"] ? 'active' : ''?>">
					<?=$arItem["TEXT"]?>
				</a>

            <?endif?>

                <?php if($arItem['LINK'] == '/our-works/wardrobes/'): ?>
				<ul style="display: flex;flex-direction: column;flex-wrap: wrap;max-height: 255px;">
                <?php elseif($arItem['LINK'] == '/catalog/komplektuyushchie/' || $arItem['LINK'] == '/catalog/tekhnika/'): ?>
                    <ul class="bas_menu_main_simple">
				<?php else: ?>
                <ul>
				<?php endif; ?>

		<?else:?>

			<li>

            <?if($arItem["LINK"] === $strCurPage):?>

				<span class="<?=$arItem["PARAMS"]["COLOR"] ? $arItem["PARAMS"]["COLOR"] : ''?> <?=$arItem["LINK"] ? '' : 'dis'?> <?=$arItem["SELECTED"] ? 'active' : ''?>">
					<?=$arItem["TEXT"]?>
				</span>

            <?else:?>

				<a href="<?=$arItem["LINK"] ? $arItem["LINK"] : 'javascript:;'?>" class="<?=$arItem["PARAMS"]["COLOR"] ? $arItem["PARAMS"]["COLOR"] : ''?> <?=$arItem["LINK"] ? '' : 'dis'?> <?=$arItem["SELECTED"] ? 'active' : ''?>">
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
            <style>
                #title-search-input-mini {
                    height: 50px;
                }
                #title-search-mini {
                    margin: 0 auto;
                }
                .menu-catalog-close-btn {
                    color: var(--lighter-olive-green) !important;
                    font-size: 16px !important;
                    text-decoration: underline !important;
                }
                @media screen and (max-width: 750px){
                    .title-search-result {
                        left: 0 !important;
                        margin: 0 auto;
                    }
                }
            </style>
            <?$APPLICATION->IncludeComponent(
                "bas:bas.search.title",
                "bas",
                array(
                    "CATEGORY_0" => array(
                        0 => "iblock_catalog",
                    ),
                    "CATEGORY_0_TITLE" => "",
                    "CHECK_DATES" => "N",
                    "CONTAINER_ID" => "title-search-mini",
                    "INPUT_ID" => "title-search-input-mini",
                    "NUM_CATEGORIES" => "1",
                    "ORDER" => "date",
                    "PAGE" => "/search/",
                    "SHOW_INPUT" => "Y",
                    "SHOW_OTHERS" => "N",
                    "TOP_COUNT" => "5",
                    "USE_LANGUAGE_GUESS" => "Y",
                    "COMPONENT_TEMPLATE" => "bas",
                    "COMPOSITE_FRAME_MODE" => "A",
                    "COMPOSITE_FRAME_TYPE" => "AUTO",
                    "CATEGORY_0_iblock_catalog" => array(
                        0 => "4",
                    ),
                    "PRICE_CODE" => "",
                    "PRICE_VAT_INCLUDE" => "Y",
                    "PREVIEW_TRUNCATE_LEN" => "",
                    "SHOW_PREVIEW" => "Y",
                    "PREVIEW_WIDTH" => "75",
                    "PREVIEW_HEIGHT" => "75"
                ),
                false
            );?>
        </li>
        <li class="d-lg-none">
            <a class="menu-catalog-close-btn" href="#" data-toggle="collapse" data-target=".bs-navbar-collapse">свернуть</a>
        </li>

	</ul>
</div>

<?endif?>