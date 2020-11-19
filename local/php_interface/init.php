<?php
require_once __DIR__ .'/phpQuery/phpQuery.php';
require_once __DIR__ .'/includes/ReCaptchaVerifier.php';
require_once __DIR__ .'/includes/CustomSotbitHandler.php';
require_once __DIR__ .'/includes/CustomCatalogHelper.php';

define('IBLOCK_CITIES', 30);

function Deb($array, $all_show = false)
{
	global $USER;
	
	if ($USER->IsAdmin() || $all_show) {?><pre><?print_r($array)?></pre><?}
}

function isActiveIb($id)
{
	CModule::IncludeModule("iblock");

	$res = CIBlock::GetByID($id);

	if ($ar_res = $res->GetNext())
		if ($ar_res['ACTIVE']=="Y") return true;

		return false;
}

function my_onAfterResultAddUpdate($WEB_FORM_ID, $RESULT_ID)
{
	if ($WEB_FORM_ID == 1) 
	{
		$strTemp = '';

		$arAnswer = CFormResult::GetDataByID(
			$RESULT_ID, 
			array(), 
			$arResult, 
			$arAnswer2
		);

		foreach($arAnswer as $arItem)
		{
			if ($arItem[0]['FIELD_TYPE'] === 'file')
			{
				$strTemp .= (CMain::IsHTTPS() ? "https://" : "http://") . SITE_SERVER_NAME . CFile::GetPath($arItem[0]["USER_FILE_ID"]) . PHP_EOL;
			}
		}

		$ANSWER_ID = 60;
		$arVALUE[$ANSWER_ID] = $strTemp;
		CFormResult::SetField($RESULT_ID, 'SIMPLE_QUESTION_969', $arVALUE);
	}
}

AddEventHandler('form', 'onAfterResultAdd', 'my_onAfterResultAddUpdate');
AddEventHandler('form', 'onAfterResultUpdate', 'my_onAfterResultAddUpdate');

AddEventHandler('main', 'OnBeforeProlog', array('CMainHandlers', 'OnBeforePrologHandler'));
AddEventHandler('main', 'OnEpilog', array('CMainHandlers', 'OnEpilogHandler'));

class CMainHandlers {

    public static function OnBeforePrologHandler() {
        if(isset($_REQUEST['PAGEN_2']))
        {
            $_GET['PAGEN_1'] = $_REQUEST['PAGEN_1'] = $_REQUEST['PAGEN_2'];
        }
    }

	public static function OnEpilogHandler() {

		if ((isset($_GET['PAGEN_1']) && intval($_GET['PAGEN_1'])>0)
             ||
            (isset($_GET['PAGEN_2']) && intval($_GET['PAGEN_2'])>0)
        ) {

		    $page = empty($_GET['PAGEN_1']) ? $_GET['PAGEN_2'] : $_GET['PAGEN_1'];

			$title = $GLOBALS['APPLICATION']->GetTitle();
            $description = $GLOBALS['APPLICATION']->GetPageProperty('description');

			$GLOBALS['APPLICATION']->SetTitle($title . ', страница ' . $page);

			$GLOBALS['APPLICATION']->SetPageProperty('title', $title . ', страница ' . $page);

			$GLOBALS['APPLICATION']->SetPageProperty('description', $description . ' Cтраница ' . $page);
            //$GLOBALS['APPLICATION']->AddHeadString('<link href="'.$GLOBALS['APPLICATION']->GetCurDir().'" rel="canonical" />',true);
		}

		if(isset($_GET['sort']))
        {
            $GLOBALS['APPLICATION']->SetPageProperty('robots','noindex, nofollow');
        }

		global $sotbitFilterResult, $sotbitFilterSelected;

		//if($GLOBALS['USER']->IsAdmin())
        {
            /*echo "<pre>";
            var_dump($sotbitFilterSelected);
            echo "</pre>";*/
            /*echo "<pre>";
            var_dump($sotbitFilterResult['ITEMS']);
            echo "</pre>";*/
            //$GLOBALS['APPLICATION']->AddChainItem('test','/');
            //var_dump($_SERVER['REQUEST_URI']);
        }

	}
}

