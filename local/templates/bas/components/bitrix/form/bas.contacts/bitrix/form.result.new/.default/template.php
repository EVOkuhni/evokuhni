<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();

if ($arParams['STUDIO_ID'] == '7547') $arParams['STUDIO_ID'] = '76';
elseif ($arParams['STUDIO_ID'] == '7548') $arParams['STUDIO_ID'] = '75';
elseif ($arParams['STUDIO_ID'] == '8046') $arParams['STUDIO_ID'] = '84';
elseif ($arParams['STUDIO_ID'] == '8558') $arParams['STUDIO_ID'] = '93';
else $arParams['STUDIO_ID'] = '78';
?>

<div class="bas_contacts_form form_style_num1">

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

	<div class="block" style="background-color: #f6f7f9">
		<div class="title" style="text-align: center; font-size: 25px; color: #54306a">Приглашаем в салон</div>

		<?=$arResult["FORM_NOTE"]?>

	<?if($arResult["isFormNote"] != "Y"){?>

		<?=str_replace('<form name', "<form onsubmit=\"yaCounter45350511.reachGoal('order'); gtag('event', 'SendForm', {'event_category': 'form', 'event_action': 'submit', }); return true;\" name", $arResult["FORM_HEADER"])?>

		<div class="row justify-content-center">
			<div class="col-12 col-sm-9">
				<div class="input_margin">

					<?$arInfo = $arResult['QUESTIONS']['SIMPLE_QUESTION_557']?>
					<?$strName = 'form_' . $arInfo['STRUCTURE'][0]['FIELD_TYPE'] . '_' . $arInfo['STRUCTURE'][0]['ID']?>

					<input placeholder="<?=$arInfo['CAPTION']?> <?=($arInfo['REQUIRED'] === 'Y') ? "*" : ""?>" name="<?=$strName?>" value="<?=$arResult['arrVALUES'][$strName]?>" type="text" <?=($arInfo['REQUIRED'] === 'Y') ? "required" : ""?>>
				</div>
			</div>
			<div class="col-12 col-sm-9">
				<div class="input_margin">

					<?$arInfo = $arResult['QUESTIONS']['SIMPLE_QUESTION_440']?>
					<?$strName = 'form_' . $arInfo['STRUCTURE'][0]['FIELD_TYPE'] . '_' . $arInfo['STRUCTURE'][0]['ID']?>

					<input placeholder="<?=$arInfo['CAPTION']?> <?=($arInfo['REQUIRED'] === 'Y') ? "*" : ""?>" name="<?=$strName?>" value="<?=$arResult['arrVALUES'][$strName]?>" type="tel" <?=($arInfo['REQUIRED'] === 'Y') ? "required" : ""?>>
				</div>
			</div>

            <input type="hidden" name="form_dropdown_UF_CRM_1545046905" value="<?=$arParams['STUDIO_ID']?>">

		<?if($arResult["isUseCaptcha"] == "Y"):?>

			<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
				<div class="input_margin">
					<input type="hidden" name="captcha_sid" value="<?=htmlspecialcharsbx($arResult["CAPTCHACode"]);?>">
					<img src="/bitrix/tools/captcha.php?captcha_sid=<?=htmlspecialcharsbx($arResult["CAPTCHACode"]);?>">
				</div>
			</div>
			<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
				<div class="input_margin">
					<input type="text" name="captcha_word" value="" required placeholder="<?=GetMessage("FORM_CAPTCHA_FIELD_TITLE")?> *">
				</div>
			</div>

		<?endif?>
            <div class="col-12">
                <?=$arResult["FORM_FOOTER"]?>
            </div>

			<div class="col-12">
				<div class="input_margin text-center">
					<input type="submit" class="btn btn-primary" name="web_form_submit" value="Запланировать визит">
				</div>
			</div>
		</div>

	<?}?>

		<?$APPLICATION->IncludeComponent(
			"bas:variable.set",
			"user_consent",
			array(
				'ID' => '1',
				'BUTTON_NAME' => 'Отправить сообщение',
				'LINK' => '/privacypolicy/',
			),
			false
		);?>

	</div>

<?endif?>

</div>