<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();

$this->setFrameMode(true);?>

<?php if($arResult['ITEMS']): ?>
<div class="bas_team">
	<div class="title"><span><?=$arParams['TITLE_H2']?></span></div>
    <div class="header">

        <?if (count($arResult['ITEMS']) > 4):?>

            <span class="carousel_control d-none d-md-block">
                <a class="control_prev" href="javascript:;">‹</a>
                <a class="control_next" href="javascript:;">›</a>
            </span>

        <?endif;?>

        <span class="carousel_control d-sm-none">
            <a class="control_prev" href="javascript:;">‹</a>
            <a class="control_next" href="javascript:;">›</a>
        </span>

        </div>
        <div class="carousel">

        <?foreach($arResult['ITEMS'] as $arItem):?>

            <?$arItemsSmall = CFile::ResizeImageGet($arItem['PREVIEW_PICTURE'], array('width' => 270, 'height' => 385), BX_RESIZE_IMAGE_EXACT);?>

            <div class="item">
                <img src="<?=$arItemsSmall['src']?>" alt="<?=$arItem['PREVIEW_PICTURE']['ALT']?>">
                <div class="name"><?=$arItem["NAME"]?></div>
                <div class="text"><?=$arItem["PREVIEW_TEXT"]?></div>
            </div>

        <?endforeach;?>

        </div>
</div>
<?php endif; ?>