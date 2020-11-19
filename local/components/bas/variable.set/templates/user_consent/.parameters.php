<?php
$set = array(
    'ID' => 'ID соглашения',
    'BUTTON_NAME' => 'Название кнопки',
    'LINK' => 'ссылка на Публичную оферту'
);


$arTemplateParameters = array();
foreach ($set as $k => $val) {
	$arTemplateParameters[$k] = array(
		'NAME' => $val,
		'COLS' => 35,
		'ROWS' => 3
	);
}
