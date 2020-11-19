<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>

<a id="toq"></a>
<div class="bas_result_new_num3">

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

		<?=str_replace('<form name', "<form name", $arResult["FORM_HEADER"])?>

			<div class="top form_style_num2">
				<div class="title"><?=$arParams["BAS_FORM_TITLE"]?></div>
				<div class="hide">

					<?$arInfo = $arResult['QUESTIONS']['TITLE']?>
					<?$strName = 'form_' . $arInfo['STRUCTURE'][0]['FIELD_TYPE'] . '_' . $arInfo['STRUCTURE'][0]['ID']?>

					<input name="<?=$strName?>" value="<?=$arParams["BAS_FORM_NAME"]?>" type="hidden">

				</div>
			 
					 <input type="hidden" name="form_dropdown_SIMPLE_QUESTION_801" value="<?=$arResult["arAnswers"]["SIMPLE_QUESTION_801"][0]["ID"]?>">	 
				<div class="row">
					<div class="col-xl-3 col-sm-6 col-xs-12">

						<?$arInfo = $arResult['QUESTIONS']['SIMPLE_QUESTION_264']?>
						<?$strName = 'form_' . $arInfo['STRUCTURE'][0]['FIELD_TYPE'] . '_' . $arInfo['STRUCTURE'][0]['ID']?>

						<div class="input_margin_one">
							<label><?=$arInfo['CAPTION']?></label>
							<input name="<?=$strName?>" value="<?=$arResult['arrVALUES'][$strName]?>" type="text" <?=($arInfo['REQUIRED'] === 'Y') ? "required" : ""?>>
						</div>
					</div>
					<div class="col-xl-3 col-sm-6 col-xs-12">

						<?$arInfo = $arResult['QUESTIONS']['SIMPLE_QUESTION_167']?>
						<?$strName = 'form_' . $arInfo['STRUCTURE'][0]['FIELD_TYPE'] . '_' . $arInfo['STRUCTURE'][0]['ID']?>

						<div class="input_margin_one">
							<label><?=$arInfo['CAPTION']?></label>
							<input name="<?=$strName?>" value="<?=$arResult['arrVALUES'][$strName]?>" type="tel" <?=($arInfo['REQUIRED'] === 'Y') ? "required" : ""?>>
						</div>
					</div>
				</div>
                <div class="row">
                    <div class="col-12">

                        <?$arInfo = $arResult['QUESTIONS']['SIMPLE_QUESTION_915']?>
                        <?$strName = 'form_' . $arInfo['STRUCTURE'][0]['FIELD_TYPE'] . '_' . $arInfo['STRUCTURE'][0]['ID']?>

                        <textarea placeholder="<?=$arInfo['CAPTION']?>" name="<?=$strName?>" <?=($arInfo['REQUIRED'] === 'Y') ? "required" : ""?>><?=$arResult['arrVALUES'][$strName]?></textarea>
                    </div>
                    <div class="col-12 col-sm-6 col-xl-3">
                        <div class="our_form_styler">
                            <div>
                                Прикрепить резюме
                            </div>
                            <?=$arResult['QUESTIONS']['SIMPLE_QUESTION_372']['HTML_CODE']?>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-4 col-sm-6 col-xs-12 offset-lg-4 offset-sm-3">
						<div class="input_margin_one">
							<input type="submit" class="btn btn-primary full-width" name="web_form_submit" value="<?=$arParams["BAS_BTN_NAME"]?>">
						</div>
					</div>
                </div>
				<?$APPLICATION->IncludeComponent(
					"bas:variable.set",
					"user_consent",
					array(
						'ID' => '1',
						'BUTTON_NAME' => $arParams["BAS_BTN_NAME"],
						'LINK' => '/privacypolicy/',
					),
					false
				);?>
			</div>
			 
		<?=$arResult["FORM_FOOTER"]?>

		</div>

	<?}?>

<?endif?>

</div>