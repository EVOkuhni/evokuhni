<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();

$this->setFrameMode(false);?>

<script>
/*     $(function () {
        $('.open-gallery-btn').click(function (e) {
            e.preventDefault();
            $('a[data-fancybox="bas_photo0_'+$(this).data('id')+'"]:first').click();
        });
    }) */
</script>

<div class="row">
    <?php foreach ($arResult['ITEMS'] as $arItem): ?>
    <?php/* 
        $q = CIBlockElement::GetList(array(),array('IBLOCK_ID' => 7, 'PROPERTY_EL_ABOUT' => $arItem['ID']),false,false,array('ID'));
        $res = $q->GetNext();
    */ ?>
    <?$file = CFile::ResizeImageGet($arItem["PREVIEW_PICTURE"]['ID'], array('width' => 540, 'height' => 270), BX_RESIZE_IMAGE_EXACT, true)?>
    <div class="col-12 col-lg-4" id="<?=$this->GetEditAreaId($arItem['ID']);?>">
        <div>
            <a href="/contacts/#tab-studio-gallery-<?= $arItem['ID'] ?>">
                <img class="about-studio__img" src="<?= $file['src'] ?>" alt="<?= $arItem['NAME'] ?>">
            </a>
        </div>
        <div class="about-studio-card">
            <h2 class="about-studio-title"><?= $arItem['NAME'] ?></h2>
            <div style="margin-top: 23px; margin-bottom: 16px">
                <strong style="font-size: 18px">Реквизиты</strong>
            </div>
            <div style="line-height: 21px">
                <?= $arItem['PREVIEW_TEXT'] ?>
            </div>
            <hr>
            <div class="text-center">
                <a href="/contacts/#tab-studio-<?= $arItem['ID'] ?>" class="btn btn-default">ПОСМОТРЕТЬ КОНТАКТЫ</a>
            </div>
        </div>
    </div>
    <?php endforeach; ?>
</div>