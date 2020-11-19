<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>

<div class="bas_action_form form_style_num1">

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
	<?if($USER->IsAdmin()):?>
	<pre><?//print_r($arResult);?></pre>
	<?endif;?>
 
	<?=$arResult["FORM_NOTE"]?>

	<?if($arResult["isFormNote"] != "Y"){?>

		<?=str_replace('<form name', "<form name", $arResult["FORM_HEADER"])?>

			<?$arInfo = $arResult['QUESTIONS']['TITLE']?>
			<?$strName = 'form_' . $arInfo['STRUCTURE'][0]['FIELD_TYPE'] . '_' . $arInfo['STRUCTURE'][0]['ID']?>

			<input name="<?=$strName?>" value="" type="hidden" id="actionTitle">
 
		 
				<input type="hidden" name="form_dropdown_SIMPLE_QUESTION_801" value="<?=$arResult["arAnswers"]["SIMPLE_QUESTION_801"][0]["ID"]?>" />	 

			<div class="input_margin">

				<?$arInfo = $arResult['QUESTIONS']['SIMPLE_QUESTION_264']?>
				<?$strName = 'form_' . $arInfo['STRUCTURE'][0]['FIELD_TYPE'] . '_' . $arInfo['STRUCTURE'][0]['ID']?>

				<input placeholder="<?=$arInfo['CAPTION']?>" name="<?=$strName?>" value="<?=$arResult['arrVALUES'][$strName]?>" type="text" <?=($arInfo['REQUIRED'] === 'Y') ? "required" : ""?>>
			</div>
			<div class="input_margin">

				<?$arInfo = $arResult['QUESTIONS']['SIMPLE_QUESTION_167']?>
				<?$strName = 'form_' . $arInfo['STRUCTURE'][0]['FIELD_TYPE'] . '_' . $arInfo['STRUCTURE'][0]['ID']?>

				<input placeholder="<?=$arInfo['CAPTION']?>" name="<?=$strName?>" value="<?=$arResult['arrVALUES'][$strName]?>" type="tel" <?=($arInfo['REQUIRED'] === 'Y') ? "required" : ""?>>
			</div>

            <div class="input_margin">

				<?$arInfo = $arResult['QUESTIONS']['SIMPLE_QUESTION_915']?>
				<?$strName = 'form_' . $arInfo['STRUCTURE'][0]['FIELD_TYPE'] . '_' . $arInfo['STRUCTURE'][0]['ID']?>

                <textarea placeholder="<?=$arInfo['CAPTION']?>" name="<?=$strName?>" <?=($arInfo['REQUIRED'] === 'Y') ? "required" : ""?>><?=$arResult['arrVALUES'][$strName]?></textarea>
			</div>

            <div class="input_margin">
                <div class="our_form_styler">
                    <div class="title">
                        Прикрепить резюме
                    </div>
                    <?=$arResult['QUESTIONS']['SIMPLE_QUESTION_372']['HTML_CODE']?>
                </div>
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