<?php
/*
 * PHP array_reduce_JS (v0.11) - array_reduce with additional parameters
 * (javascript like reduce method)
 *
 * (c) Ram Narula You can use this information, kindly do give credit: github rambkk - Ram Narula - pluslab.net
 * Please drop a line to say hello and let me know what kind of project you are working on :-)
 * rambkk - pluslab.net - looking for impossible projects
 *
 *
 * array_reduce with key - with javascript style default initial value of $c
 *
 * Version:
 * array_reduce_JS 0.12 initial release with minor bug fix
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
 * This works the SIMILAR way as general PHP array_reduce function with
 * the addition of additional optional parameters to the CALLBACK.
 * The difference is the initial default value of $c, in PHP array_reduce, the default 
 * initial value of $c is null while in Javascript reduce method, if the initial value of $c 
 * is not specified, the default is the first item of the ARRAY and processing starts with the second 
 * value of the ARRAY.
 * 
 * General explanation:
 * Run CALLBACK on each items of ARRAY and put the result as $c for the next CALLBACK
 * Result from CALLBACK on last item will be returned
 *
 * NOTE: This MIGHT NOT work properly as a drop-in replacement for array_reduce function
 * NOTE: For more information look up Javascript reduce method and PHP array_reduce function
 * NOTE: array_reduce_JS needs more processing resources than the built-in array_reduce
 *
 * -------------------
 * CALLBACK parameters
 * -------------------
 * $c initial value or return value from the last CALLBACK
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
 * Author: Ram Narula <github rambkk> OR <pluslab.net>
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


function array_reduce_JS($a,$f,...$arg){ $arg?$c=$arg[0]:$c=$a[key($a)];foreach($arg?$a:array_slice($a,1,null,true) as $k=>$v)$c=$f($c,$v,$k,$a);return $c; } 


//Anonymous functions as some might prefer
//$array_reduce_JS=function($a,$f,...$arg){ $arg?$c=$arg[0]:$c=$a[key($a)];foreach($arg?$a:array_slice($a,1,null,true) as $k=>$v)$c=$f($c,$v,$k,$a);return $c; };
