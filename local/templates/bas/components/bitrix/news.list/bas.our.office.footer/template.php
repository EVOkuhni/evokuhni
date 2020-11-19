<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>

<?if(count($arResult['ITEMS']) > 0):?>

<?foreach($arResult['ITEMS'] as $arItem):?>
<div class="footer__contacts-block">
    <a class="tel" href="tel:<?=$arItem['DISPLAY_PROPERTIES']['PHONE']['DESCRIPTION']?>"><?=$arItem['DISPLAY_PROPERTIES']['PHONE']['DISPLAY_VALUE']?></a>
    <a class="link" href="/contacts/#tab-studio-<?=$arItem['PROPERTIES']['EL_ABOUT']['VALUE']?>" data-tab="#tab-studio-<?=$arItem['PROPERTIES']['EL_ABOUT']['VALUE']?>"><?=$arItem['NAME']?></a>
</div>
<?endforeach?>

<?endif?>

<script>
$(function () {
    $('.footer__contacts-block .link').click(function () {
        var tab = $(this).data('tab');
        $('a[href="'+tab+'"]').click();
    });
})
</script>
