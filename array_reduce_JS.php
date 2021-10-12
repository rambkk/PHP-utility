<?php
/*
 * PHP array_reduce_JS (v0.1) - array_reduce with additional parameters
 * (javascript like reduce method)
 *
 * array_reduce with key
 *
 * Version:
 * array_reduce_JS 0.11 initial release
 *
 * Requirement: 
 * PHP 5 >= 5.3.0, PHP 7, PHP 8 (without using Arrow function)
 * PHP 7 >= 7.4, PHP 8 (optional for using Arrow function)
 * (Tested on php 7.4.3)
 *
 * Syntax:
 *
 * ---------------
 * array_reduce_JS ( ARRAY, CALLBACK($c,$v,$i,$a), [optional: initial value of $c] )
 * ---------------
 * This works the same way as general PHP array_reduce function with
 * the addition of additional optional parameters to the CALLBACK
 *
 * Run CALLBACK on each item of ARRAY and put the result as $c for the next CALLBACK
 * Result from CALLBACK on last item will be returned
 * The default initial value of $c is null
 *
 * NOTE: This can work as a drop-in replacement for array_reduce function
 * NOTE: For more information look up PHP array_reduce function
 * NOTE: array_reduce_JS needs more processing resources than the built-in array_reduce
 *
 * -------------------
 * CALLBACK parameters
 * -------------------
 * $c (ONLY for array_reduce_JS) initial value or return value from the last CALLBACK
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
 *
 * How to use? 
 * Put the initial declaration
 *
 *
 * Why? 
 * It's a fun challenge to create very compact codes.
 *
 *
 */
/* ----------- */
/* Declaration */
/* ----------- */


function array_reduce_JS($a,$f,$c=null){foreach($a as $k=>$v)$c=$f($c,$v,$k,$a);return $c;}

//Anonymous functions as some might prefer
//$array_reduce_JS=function($a,$f,$c=null){foreach($a as $k=>$v)$c=$f($c,$v,$k,$a);return $c;};
