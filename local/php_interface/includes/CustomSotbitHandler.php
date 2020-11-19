<?php
/**
 * Created by PhpStorm.
 * User: Kurraz
 */

class CustomSotbitHandler
{
    static public function handle()
    {
        global $DB, $APPLICATION;
        $q = $DB->Query('SELECT * FROM b_sotbit_seometa_chpu WHERE NEW_URL = "'.$APPLICATION->GetCurDir().'"');
        $rule = $q->GetNext();
        if($rule)
        {
            $q = $DB->Query('SELECT * FROM b_sotbit_seometa WHERE ID = "'.$rule['CONDITION_ID'].'"');
            $data = $q->GetNext();
            if($data)
            {
                 global $sotbitSeoMetaTitle;
                 global $sotbitSeoMetaDescription;
                 global $sotbitSeoMetaH1;
                 global $sotbitSeoMetaBottomDesc;

                 $data = unserialize($data['~META']);

                 $sotbitSeoMetaTitle = $data['ELEMENT_TITLE'];
                 $sotbitSeoMetaDescription = $data['ELEMENT_DESCRIPTION'];
                 $sotbitSeoMetaH1 = $data['ELEMENT_PAGE_TITLE'];
                 $sotbitSeoMetaBottomDesc = $data['ELEMENT_BOTTOM_DESC'];
            }
        }
    }
}