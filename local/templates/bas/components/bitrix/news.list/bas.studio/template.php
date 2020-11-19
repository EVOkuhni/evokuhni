<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();

$this->setFrameMode(false);

if (count($arResult["ITEMS"]) > 0):?>

	<div class="bas_studio">
		<div class="title">
			<span><?=$arParams['TITLE_H2']?></span>
		</div>
		<div class="row">
			<div class="col-sm-6">

	<?foreach($arResult["ITEMS"] as $intKey => $arItem):

		list($preview_text_first_line, $preview_text_second_line) = explode("\n", $arItem['PREVIEW_TEXT']);?>

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

						<a href="<?=$arItem['DISPLAY_PROPERTIES']['MORE_PICT']['BAS_FIRST']['SRC']?>" data-fancybox="bas_photo<?=$intKey?>_<?= $arParams['STUDIO_ID'] ?>" class="item" data-thumb="<?=$arItem['DISPLAY_PROPERTIES']['MORE_PICT']['BAS_FIRST']['SRC_SMALL']?>">
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

							<a data-fancybox="bas_photo<?=$intKey?>_<?= $arParams['STUDIO_ID'] ?>" data-thumb="<?=$arV['SRC_SMALL']?>" href="<?=$arV['SRC']?>"></a>

						<?endforeach;?>

						</div>

	<?endforeach;?>

					</div>
				</div>
			</div>
		</div>
	</div>

<?endif?>