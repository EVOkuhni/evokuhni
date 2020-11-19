<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();

$this->setFrameMode(false);
?>

<div class="bas_ceh">
	<div class="title"><?=$arParams['TITLE_H2']?></div>
	<div class="row">
		<div class="col-sm-6">

<?foreach($arResult["ITEMS"] as $intKey => $arItem):
    list($preview_text_first_line, $preview_text_second_line) = explode("\n", $arItem['PREVIEW_TEXT']);
?>

		<?$file = CFile::ResizeImageGet($arItem["PREVIEW_PICTURE"]['ID'], array('width' => 263, 'height' => 140), BX_RESIZE_IMAGE_EXACT, true)?>

	<?if($intKey == 0):?>

		<?$file = CFile::ResizeImageGet($arItem["PREVIEW_PICTURE"]['ID'], array('width' => 555, 'height' => 310), BX_RESIZE_IMAGE_EXACT, true)?>

	<?elseif($intKey == 1):?>

		</div>
		<div class="col-sm-6">
			<div class="row">
				<div class="col-sm-6 col-xs-6">

	<?elseif($intKey == 3):?>

				</div>
				<div class="col-sm-6 col-xs-6">

	<?endif?>
					<a data-fancybox-link="bas_ceh_<?= $intKey ?>" href="<?=$arItem["PREVIEW_PICTURE"]['SRC']?>"
                       class="item <?= $intKey > 4? 'd-none' : '' ?> bas_block_shadow"
                    >
						<img src="<?=$file["src"]?>" alt="<?=$arItem["PREVIEW_PICTURE"]["ALT"]?>">
						<span class="text">
                            <?=$preview_text_first_line?>
                            <small><?= $preview_text_second_line ?></small>
                        </span>
					</a>
					<div class="d-none caption">
						<?=$arItem["DETAIL_TEXT"]?>
					</div>
                    <div class="d-none">
                    <?foreach($arItem['DISPLAY_PROPERTIES']['MORE_PICT']['FILE_VALUE'] as $arV):?>

                        <a data-fancybox="bas_ceh_<?= $intKey ?>" data-thumb="<?=$arV['SRC_SMALL']?>" href="<?=$arV['SRC']?>"></a>

                    <?endforeach;?>
                    </div>
<?endforeach;?>

				</div>
			</div>
		</div>
	</div>
</div>