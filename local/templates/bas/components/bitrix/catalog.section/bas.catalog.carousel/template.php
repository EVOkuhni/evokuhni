<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();

$this->setFrameMode(true);?>

<?if (count($arResult['ITEMS']) < 1) return;?>

<div class="bas_catalog_carousel bas_catalog_section_style">
	<div class="topline">

	<?if (count($arResult['ITEMS']) > 3):?>

		<span class="carousel_control d-none d-md-block">
			<a class="control_prev btn-skew" href="javascript:;">‹</a>
			<a class="control_next btn-skew" href="javascript:;">›</a>
		</span>

	<?endif;?>

	</div>
	<div class="middle row">
		<div class="carousel">

		<?foreach($arResult['ITEMS'] as $arItem):?>

			<div class="item basTovarBlockWrap">
                <?if($arItem['DISPLAY_PROPERTIES']['STAT']['VALUE_XML_ID'] === 'N'):?>

                        <div class="catalog-label">
							<span class="catalog-label__inner">Новинка</span>
						</div>

                    <?elseif($arItem['DISPLAY_PROPERTIES']['STAT']['VALUE_XML_ID'] === 'H'):?>

                        <div class="catalog-label catalog-label_red">
							<span class="catalog-label__inner">ХИТ</span>
						</div>

                    <?endif?>
				<div class="block bas_block_shadow bas_our_margin basTovarBlock">

					<a class="img" href="<?=$arItem['DETAIL_PAGE_URL']?>" <?=(COption::GetOptionString("askaron.settings", "UF_SHOW_IN_NEW_TAB") ? 'target="_blank"' : '')?>>

					<?if($arItem['PREVIEW_PICTURE']['SRC']):?>

						<?
						if ($arItem['PREVIEW_PICTURE']['WIDTH'] > $arItem['PREVIEW_PICTURE']['HEIGHT']) $arItemsSmall = CFile::ResizeImageGet($arItem['PREVIEW_PICTURE'], array('width' => 360, 'height' => 250), BX_RESIZE_IMAGE_EXACT, false, false, false, 85);
						else $arItemsSmall = CFile::ResizeImageGet($arItem['PREVIEW_PICTURE'], array('width' => $arItem['PREVIEW_PICTURE']['WIDTH']*(250/360), 'height' => 250), BX_RESIZE_IMAGE_PROPORTIONAL_ALT, false, false, false, 85);?>

						<img src="<?=$arItemsSmall['src']?>" alt="<?=$arItem['PREVIEW_PICTURE']['ALT']?>">

					<?else:?>

						<img src="<?=SITE_TEMPLATE_PATH?>/img/no.pict.jpg" alt="No Photo" title="<?=$arItem['NAME']?>">

					<?endif?>

					</a>

					<?foreach($arItem['PROPERTIES'] as $key=>$prop)
					{
						if (strpos($key, 'MAT')!==false && $prop['VALUE'] && strpos($key, 'MAT_OB')===false)
						{
							$mat = (is_array( $prop['VALUE'] )) ? implode(", ",$prop['VALUE']) : $prop['VALUE'];
						}
					}?>

					<div class="info">
						<a href="<?=$arItem['DETAIL_PAGE_URL']?>" class="name basTovarName" <?=(COption::GetOptionString("askaron.settings", "UF_SHOW_IN_NEW_TAB") ? 'target="_blank"' : '')?>><?=$arItem['NAME']?></a>
						<div class="top row no-gutters justify-content-between">
							<div class="left">
								<span class="mat" data-toggle="tooltip" data-placement="top" title="<?=$mat?>">
									<?=$mat?>
								</span>
							</div>
							<div class="right">
								<div class="country">

								<?if($arResult['COUNTRY'][$arItem['DISPLAY_PROPERTIES']['COUNTRY']['VALUE']]):?>

									<span>Произведено:</span>
									<img src="<?=$arResult['COUNTRY'][$arItem['DISPLAY_PROPERTIES']['COUNTRY']['VALUE']]?>" alt="<?=$arItem['DISPLAY_PROPERTIES']['COUNTRY']['DISPLAY_VALUE']?>">

								<?endif?>

								</div>
							</div>
						</div>
						<div class="row no-gutters justify-content-between align-items-center">
							<div class="left">
                                <?php if($arItem['IBLOCK_ID'] == 4): ?>
								<span class="price">
                                    <b>
                                        <?=$arParams['BAS_BEFORE_PRICE']?>
                                        <?=number_format($arItem['DISPLAY_PROPERTIES']['PRICE']['VALUE'], 0, '', ' ')?>
                                        руб.
                                    </b>
                                    <br/>
                                    <?=$arItem['SECTION_DATA']['UF_ZA']?>
                                </span>
                                <?php endif; ?>
							</div>
							<div class="right">
								<a href="javascript:;" class="btn btn-default bold btn-detail basOrderMake btn-skew"><span>ЗАКАЗАТЬ <span style="font-weight: normal">РАСЧЕТ</span></span></a>
							</div>
						</div>
					</div>
				</div>
			</div>

		<?endforeach;?>

		</div>
	</div>
	<div class="bottom">
        <a href="<?=$arParams['BAS_NAME_LINK']?>" class="btn btn-style1 btn-xl btn-skew"><span>Посмотреть все</span></a>
	</div>
</div>