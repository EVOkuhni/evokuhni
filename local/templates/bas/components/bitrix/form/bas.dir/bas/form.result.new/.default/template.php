<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>

<script src="https://www.google.com/recaptcha/api.js" async defer></script>
<style>
    .g-recaptcha {
        transform: scale(0.8);
        margin-left: -29px;
    }

    @media screen and (max-width: 576px){
        .g-recaptcha {
            transform: none;
            margin-left: auto;
        }
    }
</style>

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


			<?=str_replace('<form name', "<form onsubmit=\"yaCounter45350511.reachGoal('director'); gtag('event', 'SendForm', {'event_category': 'form', 'event_action': 'submit', }); return true;\" name", $arResult["FORM_HEADER"])?>

			<div class="input_margin">

				<?$arInfo = $arResult['QUESTIONS']['NAME']?>
				<?$strName = 'form_' . $arInfo['STRUCTURE'][0]['FIELD_TYPE'] . '_' . $arInfo['STRUCTURE'][0]['ID']?>

				<input placeholder="<?=$arInfo['CAPTION']?>" name="<?=$strName?>" value="<?=$arResult['arrVALUES'][$strName]?>" type="text" <?=($arInfo['REQUIRED'] === 'Y') ? "required" : ""?>>
			</div>
			<div class="input_margin">

				<?$arInfo = $arResult['QUESTIONS']['PHONE_WORK']?>
				<?$strName = 'form_' . $arInfo['STRUCTURE'][0]['FIELD_TYPE'] . '_' . $arInfo['STRUCTURE'][0]['ID']?>

				<input placeholder="<?=$arInfo['CAPTION']?>" name="<?=$strName?>" value="<?=$arResult['arrVALUES'][$strName]?>" type="tel" <?=($arInfo['REQUIRED'] === 'Y') ? "required" : ""?>>
			</div>
			<div class="input_margin">

				<?$arInfo = $arResult['QUESTIONS']['COMMENTS']?>
				<?$strName = 'form_' . $arInfo['STRUCTURE'][0]['FIELD_TYPE'] . '_' . $arInfo['STRUCTURE'][0]['ID']?>

				<textarea placeholder="<?=$arInfo['CAPTION']?>" name="<?=$strName?>" class="inputtextarea" <?=($arInfo['REQUIRED'] === 'Y') ? "required" : ""?>><?=$arResult['arrVALUES'][$strName]?></textarea>
			</div>
            <div class="input_margin">

                <?php
                $select = str_replace('<select', '<select required', $arResult['QUESTIONS']['UF_CRM_1545046905']['HTML_CODE']);
                $pos = strpos($select, '<option');
                $select = substr_replace($select, '<option value="" >Выберите студию*</option>', $pos, 0);
                ?>
                <?= $select ?>

			</div>

            <div class="g-recaptcha" data-sitekey="<?= ReCaptchaVerifier::SITE_KEY ?>"></div>

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