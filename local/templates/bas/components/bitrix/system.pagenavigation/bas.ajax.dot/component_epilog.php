<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();

global $APPLICATION;

if ($templateData["PREV"] != "")
{
   $APPLICATION->AddHeadString($templateData["PREV"],true);   
}

if ($templateData["NEXT"] != "")
{
   $APPLICATION->AddHeadString($templateData["NEXT"],true);   
}