function filterAttributesNames()
{
    $styles_names = array(
        'modern' => 'модерн',
        'klassika' => 'классические',
        'loft' => 'лофт',
        'provans' => 'Прованс',
        'skandinavskij' => 'в скандинавском стиле',
        'haj-tek' => 'хай тек',
        'sovremennye' => 'современные',
        'neoklassika' => 'неоклассика',
    );

    $facades_names = array(
        'ldsp' => 'из ЛДСП',
        'mdf' => 'из МДФ',
        'plastik' => 'из пластика',
        'akril' => 'из акрила',
        'plenka' => 'из пленки',
        'alvic' => 'Alvic / УФ лак',
        'emal' => 'из эмали',
        'steklo' => 'из стекла',
        'spon' => 'из шпона',
        'massiv' => 'из массива',
        'integr' => 'с интегрированной ручкой',
        'keramo' => 'из керамогранита',
        'patina' => 'с патиной',
        'glyancevye' => 'глянцевые',
    );

    $forms_names = array(
        'uglovaya' => 'угловые',
        'pryamaya' => 'прямые',
        's_ostrovom' => 'с островом',
        'p_obraznaya' => 'п-образные',
        'vstroennye' => 'встроенные',
        'malenkie' => 'маленькие',
        's_barnoy_stoykoy' => 'с барной стойкой',
        'podpotolok' => 'под потолок',
        'svstroennojtekhnikoj' => 'с встроенной техникой',
    );

    $colors_names = array(
        'chernyj' => 'черные',
        'seryj' => 'серые',
        'belyj' => 'белые',
        'bezhevyj' => 'бежевые',
        'korichnevyj' => 'коричневые',
        'krasnyj' => 'красные',
        'oranzhevyj' => 'оранжевые',
        'zheltyj' => 'желтые',
        'zelenyj' => 'зеленые',
        'biryuzovyj' => 'бирюзовые',
        'sinij' => 'синие',
        'goluboj' => 'Голубые',
        'fioletovyj' => 'фиолетовые',
        'light' => 'светлые',
        'dark' => 'темные',
        'kapuchino' => 'капучино',
        'slonovayakost' => 'слоновая кость',
        'kremovyj' => 'Кремовый',
    );

    $sizes_names = array(
        'bolshie' => 'большие',
        'malenkie' => 'маленькие',
        'p-44' => 'П 44',
        'dlya-hrujevki' => 'для хрущевки',
        '2-metra' => '2 метра',
        '3-metra' => '3 метра',
        '4-metra' => '4 метра',
        '4-kv-m' => '4 кв м',
        '5-kv-m' => '5 кв м',
        '6-kv-m' => '6 кв м',
        '7-kv-m' => '7 кв м',
        '8-kv-m' => '8 кв м',
        '9-kv-m' => '9 кв м',
        '10-kv-m' => '10 кв м',
        '12-kv-m' => '12 кв м',
        '18-kv-m' => '18 кв м',
        'svoi-razmery' => 'свои размеры',
    );

    return [
        'styles_names' => $styles_names,
        'facades_names' => $facades_names,
        'forms_names' => $forms_names,
        'colors_names' => $colors_names,
        'sizes_names' => $sizes_names,
    ];
}

function filterDataToTitle($filterSelected, $title = 'Кухни')
{
    $names = filterAttributesNames();
    $styles_names = $names['styles_names'];
    $facades_names = $names['facades_names'];
    $forms_names = $names['forms_names'];
    $colors_names = $names['colors_names'];

    foreach ($filterSelected as $item)
    {
        switch ($item['CODE'])
        {
            case 'ALL_STYLE':
                foreach ($item['SELECTED_VALUES'] as $k => $value)
                {
                    if($k == 0)
                        $title .= ' '.$styles_names[$value['URL_ID']];
                    else
                        $title .= ', '.$styles_names[$value['URL_ID']];
                }
                break;
            case 'KITCH_MAT':
                foreach ($item['SELECTED_VALUES'] as $k => $value)
                {
                    if($k == 0)
                        $title .= ' '.$facades_names[$value['URL_ID']];
                    else
                        $title .= ', '.$facades_names[$value['URL_ID']];
                }
                break;
            case 'KITCH_FORM':
                foreach ($item['SELECTED_VALUES'] as $k => $value)
                {
                    if($k == 0)
                        $title .= ' '.$forms_names[$value['URL_ID']];
                    else
                        $title .= ', '.$forms_names[$value['URL_ID']];
                }
                break;
            case 'KITCH_CVET':
                foreach ($item['SELECTED_VALUES'] as $k => $value)
                {
                    if($k == 0)
                        $title .= ' '.$colors_names[$value['URL_ID']];
                    else
                        $title .= ', '.$colors_names[$value['URL_ID']];
                }
                break;
            default:
                foreach ($item['SELECTED_VALUES'] as $k => $value)
                {
                    if($k == 0)
                        $title .= ' ' . strtolower($value['VALUE']);
                    else
                        $title .= ', ' . $value['VALUE'];
                }
        }
    }

    return $title;
}

// Сжатие html, удаление type="text/javascript" у script и type="text/css" у style
AddEventHandler("main", "OnEndBufferContent", "minifyHtml");    

function minifyHtml(&$buffer)
{
	global $USER, $APPLICATION;

	if (isset($_GET['captcha_sid']) || isset($_GET['captcha_code'])) return;
	if ((is_object($USER) && $USER->IsAuthorized()) || strpos($APPLICATION->GetCurDir(), "/bitrix/")!==false) return;
	if (isset($_SERVER['HTTP_X_REQUESTED_WITH']) && !empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest') return;
	if ($_SERVER['SCRIPT_URL'] === '/cart_xls.php') return;

    $buffer = str_replace(' type="text/javascript"', "", $buffer);
	$buffer = str_replace(" type='text/javascript'", "", $buffer);
	$buffer = str_replace('<style type="text/css">', "<style>", $buffer);

	$buffer = preg_replace('/<link href=".+ui.font.opensans.+".+>/U', '', $buffer);
	$buffer = preg_replace('/<link href=".+kernel_main.+".+>/U', '', $buffer);

 	$search = array(
		'/\>[^\S ]+/s',
		'/[^\S ]+\</s',
		'/(\s)+/s'
	);

	$replace = array(
		'>',
		'<',
		'\\1'
	);

	$buffer = preg_replace($search, $replace, $buffer);

	return $buffer;
}