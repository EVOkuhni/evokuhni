<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>

<?if(count($arResult['ITEMS']) > 0):?>

<div class="header__contacts-block-wrap">
    <?foreach($arResult['ITEMS'] as $k => $arItem):?>

        <div class="d-none d-xl-block header__contacts-block">
            <a class="link" href="/contacts/#tab-studio-<?=$arItem['PROPERTIES']['EL_ABOUT']['VALUE']?>"><?=$arItem['NAME']?></a>
            <a class="tel" href="tel:<?=$arItem['DISPLAY_PROPERTIES']['PHONE']['DESCRIPTION']?>"><?=$arItem['DISPLAY_PROPERTIES']['PHONE']['DISPLAY_VALUE']?></a>
        </div>

    <?endforeach?>
</div>

<?endif?>