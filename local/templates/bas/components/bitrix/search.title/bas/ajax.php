<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();

if (empty($arResult["CATEGORIES"])) return;?>

<div class="bx_searche">

<?foreach($arResult["CATEGORIES"] as $category_id => $arCategory):?>

	<?foreach($arCategory["ITEMS"] as $i => $arItem):?>

		<?if($category_id === "all"):?>

			<a href="<?=$arItem["URL"]?>">
				<div class="bx_item_block" style="min-height:0">
					<div class="bx_img_element"></div>
					<div class="bx_item_element"><hr></div>
				</div>
				<div class="bx_item_block all_result">
					<div class="bx_img_element"></div>
					<div class="bx_item_element">
						<span class="all_result_title"><?=$arItem["NAME"]?></span>
					</div>
				</div>
			</a>

		<?elseif(isset($arResult["ELEMENTS"][$arItem["ITEM_ID"]])):

			$arElement = $arResult["ELEMENTS"][$arItem["ITEM_ID"]];?>

			<a href="<?=$arItem["URL"]?>">
				<div class="bx_item_block">
					<?if (is_array($arElement["PICTURE"])):?>
					<div class="bx_img_element">
						<div class="bx_image" style="background-image: url('<?echo $arElement["PICTURE"]["src"]?>')"></div>
					</div>
					<?endif;?>
					<div class="bx_item_element">
						<div class="name"><?=$arItem["NAME"]?></div>
						<div class="bx_price"><?=$arElement["PRICE"]?></div>
					</div>
				</div>
			</a>

		<?else:?>

			<a href="<?=$arItem["URL"]?>">
				<div class="bx_item_block others_result">
					<div class="bx_img_element"></div>
					<div class="bx_item_element">
						<div class="name"><?=$arItem["NAME"]?></div>
					</div>
				</div>
			</a>

		<?endif;?>

	<?endforeach;?>

<?endforeach;?>

</div>