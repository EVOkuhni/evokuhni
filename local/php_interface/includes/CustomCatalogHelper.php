<?php
/**
 * Created by PhpStorm.
 * User: Kurraz
 */

class CustomCatalogHelper
{
    public static function prepareParamsAfterFilter($iblock_id)
    {
        global $sotbitFilterSelected;

        $bottomSliderFilter = array();
        $bottomSliderLink = $iblock_id == 4 ? '/our-works/kitchen/' : "/catalog/kukhni/";

        if ($sotbitFilterSelected) {
            $bottomSliderLink .= 'filter/';
        }

        foreach ($sotbitFilterSelected as $filterCode => $filterData) {
            if (!isset($filterData['VALUES'])) continue;

            $bottomSliderLink .= strtolower($filterCode);

            $v_index = 0;
            foreach ($filterData['VALUES'] as $filterValue) {
                if ($filterValue['CHECKED']) {
                    $q = CIBlockPropertyEnum::GetList(array(), array('IBLOCK_ID' => $iblock_id == 4 ? 20 : 4, 'CODE' => $filterCode, 'XML_ID' => $filterValue['URL_ID']));
                    $res = $q->GetNext();
                    $bottomSliderFilter['PROPERTY_' . $filterCode][] = $res['ID'];

                    if ($v_index == 0)
                        $bottomSliderLink .= '-is-';
                    else
                        $bottomSliderLink .= '-or-';

                    $bottomSliderLink .= $filterValue['URL_ID'];

                    $v_index++;
                }
            }
            $bottomSliderLink .= '/';
        }

        if ($iblock_id != 4) {
            global $DB;
            $bottomSliderLink .= 'apply/';
            $q = $DB->Query('SELECT NEW_URL FROM `b_sotbit_seometa_chpu` WHERE REAL_URL = "' . $DB->ForSql($bottomSliderLink) . '"');
            if ($res = $q->Fetch())
                $bottomSliderLink = $res['NEW_URL'];
        }

        $our_work_items = false;

        if ($iblock_id == 4 && strpos($_SERVER['REQUEST_URI'], '/catalog/kukhni/') === 0) {
            $page = $_GET['PAGEN_2'] ? $_GET['PAGEN_2'] : 1;
            $q = CIBlockElement::GetList(
                array(),
                array_merge(array('ACTIVE' => 'Y', 'IBLOCK_ID' => 20, '!PROPERTY_PRO_PHOTO' => false), $bottomSliderFilter),
                false,
                array('nPageSize' => 4, 'iNumPage' => $page, 'checkOutOfRange' => true)
            );
            while ($el = $q->GetNextElement()) {
                $our_work_item = $el->GetFields();
                $our_work_item['PROPERTIES'] = $our_work_item['DISPLAY_PROPERTIES'] = $el->GetProperties();

                $our_work_items[] = $our_work_item;
            }
        }

        return [
            'OUR_WORK_ITEMS' => $our_work_items,
            'BOTTOM_SLIDER_LINK' => $bottomSliderLink,
            'BOTTOM_SLIDER_FILTER' => $bottomSliderFilter,
        ];
    }
}