<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>

<a id="toq"></a>
<div class="bas_result_new_num7_bg">
	<div class="container">
		<div class="bas_result_new_num7">

		<?if(isset($_REQUEST["bas_ok"]) && ($_REQUEST["bas_ok"] === 'Y')):?>

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

			<?if ($arResult["isFormNote"] != "Y"){?>

				<div class="block">

				<?$arResult["FORM_HEADER"] = str_replace('" method', '#toq" method', $arResult["FORM_HEADER"])?>

				<?=str_replace('<form name', "<form onsubmit=\"yaCounter45350511.reachGoal('order'); gtag('event', 'SendForm', {'event_category': 'form', 'event_action': 'submit', }); return true;\" name", $arResult["FORM_HEADER"])?>

					<div class="top form_style_num4">
						<div class="title"><?=$arParams["BAS_FORM_TITLE"]?></div>
						<div class="hide">

							<?$arInfo = $arResult['QUESTIONS']['UF_CRM_1486630968']?>
							<?$strName = 'form_' . $arInfo['STRUCTURE'][0]['FIELD_TYPE'] . '_' . $arInfo['STRUCTURE'][0]['ID']?>

							<input name="<?=$strName?>" value="<?=$arResult['arrVALUES'][$strName] ? $arResult['arrVALUES'][$strName] : $arResult['BAS_TOVAR_NAME']?>" type="hidden">

							<?$arInfo = $arResult['QUESTIONS']['TITLE']?>
							<?$strName = 'form_' . $arInfo['STRUCTURE'][0]['FIELD_TYPE'] . '_' . $arInfo['STRUCTURE'][0]['ID']?>

							<input name="<?=$strName?>" value="<?=$arParams["BAS_FORM_NAME"]?>" type="hidden">

						</div>
						<div class="row">
							<div class="col-lg-3 col-xs-12">

								<?$arInfo = $arResult['QUESTIONS']['SIMPLE_QUESTION_594']?>
								<?$strName = 'form_' . $arInfo['STRUCTURE'][0]['FIELD_TYPE'] . '_' . $arInfo['STRUCTURE'][0]['ID']?>

								<div class="input_margin_one">
									<label><?=$arInfo['CAPTION']?></label>
									<input name="<?=$strName?>" value="<?=$arResult['arrVALUES'][$strName]?>" type="text" <?=($arInfo['REQUIRED'] === 'Y') ? "required" : ""?>>
								</div>
							</div>
							<div class="col-lg-3 col-xs-12">

								<?$arInfo = $arResult['QUESTIONS']['SIMPLE_QUESTION_789']?>
								<?$strName = 'form_' . $arInfo['STRUCTURE'][0]['FIELD_TYPE'] . '_' . $arInfo['STRUCTURE'][0]['ID']?>

								<div class="input_margin_one">
									<label><?=$arInfo['CAPTION']?></label>
									<input name="<?=$strName?>" value="<?=$arResult['arrVALUES'][$strName]?>" type="tel" <?=($arInfo['REQUIRED'] === 'Y') ? "required" : ""?>>
								</div>
							</div>
							<div class="col-lg-3 col-xs-12">

								<?$arInfo = $arResult['QUESTIONS']['SIMPLE_QUESTION_887']?>
								<?$strName = 'form_' . $arInfo['STRUCTURE'][0]['FIELD_TYPE'] . '_' . $arInfo['STRUCTURE'][0]['ID']?>

								<div class="input_margin_one">
									<label><?=$arInfo['CAPTION']?></label>
									<input name="<?=$strName?>" value="<?=$arResult['arrVALUES'][$strName]?>" type="email" <?=($arInfo['REQUIRED'] === 'Y') ? "required" : ""?>>
								</div>
							</div> 
							<input type="hidden" name="form_dropdown_UF_CRM_1545046905" value="<?=$arResult["arAnswers"]["UF_CRM_1545046905"][0]["ID"]?>">
							<div class="col-lg-3 col-xs-12">
								<div class="input_margin_one">
									<label class="hidden-xs"></label>
									<input type="submit" class="btn btn-primary full-width btn_no-border" name="web_form_submit" value="<?=$arParams["BAS_BTN_NAME"]?>">
								</div>
							</div>
							
						</div>
						<div class="link text-center">
							<?$APPLICATION->IncludeComponent(
								"bas:variable.set",
								"bas.user.consent",
								array(
									'ID' => '1',
									'BUTTON_NAME' => $arParams["BAS_BTN_NAME"],
									'LINK' => '/privacypolicy/',
								),
								false
							);?>
						</div>
					</div>

				<?=$arResult["FORM_FOOTER"]?>

				</div>

			<?}?>

		<?endif?>

		</div>
	</div>
</div>