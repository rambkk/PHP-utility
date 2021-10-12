<?php
/*
 * PHP findIndex (v0.1) - get index of first array item which passes callback
 * (javascript like findIndex)
 *
 *
 * Version:
 * findIndex 0.11 initial release
 *
 * Requirement: 
 * PHP 5 >= 5.3.0, PHP 7, PHP 8 (without using Arrow function)
 * PHP 7 >= 7.4, PHP 8 (optional for using Arrow function)
 * (Tested on php 7.4.3)
 *
 * Syntax:
 * ---------
 * findIndex ( ARRAY, CALLBACK($v,$i,$a) )
 * ---------
 * Get the first key/index of the array from a truthy/success from CALLBACK 
 * otherwise returns null 
 * NOTE: javascript findIndex returns -1 for failing
 *
 *
 * -------------------
 * CALLBACK parameters
 * -------------------
 * $v value of current item
 * $i index of current item (optional)
 * $a current array (optional)
 *
 *
 * ---------------------
 * Using these features
 * ---------------------
 * Anonymous function (PHP 5 >= 5.3.0, PHP 7, PHP 8) 
 * Arrow function (PHP 7 >= 7.4, PHP 8) (optional)
 *
 *
 * Author: Ram Narula <github: rambkk> OR <www.pluslab.net>
 *
 */
/* ----------- */
/* Declaration */
/* ----------- */


function findIndex($a,$f){foreach($a as $k=>$v)if($f($v,$k,$a))return $k;}

//Anonymous functions as some might prefer
//$findIndex=function($a,$f){foreach($a as $k=>$v)if($f($v,$k,$a))return $k;};
