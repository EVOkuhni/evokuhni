<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();

$this->setFrameMode(true);?>

<?if (count($arResult['ITEMS']) < 1) return;?>

<div class="bas_catalog_carousel_inner bas_catalog_section_style bas_<?=$arParams['BAS_CLASS']?>_color">
	<div class="container">

        <div class="header d-none d-md-block">
            <?if (count($arResult['ITEMS']) > 3):?>


                    <span class="carousel_control hidden-xs">
                        <a class="control_prev btn-skew" href="javascript:;">‹</a>
                        <a class="control_next btn-skew" href="javascript:;">›</a>
                    </span>

                    <span class="title"><?=$arParams['BAS_NAME']?></span>

            <?endif;?>
        </div>
		<div class="row">
			<div class="carousel">

			<?foreach($arResult['ITEMS'] as $arItem):?>
                <?php $arItem['DISPLAY_PROPERTIES'] = $arItem['PROPERTIES'] ?>

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

							<?//$arItemsSmall = CFile::ResizeImageGet($arItem['PREVIEW_PICTURE'], array('width' => $arItem['PREVIEW_PICTURE']['WIDTH']*(250/$arItem['PREVIEW_PICTURE']['HEIGHT']), 'height' => 250), BX_RESIZE_IMAGE_EXACT, false, false, false, 85);?>
                            <?$arItemsSmall = CFile::ResizeImageGet($arItem['PREVIEW_PICTURE'], array('width' => 1000, 'height' => 250), BX_RESIZE_IMAGE_PROPORTIONAL, false, false, false, 85);?>

							<img src="<?=$arItemsSmall['src']?>" alt="<?=$arItem['PREVIEW_PICTURE']['ALT']?>">


						<?else:?>

							<img src="<?=SITE_TEMPLATE_PATH?>/img/no.pict.jpg" alt="No Photo" title="<?=$arItem['NAME']?>">

						<?endif?>

						</a>
						<?foreach($arItem['PROPERTIES'] as $key=>$prop)
						{
							if ((strpos($key, 'MAT')!==false && strpos($key,'SYYL_MAT_OBIV')===false
								||($key=="VP_TIP")
								||($key=="BYTIJ_SETUP")
								||($key=="PM_TIP_YSTAN")
								||($key=="MICROWAVE_RASPOLG")
								||($key=="XOLOD_RASPOLG")
								||($key=="STIRAL_RASPOLG")
								||($key=="ALL_STYLE"&&$arParams['SECTION_CODE']=="parovarki")
								||($key=="KOFE_TIP")
								||($key=="DYX_PODKL")
								)&&$prop['VALUE']
								)
							{
								$mat = (is_array( $prop['VALUE'] )) ? $prop['VALUE'][0] : $prop['VALUE'];
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
                                    <?if ($arItem['IBLOCK_ID'] == 4):?>
									<span class="price">
                                        <b>
                                            от
                                            <?=$arParams['BAS_BEFORE_PRICE']?>
                                            <?=number_format($arItem['DISPLAY_PROPERTIES']['PRICE']['VALUE'], 0, '', ' ')?>
                                            руб.
                                        </b>
                                        <br/>
                                        <?=$arItem['SECTION_DATA']['UF_ZA']?>
                                    </span>
                                    <?php endif; ?>
								</div>
                                <?php
								 if (in_array($arItem['IBLOCK_SECTION_ID'], [
                                        6, //Техника
                                        9, //Мойки
                                        8, //Фурнитура и аксессуары
                                        5, //Комплектующие
                                        7, 10, 11, 20, 12, 13, 14, 15, 16, 17, 18, 19, 27, 32, 31, 39, 33, 36, 35, 38, 34, 37, 40,
                                ]))
                                {
                                    $btn_type = 'detail';
                                }
                                else
                                    $btn_type = 'form';
                                ?>
                                <div class="right">
                                    <?php if($btn_type == 'form'): ?>
                                    <a href="javascript:;" class="btn btn-default bold btn-detail basOrderMake btn-skew"><span>ЗАКАЗАТЬ <span style="font-weight: normal">РАСЧЕТ</span></span></a>
                                    <?php elseif($btn_type == 'detail'): ?>
                                    <a href="<?= $arItem['DETAIL_PAGE_URL'] ?>" class="btn btn-default btn-detail btn-detail-one bold btn-skew" style="font-weight: normal"><span>ПОДРОБНЕЕ</span></a>
                                    <?php else: ?>
                                    <a href="javascript:;" class="btn btn-default bold btn-detail btn-detail-one basOrderMake btn-skew"><span>ЗАКАЗАТЬ</span></a>
                                    <?php endif; ?>
                                </div>
							</div>
						</div>
					</div>
				</div>

			<?endforeach;?>

			</div>
		</div>
        <div class="row justify-content-center">
            <a href="/seen/" class="btn btn-special btn-skew"><span>Посмотреть все</span></a>
        </div>
	</div>
</div>