<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>

<a id="toq"></a>
<div class="bas_result_new_num1">

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

			<div class="top form_style_num2">
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
					<div class="col-xl-2 col-lg-3 col-md-6 col-xs-12">

						<?$arInfo = $arResult['QUESTIONS']['SIMPLE_QUESTION_594']?>
						<?$strName = 'form_' . $arInfo['STRUCTURE'][0]['FIELD_TYPE'] . '_' . $arInfo['STRUCTURE'][0]['ID']?>

						<div class="input_margin_one">
							<label><?=$arInfo['CAPTION']?></label>
							<input name="<?=$strName?>" value="<?=$arResult['arrVALUES'][$strName]?>" type="text" <?=($arInfo['REQUIRED'] === 'Y') ? "required" : ""?>>
						</div>
					</div>
					<div class="col-xl-2 col-lg-3 col-md-6 col-xs-12">

						<?$arInfo = $arResult['QUESTIONS']['SIMPLE_QUESTION_789']?>
						<?$strName = 'form_' . $arInfo['STRUCTURE'][0]['FIELD_TYPE'] . '_' . $arInfo['STRUCTURE'][0]['ID']?>

						<div class="input_margin_one">
							<label><?=$arInfo['CAPTION']?></label>
							<input name="<?=$strName?>" value="<?=$arResult['arrVALUES'][$strName]?>" type="tel" <?=($arInfo['REQUIRED'] === 'Y') ? "required" : ""?>>
						</div>
					</div>
					<div class="col-xl-2 col-lg-3 col-md-6 col-xs-12">

						<?$arInfo = $arResult['QUESTIONS']['SIMPLE_QUESTION_887']?>
						<?$strName = 'form_' . $arInfo['STRUCTURE'][0]['FIELD_TYPE'] . '_' . $arInfo['STRUCTURE'][0]['ID']?>

						<div class="input_margin_one">
							<label><?=$arInfo['CAPTION']?></label>
							<input name="<?=$strName?>" value="<?=$arResult['arrVALUES'][$strName]?>" type="email" <?=($arInfo['REQUIRED'] === 'Y') ? "required" : ""?>>
						</div>
					</div>
					<div class="col-xl-3 col-lg-3 col-md-6 col-xs-12 our_form_styler">

                        <?$arInfo = $arResult['QUESTIONS']['UF_CRM_1545046905']?>

                        <div class="input_margin_one">
                            <label><?=$arInfo['CAPTION']?> *</label>
                            <?php
                            $select = str_replace('<select', '<select required', $arInfo['HTML_CODE']);
                            $pos = strpos($select, '<option');
                            $select = substr_replace($select, '<option value="" >Выберите студию*</option>', $pos, 0);
                            ?>
                            <?= $select ?>
                        </div>

					</div>
					<div class="col-xl-3 col-xs-12">
						<div class="input_margin_one">
							<label class="hidden-xs"></label>
							<input type="submit" class="btn btn-primary full-width" name="web_form_submit" value="<?=$arParams["BAS_BTN_NAME"]?>">
						</div>
					</div>
					
				</div>
				<div class="link">
					<div class="row">
						<div class="col-lg-5 col-md-12 col-sm-12 col-xs-12">

						</div>
						<div class="col-lg-7 col-md-12 col-sm-12 col-xs-12 text-right-lg">
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
				</div>
			</div>
			<div class="bottom form_style_num3">
				<div class="row">
					<div class="col-lg-2 col-md-4 col-sm-12 col-xs-12">
						<div class="input_margin_two">
							<div class="title">Размер</div>
						</div>

						<?$arInfo = $arResult['QUESTIONS']['SIMPLE_QUESTION_993']?>
						<?$strName = 'form_' . $arInfo['STRUCTURE'][0]['FIELD_TYPE'] . '_' . $arInfo['STRUCTURE'][0]['ID']?>

						<div class="input_margin_two">
							<input name="<?=$strName?>" value="<?=$arResult['arrVALUES'][$strName]?>" type="text" <?=($arInfo['REQUIRED'] === 'Y') ? "required" : ""?>>
						</div>

						<?$arInfo = $arResult['QUESTIONS']['SIMPLE_QUESTION_435']?>
						<?$strName = 'form_' . $arInfo['STRUCTURE'][0]['FIELD_TYPE'] . '_' . $arInfo['STRUCTURE'][0]['ID']?>

						<div class="input_margin_two">
							<input name="<?=$strName?>" value="<?=$arResult['arrVALUES'][$strName]?>" type="text" <?=($arInfo['REQUIRED'] === 'Y') ? "required" : ""?>>
						</div>

						<?$arInfo = $arResult['QUESTIONS']['SIMPLE_QUESTION_553']?>
						<?$strName = 'form_' . $arInfo['STRUCTURE'][0]['FIELD_TYPE'] . '_' . $arInfo['STRUCTURE'][0]['ID']?>

						<div class="input_margin_two">
							<input name="<?=$strName?>" value="<?=$arResult['arrVALUES'][$strName]?>" type="text" <?=($arInfo['REQUIRED'] === 'Y') ? "required" : ""?>>
						</div>

					</div>
					<div class="col-lg-5 col-md-4 col-sm-6 col-xs-12">

						<?$intId = 'SIMPLE_QUESTION_485';?>
						<?$arInfo = $arResult['QUESTIONS'][$intId]?>

						<div class="input_margin_two">
							<div class="title"><?=$arInfo['CAPTION']?></div>
						</div>
						<div class="our_form_styler">

						<?foreach($arInfo['STRUCTURE'] as $arItem):?>

							<?$strName = 'form_' . $arItem['FIELD_TYPE'] . '_' . $intId?>

							<div class="line input_margin_two">
								<input id="input_<?=$arItem['ID']?>" name="<?=$strName?>" value="<?=$arItem['ID']?>" type="<?=$arItem['FIELD_TYPE']?>" <?=($arItem['ID'] == $arResult['arrVALUES'][$strName]) ? "checked" : ""?>>
								<label for="input_<?=$arItem['ID']?>" class="icon icon_<?=$arItem['ID']?>">
									<?=$arItem['MESSAGE']?>
								</label>
							</div>

						<?endforeach?>

						</div>
					</div>
					<div class="col-lg-5 col-md-4 col-sm-6 col-xs-12">

						<?$intId = 'SIMPLE_QUESTION_142';?>
						<?$arInfo = $arResult['QUESTIONS'][$intId]?>

						<div class="input_margin_two">
							<div class="title"><?=$arInfo['CAPTION']?></div>
						</div>
						<div class="our_form_styler">

						<?foreach($arInfo['STRUCTURE'] as $arItem):?>

							<?$strName = 'form_' . $arItem['FIELD_TYPE'] . '_' . $intId?>

							<div class="line input_margin_two">
								<input id="input_<?=$arItem['ID']?>" name="<?=$strName?>[]" value="<?=$arItem['ID']?>" type="<?=$arItem['FIELD_TYPE']?>" <?=in_array($arItem['ID'], $arResult['arrVALUES'][$strName]) ? "checked" : ""?>>
								<label for="input_<?=$arItem['ID']?>" class="no_icon">
									<?=$arItem['MESSAGE']?>
								</label>
							</div>

						<?endforeach?>

						</div>
					</div>
				</div>
				<div class="row">
					<div class="col-lg-2 col-md-3 col-sm-3 col-xs-12">
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
					<div class="col-lg-10 col-md-9 col-sm-9 col-xs-12">

						<?$arInfo = $arResult['QUESTIONS']['SIMPLE_QUESTION_697']?>
						<?$strName = 'form_' . $arInfo['STRUCTURE'][0]['FIELD_TYPE'] . '_' . $arInfo['STRUCTURE'][0]['ID']?>

						<div class="input_margin_two">
							<textarea name="<?=$strName?>" placeholder="<?=$arInfo['CAPTION']?>"><?=$arResult['arrVALUES'][$strName]?></textarea>
						</div>
					</div>
				</div>
			</div>

		<?=$arResult["FORM_FOOTER"]?>

		</div>

	<?}?>

<?endif?>

</div>