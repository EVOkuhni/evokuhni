<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>

<div class="bas_callback_form form_style_num1">

<?if(isset($_REQUEST["formresult"]) && !isset($_REQUEST["bas_ok"]) && ($_REQUEST["formresult"] === 'addok')):?>

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

<?$arInfo = $arResult['QUESTIONS']['TITLE']?>
<?$strName = 'form_' . $arInfo['STRUCTURE'][0]['FIELD_TYPE'] . '_' . $arInfo['STRUCTURE'][0]['ID']?>
<input name="<?=$strName?>" value="<?=$arParams['TITLE'] ?>" type="hidden" class="order-title" <?=($arInfo['REQUIRED'] === 'Y') ? "required" : ""?>>

<?$arInfo = $arResult['QUESTIONS']['UF_CRM_1486630968']?>
<?$strName = 'form_' . $arInfo['STRUCTURE'][0]['FIELD_TYPE'] . '_' . $arInfo['STRUCTURE'][0]['ID']?>
<input name="<?=$strName?>" value="" type="hidden"   class="element-name-canv" <?=($arInfo['REQUIRED'] === 'Y') ? "required" : ""?>>
				
			<div class="input_margin">

				<?$arInfo = $arResult['QUESTIONS']['SIMPLE_QUESTION_594']?>
				<?$strName = 'form_' . $arInfo['STRUCTURE'][0]['FIELD_TYPE'] . '_' . $arInfo['STRUCTURE'][0]['ID']?>

				<input name="<?=$strName?>" value="<?=$arResult['arrVALUES'][$strName]?>" type="text" <?=($arInfo['REQUIRED'] === 'Y') ? "required" : ""?>>
			</div>
			<div class="input_margin">

				<?$arInfo = $arResult['QUESTIONS']['SIMPLE_QUESTION_887']?>
				<?$strName = 'form_' . $arInfo['STRUCTURE'][0]['FIELD_TYPE'] . '_' . $arInfo['STRUCTURE'][0]['ID']?>

				<input name="<?=$strName?>" value="<?=$arResult['arrVALUES'][$strName]?>" type="text" <?=($arInfo['REQUIRED'] === 'Y') ? "required" : ""?>>
			</div>
			<div class="input_margin">

				<?$arInfo = $arResult['QUESTIONS']['SIMPLE_QUESTION_789']?>
				<?$strName = 'form_' . $arInfo['STRUCTURE'][0]['FIELD_TYPE'] . '_' . $arInfo['STRUCTURE'][0]['ID']?>

				<input name="<?=$strName?>" value="<?=$arResult['arrVALUES'][$strName]?>" type="tel" <?=($arInfo['REQUIRED'] === 'Y') ? "required" : ""?>>
			</div>
			<div class="text-center">
				<input class="btn btn-primary" name="web_form_submit" value="Отправить" type="submit">
				<input name="bas_call" type="hidden" value="Y">
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