<?php

function fnA($text){
    $match = [];
    preg_match_all("/\d+/", $text, $match);
    return reset($match);
}

function fnB($text){
    $match = [];
    preg_match_all("/([^()|\d|\(user\-gpe\-)|\[\]]+)./i", $text, $match);
    $newText = implode("", reset($match));
    preg_match_all("/([^\[\]])/i", $newText, $match);
    return implode("", reset($match));
}

$text = "Hola @[Franklin](user-gpe-1071) avisa a @[Ludmina](user-gpe-1061)";
$resultA = fnA($text);
$resultB = fnB($text);

var_dump($resultA, $resultB);