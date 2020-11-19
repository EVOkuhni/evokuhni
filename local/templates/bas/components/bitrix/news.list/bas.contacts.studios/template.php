<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();

$this->setFrameMode(false);?>


<div style="border-bottom: 3px solid var(--light-olive-green)">
    <div class="container">
        <div class="title_style_third" style="margin-bottom: 20px"><div class="container"><h1><span>Контакты</span></h1></div></div>
        <div class="bas_my_tab_link text-xs-center text-sm-left" style="position: static;">
            <?php foreach ($arResult['ITEMS'] as $k => $arItem): ?>
            <a href="#tab-studio-<?= $arItem['PROPERTIES']['EL_ABOUT']['VALUE'] ?>" class="position-relative contacts-tab-link <?= $k?'':'active' ?>" data-content-class="contacts-studio-tab-content">
                Студия <br>
                <?=$arItem['NAME']?>
                <?php if($arItem['DISPLAY_PROPERTIES']['NEW']['VALUE'] === 'Y'): ?>
                <div class="contacts-pin-new"></div>
                <?php endif; ?>
            </a>
            <?php endforeach; ?>
        </div>
    </div>
</div>

<div style="background-color: #f6f7f9; padding-top: 10px">
    <div class="container">
        
        <div class="bas_my_tab">
            <?php foreach ($arResult['ITEMS'] as $k => $arItem): ?>
            <div id="tab-studio-<?= $arItem['PROPERTIES']['EL_ABOUT']['VALUE'] ?>" class="contacts-studio-tab-content <?= $k?'':'active' ?>">
                <div id="<?=$this->GetEditAreaId($arItem['ID']);?>">
                    <div class="contacts-data">
                        <div class="row">
                            <?
                            $this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_EDIT"));
                            ?>
                            <div class="col-xl-6 col-lg-7 col-md-12 col-sm-12 col-xs-12" itemscope itemtype="http://schema.org/Organization">
                                <span class="span_none" itemprop="name">EVO кухни</span>
                                <div class="bas_our_office">
                                    <div class="info">
                                        <div class="row">
                                            <div class="col-lg-5 col-md-6 col-sm-6 col-xs-12">
                                                <a itemprop="telephone" style="font-size: 18px" href="tel:<?=$arItem['DISPLAY_PROPERTIES']['PHONE']['DESCRIPTION']?>" class="phone"><?=$arItem['DISPLAY_PROPERTIES']['PHONE']['DISPLAY_VALUE']?></a>
                                            </div>
                                            <div class="col-lg-7 col-md-6 col-sm-6 col-xs-12">
                                                <span class="time" style="font-size: 18px;"><?= $arItem['DISPLAY_PROPERTIES']['TIME']['DISPLAY_VALUE']?></span>
                                            </div>
                                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                                <a href="javascript:" data-toggle="tooltip" title="Скопировать" class="js-emaillink bas_tooltip email"><span itemprop="email"><?=$arItem['DISPLAY_PROPERTIES']['EMAIL']['DISPLAY_VALUE']?></span></a>
                                                <span itemprop="address" itemscope itemtype="http://schema.org/PostalAddress" class="addr" style="font-size: 14px"><?=$arItem['DISPLAY_PROPERTIES']['ADDR']['DISPLAY_VALUE']?></span>
                                            </div>
                                        </div>
                                    </div>
                                    <hr>
                                    <div class="info">
                                        <?=$arItem['PREVIEW_TEXT']?>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-6 col-lg-5 col-md-12 col-sm-12 col-xs-12">
                             
                                <?$APPLICATION->IncludeComponent(
                                    "bitrix:form",
                                    "bas.contacts",
                                    array(
                                        'STUDIO_ID' => $arItem['PROPERTIES']['EL_ABOUT']['VALUE'],
                                        "AJAX_MODE" => "Y",
                                        "AJAX_OPTION_ADDITIONAL" => "",
                                        "AJAX_OPTION_HISTORY" => "N",
                                        "AJAX_OPTION_JUMP" => "N",
                                        "AJAX_OPTION_STYLE" => "Y",
										"AJAX_OPTION_ADDITIONAL" => $arItem['ID'],
                                        "CACHE_TIME" => "3600",
                                        "CACHE_TYPE" => "A",
                                        "CHAIN_ITEM_LINK" => "",
                                        "CHAIN_ITEM_TEXT" => "",
                                        "COMPONENT_TEMPLATE" => "bas.contacts",
                                        "EDIT_ADDITIONAL" => "N",
                                        "EDIT_STATUS" => "N",
                                        "IGNORE_CUSTOM_TEMPLATE" => "N",
                                        "NOT_SHOW_FILTER" => array(
                                            0 => "",
                                            1 => "",
                                        ),
                                        "NOT_SHOW_TABLE" => array(
                                            0 => "",
                                            1 => "",
                                        ),
                                        "RESULT_ID" => "",
                                        "SEF_FOLDER" => "/contacts/",
                                        "SEF_MODE" => "Y",
                                        "SHOW_ADDITIONAL" => "N",
                                        "SHOW_ANSWER_VALUE" => "N",
                                        "SHOW_EDIT_PAGE" => "N",
                                        "SHOW_LIST_PAGE" => "Y",
                                        "SHOW_STATUS" => "N",
                                        "SHOW_VIEW_PAGE" => "N",
                                        "START_PAGE" => "new",
                                        "SUCCESS_URL" => "",
                                        "USE_EXTENDED_ERRORS" => "N",
                                        "WEB_FORM_ID" => "2",
                                        "SEF_URL_TEMPLATES" => array(
                                            "new" => "#WEB_FORM_ID#/",
                                            "list" => "#WEB_FORM_ID#/",
                                            "edit" => "#WEB_FORM_ID#/",
                                            "view" => "#WEB_FORM_ID#/",
                                        )
                                    ),
                                    false
                                );?> 
                            </div>
                        </div>
                    </div>
                    <div style="background-color: #f6f7f9; margin-top: 0" id="tab-studio-gallery-<?= $arItem['PROPERTIES']['EL_ABOUT']['VALUE'] ?>">
                        <div class="container">
                            <?php
                            global $studioFilter;
                            $studioFilter['=PROPERTY_STUDIO'] = $arItem['ID'];
                            ?>
                            <?$APPLICATION->IncludeComponent(
                                "bitrix:news.list",
                                "bas.studio",
                                array(
                                    "STUDIO_ID" => $arItem['ID'],
                                    "ACTIVE_DATE_FORMAT" => "d.m.Y",
                                    "ADD_SECTIONS_CHAIN" => "N",
                                    "AJAX_MODE" => "N",
                                    "AJAX_OPTION_ADDITIONAL" => "",
                                    "AJAX_OPTION_HISTORY" => "N",
                                    "AJAX_OPTION_JUMP" => "N",
                                    "AJAX_OPTION_STYLE" => "Y",
                                    "CACHE_FILTER" => "N",
                                    "CACHE_GROUPS" => "N",
                                    "CACHE_TIME" => "0",
                                    "CACHE_TYPE" => "N",
                                    "CHECK_DATES" => "Y",
                                    "COMPONENT_TEMPLATE" => "bas.studio",
                                    "COMPOSITE_FRAME_MODE" => "A",
                                    "COMPOSITE_FRAME_TYPE" => "AUTO",
                                    "DETAIL_URL" => "",
                                    "DISPLAY_BOTTOM_PAGER" => "N",
                                    "DISPLAY_DATE" => "Y",
                                    "DISPLAY_NAME" => "Y",
                                    "DISPLAY_PICTURE" => "Y",
                                    "DISPLAY_PREVIEW_TEXT" => "Y",
                                    "DISPLAY_TOP_PAGER" => "N",
                                    "FIELD_CODE" => array(
                                        0 => "DETAIL_TEXT",
                                        1 => "",
                                    ),
                                    "FILTER_NAME" => "studioFilter",
                                    "HIDE_LINK_WHEN_NO_DETAIL" => "N",
                                    "IBLOCK_ID" => "24",
                                    "IBLOCK_TYPE" => "info",
                                    "INCLUDE_IBLOCK_INTO_CHAIN" => "N",
                                    "INCLUDE_SUBSECTIONS" => "N",
                                    "MESSAGE_404" => "",
                                    "NEWS_COUNT" => "5",
                                    "PAGER_BASE_LINK_ENABLE" => "N",
                                    "PAGER_DESC_NUMBERING" => "N",
                                    "PAGER_DESC_NUMBERING_CACHE_TIME" => "36000",
                                    "PAGER_SHOW_ALL" => "N",
                                    "PAGER_SHOW_ALWAYS" => "N",
                                    "PAGER_TEMPLATE" => ".default",
                                    "PAGER_TITLE" => "Новости",
                                    "PARENT_SECTION" => "",
                                    "PARENT_SECTION_CODE" => "",
                                    "PREVIEW_TRUNCATE_LEN" => "",
                                    "PROPERTY_CODE" => array(
                                        0 => "",
                                        1 => "MORE_PICT",
                                        2 => "STUDIO",
                                    ),
                                    "SET_BROWSER_TITLE" => "N",
                                    "SET_LAST_MODIFIED" => "N",
                                    "SET_META_DESCRIPTION" => "N",
                                    "SET_META_KEYWORDS" => "N",
                                    "SET_STATUS_404" => "N",
                                    "SET_TITLE" => "N",
                                    "SHOW_404" => "N",
                                    "SORT_BY1" => "SORT",
                                    "SORT_BY2" => "ID",
                                    "SORT_ORDER1" => "ASC",
                                    "SORT_ORDER2" => "ASC",
                                    "STRICT_SECTION_CHECK" => "N",
                                    "TITLE_H2" => "Студия"
                                ),
                                false
                            );?>
                            <?php /*
                            <?$APPLICATION->IncludeComponent(
                                "bitrix:news.list",
                                "bas.team",
                                Array(
                                    "ACTIVE_DATE_FORMAT" => "d.m.Y",
                                    "ADD_SECTIONS_CHAIN" => "N",
                                    "AJAX_MODE" => "N",
                                    "AJAX_OPTION_ADDITIONAL" => "",
                                    "AJAX_OPTION_HISTORY" => "N",
                                    "AJAX_OPTION_JUMP" => "N",
                                    "AJAX_OPTION_STYLE" => "N",
                                    "CACHE_FILTER" => "N",
                                    "CACHE_GROUPS" => "N",
                                    "CACHE_TIME" => "0",
                                    "CACHE_TYPE" => "N",
                                    "CHECK_DATES" => "Y",
                                    "COMPOSITE_FRAME_MODE" => "A",
                                    "COMPOSITE_FRAME_TYPE" => "AUTO",
                                    "DETAIL_URL" => "",
                                    "DISPLAY_BOTTOM_PAGER" => "N",
                                    "DISPLAY_DATE" => "N",
                                    "DISPLAY_NAME" => "N",
                                    "DISPLAY_PICTURE" => "N",
                                    "DISPLAY_PREVIEW_TEXT" => "N",
                                    "DISPLAY_TOP_PAGER" => "N",
                                    "FIELD_CODE" => array("",""),
                                    "FILTER_NAME" => "studioFilter",
                                    "HIDE_LINK_WHEN_NO_DETAIL" => "N",
                                    "IBLOCK_ID" => "22",
                                    "IBLOCK_TYPE" => "info",
                                    "INCLUDE_IBLOCK_INTO_CHAIN" => "N",
                                    "INCLUDE_SUBSECTIONS" => "N",
                                    "MESSAGE_404" => "",
                                    "NEWS_COUNT" => "8",
                                    "PAGER_BASE_LINK_ENABLE" => "N",
                                    "PAGER_DESC_NUMBERING" => "N",
                                    "PAGER_DESC_NUMBERING_CACHE_TIME" => "36000",
                                    "PAGER_SHOW_ALL" => "N",
                                    "PAGER_SHOW_ALWAYS" => "N",
                                    "PAGER_TEMPLATE" => ".default",
                                    "PAGER_TITLE" => "Новости",
                                    "PARENT_SECTION" => "",
                                    "PARENT_SECTION_CODE" => "",
                                    "PREVIEW_TRUNCATE_LEN" => "",
                                    "PROPERTY_CODE" => array("",""),
                                    "SET_BROWSER_TITLE" => "N",
                                    "SET_LAST_MODIFIED" => "N",
                                    "SET_META_DESCRIPTION" => "N",
                                    "SET_META_KEYWORDS" => "N",
                                    "SET_STATUS_404" => "N",
                                    "SET_TITLE" => "N",
                                    "SHOW_404" => "N",
                                    "SORT_BY1" => "SORT",
                                    "SORT_BY2" => "ID",
                                    "SORT_ORDER1" => "ASC",
                                    "SORT_ORDER2" => "ASC",
                                    "STRICT_SECTION_CHECK" => "N",
                                    "TITLE_H2" => "Команда"
                                )
                            );?> */?>
                        </div>
                    </div>
                </div>
            </div>
            <?php endforeach ?>
        </div>
    </div>
</div>