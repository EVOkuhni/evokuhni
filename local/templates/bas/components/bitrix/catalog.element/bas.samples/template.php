<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();

$this->setFrameMode(true);?>

<div class="bas_catalog_element" itemscope itemtype="https://schema.org/Product">
    <div itemprop="aggregateRating"
    itemscope itemtype="http://schema.org/AggregateRating">
       <span itemprop="ratingValue" content="5"></span>
       <span itemprop="reviewCount" content="1"></span>
    </div>
    <span itemprop="brand" content="<?= explode(' ',$arResult['NAME'])[0] ?>"></span>
	<div class="container">
		<div class="row">
			<div class="col-xl-9 col-lg-8">
				<div class="big_img">

				<?if($arResult['SECTION']['UF_SHOW_ICON']):?>

					<div class="bas_catalog_icon">
						<img src="<?=$templateFolder?>/img/icon1.png" alt="">
						<img src="<?=$templateFolder?>/img/icon2.png" alt="">
						<img src="<?=$templateFolder?>/img/icon3.png" alt="">
						<img src="<?=$templateFolder?>/img/icon4.png" alt="">
					</div>

				<?endif?>

				<?if($arResult['PROPERTIES']['STAT']['VALUE_XML_ID'] === 'N'):?>

					<div class="bas_catalog_label">Новинка</div>

				<?elseif($arResult['PROPERTIES']['STAT']['VALUE_XML_ID'] === 'H'):?>

					<div class="bas_catalog_label green">ХИТ</div>

				<?endif?>

                    <?php $arItemsBig = CFile::ResizeImageGet($arResult['PROPERTIES']['MORE_PICT']['VALUE'][0], array('width' => 1694, 'height' => 1000), BX_RESIZE_IMAGE_PROPORTIONAL, false, false, false, 85); ?>
                    <span itemprop="image" content="https://<?= $_SERVER['SERVER_NAME'].$arItemsBig['src'] ?>"></span>
                    <span itemprop="sku" content="<?= $arResult['ID'] ?>"></span>

					<div id="fotorama" data-click="false" data-keyboard="true" data-allowfullscreen="true" data-thumbwidth="195" data-thumbheight="110" data-nav="thumbs" data-loop="true">

					<?foreach($arResult['PROPERTIES']['MORE_PICT']['VALUE'] as $intKey => $arItem):?>

						<?
						$arItemsSmall = CFile::ResizeImageGet($arItem, array('width' => 195, 'height' => 110), BX_RESIZE_IMAGE_EXACT, true, false, false, 85);
						$arItemsBig = CFile::ResizeImageGet($arItem, array('width' => 1694, 'height' => 1000), BX_RESIZE_IMAGE_PROPORTIONAL, false, false, false, 85);
						?>

						<a href="<?=$arItemsBig['src']?>">
							<img src="<?=$arItemsSmall['src']?>" alt="<?$APPLICATION->ShowTitle(false)?> (фото <?=($intKey + 1)?>)">
						</a>

					<?endforeach;?>

					</div>
				</div>

			<?if(!$arResult['SECTION']['UF_HIDE_BAN'] && $arResult['SECTION']['UF_BANNER_CART']):?>

				<div class="info_block text-center bas_our_margin">
					<div>
						<span><?=$arResult['SECTION']['UF_BANNER_CART']?></span>
					</div>
				</div>

			<?endif?>

			</div>

			<div class="col-xl-3 col-lg-4 basTovarBlock">
                <div itemprop="review" itemscope itemtype="http://schema.org/Review">
                    <span itemprop="author" class="d-none">Lucas</span>
                    <span itemprop="description" class="d-none"><?= $arResult['NAME'] ?> отлично</span>
                    <div style="color: orange" class="text-right mb-1 mr-1" itemprop="reviewRating" itemscope itemtype="http://schema.org/Rating">
                        <meta itemprop="worstRating" content="1"/>
                        <meta itemprop="bestRating" content="5"/>
                        <meta itemprop="ratingValue" content="5"/>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                    </div>
                </div>
				<h1 class="text-left-sm text-center-xs basTovarName" itemprop="name"><?$APPLICATION->ShowTitle(false)?></h1>
				<div class="block text-left-sm text-center-xs">
					<div class="left" itemprop="offers" itemscope itemtype="https://schema.org/Offer">
                        <link itemprop="availability" href="http://schema.org/InStock" />
                        <span itemprop="priceValidUntil" content="<?= date('Y-m-d', time() + 3600*24*365) ?>"></span>
                        <span itemprop="url" content="https://<?= $_SERVER['SERVER_NAME'].$arResult['DETAIL_PAGE_URL'] ?>"></span>

                    <?if ($arParams["HIDE_PRICE"] !== 'Y'):?>

						<span class="price">
                            <?if($arResult['SECTION']['UF_SHOW_FROM']):?> от <?endif ?>
                            <span itemprop="price" content="<?= $arResult['PROPERTIES']['PRICE']['VALUE'] ?>"><?=number_format($arResult['PROPERTIES']['PRICE']['VALUE'], 0, '', ' ')?></span>
                            <span itemprop="priceCurrency" content="RUB">руб.</span>
                            <?if($arResult['SECTION']['UF_DESC_PRICE']!=""):?>
                                <span class="red_star">*</span>
                            <?endif?>
						</span>   
						<span class="ed"><?=$arResult['SECTION']['UF_ZA']?></span>
						<meta itemprop="priceCurrency" content="RUB" />

                    <?endif?>

					</div>
					<div class="right">
						<a href="javascript:;" class="btn btn-default bold basOrderMake btn-skew"><span>ЗАКАЗАТЬ</span></a>
					</div>
				</div>
				<div class="text-left-sm text-center-xs">
					<a href="/credit/" class="info">Информация о рассрочке</a>
				</div>
				<table class="table table-striped">

				<?foreach($arResult['DISPLAY_PROPERTIES'] as $arItem):?>

					<tr>
						<th><?=$arItem['NAME']?></th>
						<td>
							<?$i=0;

							if (is_array($arItem['DISPLAY_VALUE']))
							{
								foreach($arItem['DISPLAY_VALUE'] as $display_value)
								{
									if($i>0) echo ", ";
									echo $display_value;
									$i++;
								}
							}
							else echo $arItem['DISPLAY_VALUE'];?>
						</td>
					</tr>

				<?endforeach?>

				</table>

			<?if($arResult['RAZM_PROPERTIES']):?>

				<table class="table table-striped">
					<thead>
						<tr>
							<th colspan="2" class="text-center">Размер</th>
						</tr>
					</thead>
					<tbody>
					<?foreach($arResult['RAZM_PROPERTIES'] as $arItem):?>
						<tr>
							<th><?=$arItem['NAME']?></th>
							<td><?=$arItem['DISPLAY_VALUE']?><?=strpos($arItem['DISPLAY_VALUE'],"мм")===false?" мм":"" ?></td>
						</tr>
					<?endforeach?>

					</tbody>
				</table>

			<?endif?>

				<div class="link text-center row icon_sprite_one_detail">

				<?if($arResult['SECTION']['UF_SHOW_BTN_NUM1']):?>

					<div class="col-lg-12 col-md-4">
						 
						<a href="javascript:;" class="link_num1 basOrderMake" form-name="Заказать дизайн">
							Заказать дизайн<br>
							<i>Бесплатно</i>
						</a>
					</div>

				<?endif?>
				<?if($arResult['SECTION']['UF_SHOW_BTN_NUM2']):?>

					<div class="col-lg-12 col-md-4">
						<a href="javascript:;" class="link_num2 basOrderMake" form-name="Выезд дизайнера">
							Выезд дизайнера<br> 
							на дом <i>Бесплатно</i>
						</a>
					</div>

				<?endif?>
				<?if($arResult['SECTION']['UF_SHOW_BTN_NUM3']):?>

					<div class="col-lg-12 col-md-4">
					 
						<a href="javascript:;" class="link_num3 basOrderMake" form-name="Заказать расчет">
							Заказать расчет <br> стоимости
						</a>
					</div>

				<?endif?>

				<?if($arResult['SECTION']['UF_SHOW_BTN_ONE']):?>

					<div class="col-lg-12 col-md-4">
						<a href="javascript:;" class="link_num3 basOrderMake" form-name="Уточнить цену и узнать скидку">
							Уточнить цену и<br>
							получить скидку
						</a>
					</div>

				<?endif?>

				<?if($arResult['SECTION']['UF_DESC_PRICE']!=""):?>

					<div class="col-lg-12 col-md-4">
						<div class="tovcom">
							<span class="red_star">*</span> <?=$arResult['SECTION']['UF_DESC_PRICE']?>
						</div>
					</div>

				<?endif?>

				<?if($arResult['SECTION']['UF_TOV_COM']!=""):?>

					<div class="col-lg-12 col-md-4">
						<div class="tovcom">
							<span class="red_star">*</span> <?=$arResult['SECTION']['UF_TOV_COM']?>
						</div>
					</div>

				<?endif?>

				</div>
                <div style="padding: 10px 10px 20px 10px">
                    Поделиться:
                    <script src="//yastatic.net/es5-shims/0.0.2/es5-shims.min.js"></script>
                    <script src="//yastatic.net/share2/share.js"></script>
                    <div class="ya-share2" data-services="vkontakte,facebook,odnoklassniki,twitter,viber,whatsapp,skype,telegram"></div>
                </div>
			</div>
		</div>

	<?/* if($arResult['COLOR_VALUE']): */?>

		<div class="text_line">
			<div class="row">
				<div class="<?=($arResult['COLOR_VALUE'] ? 'col-lg-6 col-md-7 order-2 order-md-1' : 'col-12')?>">

				<?if($arResult['DETAIL_TEXT']):?>

					<div class="title">Описание</div>
					<div class="text bas_our_margin" itemprop="description" >
						<?=$arResult['DETAIL_TEXT']?>
					</div>

				<?endif?>

				</div>

			<?if($arResult['COLOR_VALUE']):?>

				<div class="col-lg-6 col-md-5 order-1 order-md-2">

				<?foreach($arResult['COLORS'] as $intKey => $coloredData):?>

					<div class="title">
						<?=$coloredData['TITLE'] ? $coloredData['TITLE'] : "Доступные цвета";?>
						<div class="btn_elem">
                            <a href="javascript:;" class="btn btn-success btn-md d-none d-xl-inline-block btn-skew btn-style2"><span>Посмотреть все</span></a>
						</div>
					</div>
					<div class="color">
						<div class="slider">

						<?foreach($coloredData['VALUES'] as $idValue => $colorFile):?>

							<div class="item">
								<a href="<?=$colorFile['FILE']?>" data-thumb="<?=$colorFile['FILE_TUMB']?>" class="fancybox_color" data-fancybox="bas_color<?=$intKey?>" data-caption="<?=$colorFile['NAME']?>">
									<i>
										<img src="<?=$colorFile['FILE_SMALL']?>" alt="<?=$colorFile['NAME']?>">
									</i>
									<span><?=$colorFile['NAME']?></span>
								</a>
							</div>

						<?endforeach?>

						</div>
					</div>

				<?endforeach?>

				</div>

			<?endif?>

			</div>
		</div>

	<?/* endif */?>

	</div>
</div>