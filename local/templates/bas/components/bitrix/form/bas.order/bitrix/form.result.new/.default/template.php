<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>

<div class="bas_order_form form_style_num1">

<?if(isset($_REQUEST["formresult"]) && ($_REQUEST["formresult"] === 'addok')):?>

	<div class="alert alert-success">
		Спасибо, Ваша заявка принята!
	</div>

<?else:?>

	<?if ($arResult["isFormErrors"] == "Y"):?>

		<div class="alert alert-danger">
			<?=$arResult["FORM_ERRORS"];?>
		</div>

	<?endif;?>

	<?=$arResult["FORM_NOTE"]?>

	<?if($arResult["isFormNote"] != "Y"){?>

		<?=str_replace('<form name', "<form onsubmit=\"yaCounter45350511.reachGoal('order'); gtag('event', 'SendForm', {'event_category': 'form', 'event_action': 'submit', }); return true;\" name", $arResult["FORM_HEADER"])?>

			<div class="hide">

				<?$arInfo = $arResult['QUESTIONS']['UF_CRM_1486630968']?>
				<?$strName = 'form_' . $arInfo['STRUCTURE'][0]['FIELD_TYPE'] . '_' . $arInfo['STRUCTURE'][0]['ID']?>

				<input name="<?=$strName?>" value="" type="hidden" id="basOrderTovar">

				<?$arInfo = $arResult['QUESTIONS']['TITLE']?>
				<?$strName = 'form_' . $arInfo['STRUCTURE'][0]['FIELD_TYPE'] . '_' . $arInfo['STRUCTURE'][0]['ID']?>

				<input name="<?=$strName?>" value="Заказ товара" type="hidden" id="basOrderFormName">

			</div>
			<div class="tvr input_margin">
				<div id="basTvrName"></div>
				<div id="basTvrPrice"></div>
			</div>
			<div class="input_margin">

				<?$arInfo = $arResult['QUESTIONS']['SIMPLE_QUESTION_594']?>
				<?$strName = 'form_' . $arInfo['STRUCTURE'][0]['FIELD_TYPE'] . '_' . $arInfo['STRUCTURE'][0]['ID']?>

				<input placeholder="<?=$arInfo['CAPTION']?>" name="<?=$strName?>" value="<?=$arResult['arrVALUES'][$strName]?>" type="text" <?=($arInfo['REQUIRED'] === 'Y') ? "required" : ""?>>
			</div>
			<div class="input_margin">

				<?$arInfo = $arResult['QUESTIONS']['SIMPLE_QUESTION_789']?>
				<?$strName = 'form_' . $arInfo['STRUCTURE'][0]['FIELD_TYPE'] . '_' . $arInfo['STRUCTURE'][0]['ID']?>

				<input placeholder="<?=$arInfo['CAPTION']?>" name="<?=$strName?>" value="<?=$arResult['arrVALUES'][$strName]?>" type="tel" <?=($arInfo['REQUIRED'] === 'Y') ? "required" : ""?>>
			</div>
			<div class="input_margin">

				<?$arInfo = $arResult['QUESTIONS']['SIMPLE_QUESTION_887']?>
				<?$strName = 'form_' . $arInfo['STRUCTURE'][0]['FIELD_TYPE'] . '_' . $arInfo['STRUCTURE'][0]['ID']?>

				<input placeholder="<?=$arInfo['CAPTION']?>" name="<?=$strName?>" value="<?=$arResult['arrVALUES'][$strName]?>" type="email" <?=($arInfo['REQUIRED'] === 'Y') ? "required" : ""?>>
			</div>
            <div class="input_margin">

                <?php
                $select = str_replace('<select', '<select required', $arResult['QUESTIONS']['UF_CRM_1545046905']['HTML_CODE']);
                $pos = strpos($select, '<option');
                $select = substr_replace($select, '<option value="" >Выберите студию*</option>', $pos, 0);
                ?>
                <?= $select ?>

            </div>
            <div class="input_margin">
                <div class="our_form_styler">
                    <div class="title">
                        Прикрепить<br>
                        чертеж/схему/эскиз*
                    </div>
                    <?=$arResult['QUESTIONS']['SIMPLE_QUESTION_209']['HTML_CODE']?>
                    <?=$arResult['QUESTIONS']['SIMPLE_QUESTION_813']['HTML_CODE']?>
                    <?=$arResult['QUESTIONS']['SIMPLE_QUESTION_439']['HTML_CODE']?>
                </div>
            </div>
			<div class="text-center input_margin">
				<input class="btn btn-primary" name="web_form_submit" value="Заказать" type="submit">
			</div>

			<?$APPLICATION->IncludeComponent(
				"bas:variable.set",
				"user_consent",
				array(
					'ID' => '1',
					'BUTTON_NAME' => 'Отправить',
					'LINK' => '/privacypolicy/',
				),
				false
			);?>

		<?=$arResult["FORM_FOOTER"]?>

	<?}?>

<?endif?>

</div>