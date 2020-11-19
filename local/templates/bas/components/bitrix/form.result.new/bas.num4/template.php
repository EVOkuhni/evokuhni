<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>

<a id="toq"></a>

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

	<?if ($arResult["isFormNote"] != "Y"): ?>

        <?$arResult["FORM_HEADER"] = str_replace('" method', '#toq" method', $arResult["FORM_HEADER"])?>

		<?=str_replace('<form name', "<form onsubmit=\"yaCounter45350511.reachGoal('order'); gtag('event', 'SendForm', {'event_category': 'form', 'event_action': 'submit', }); return true;\" name", $arResult["FORM_HEADER"])?>

        <?$arInfo = $arResult['QUESTIONS']['PHONE_WORK']?>
        <?$strName = 'form_' . $arInfo['STRUCTURE'][0]['FIELD_TYPE'] . '_' . $arInfo['STRUCTURE'][0]['ID']?>

        <div class="bas-form-ticket">
            <div class="text-center">
                <div class="skew-title"><span>Оставить заявку</span></div>
            </div>
            <div class="row position-relative justify-content-center" style="margin: 57px auto 10px; max-width: 700px">
                <div class="bas-form-ticket__tel-bg d-none d-md-block"><div class="bas-form-ticket__tel-bg__item">&nbsp;</div></div>
                <div class="col-12 col-md-6 text-center text-md-right" style="height: 60px">
                    <input name="<?=$strName?>" placeholder="+7 (___) ___-__-__" value="<?=$arResult['arrVALUES'][$strName]?>" type="tel" <?=($arInfo['REQUIRED'] === 'Y') ? "required" : ""?>>
                </div>
                <div class="col-12 col-md-6 text-center">
                    <button type="submit" class="btn btn-default btn-lg" name="web_form_submit" value="<?= $arParams['BAS_BTN_NAME'] ?>"><span>ОТПРАВИТЬ</span></button>
                </div>
            </div>
            <div class="bas-form-ticket__subtext">
                Нажимая на кнопку «Отправить», вы принимаете условия <a href="/privacypolicy/">Политики конфиденциальности</a>
            </div>
        </div>

        <input type="hidden" name="form_dropdown_UF_CRM_1545046905" value="70">

        <?=$arResult["FORM_FOOTER"]?>
    <?php endif; ?>

<?endif?>