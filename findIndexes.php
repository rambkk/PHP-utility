<?php
/*
 * PHP findIndexes (v0.1) - get index list of items which passes callback on array
 *
 * Version:
 * findIndexes 0.11 initial release
 *
 * Requirement: 
 * PHP 5 >= 5.3.0, PHP 7, PHP 8 (without using Arrow function)
 * PHP 7 >= 7.4, PHP 8 (optional for using Arrow function)
 * (Tested on php 7.4.3)
 *
 * Syntax:
 * -----------
 * findIndexes ( ARRAY, CALLBACK($v,$i,$a) )
 * -----------
 * Get an array of index of all items for each truthy/success from CALLBACK
 * otherwise returns an empty array
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
 * Using these functions
 * ---------------------
 * Anonymous function (PHP 5 >= 5.3.0, PHP 7, PHP 8) 
 * Arrow function (PHP 7 >= 7.4, PHP 8) (optional)
 *
 *
 * Author: Ram Narula <github: rambkk> OR <www.pluslab.net>
 *
 *
 */
/* ----------- */
/* Declaration */
/* ----------- */

function findIndexes($a,$f){$r=[];foreach($a as $k=>$v)if($f($v,$k,$a))$r[]=$k;return $r;}

//Anonymous functions as some might prefer
$findIndexes=function($a,$f){$r=[];foreach($a as $k=>$v)if($f($v,$k,$a))$r[]=$k;return $r;};
