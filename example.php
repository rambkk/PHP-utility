<?php
/* 
 * PHP Utility examples by <github rambkk> - <pluslab.net>
 *
 *
 * PHP array_reduce_key (v0.11) - array_reduce with additional parameters
 * (javascript like reduce method)
 * array_reduce with key
 *
 * PHP findIndex (v0.1) - get index of first array item which passes callback
 * (javascript like findIndex)
 *
 * PHP findIndexes (v0.1) - get index list of items which passes callback on array
 *
 */


require_once('array_reduce_key.php');
require_once('array_reduce_JS.php');
require_once('findIndex.php');
require_once('findIndexes.php');
$intro=<<<'END'
 * Version:
 * array_reduce_JS 0.11 initial release
 * array_reduce_key 0.1 initial release
 * findIndex 0.11 initial release
 * findIndexes 0.11 initial release
 *
 * Requirement: 
 * PHP 5 >= 5.3.0, PHP 7, PHP 8 (without using Arrow function)
 * PHP 7 >= 7.4, PHP 8 (optional for using Arrow function)
 * (Tested on php 7.4.3)
 *
END;

/* Examples: */

$list=[1,2,3,4,5];
$initial=10000;

$sumOdd=array_reduce_key($list,function($c,$v){ if($v % 2 == 1) { return $v+$c; } else { return $c; } },$initial);
echo "Sum odd with initial: $sumOdd\n";


//with ternary operator instead of if
$sumEven=array_reduce_key($list,function($c,$v){return ($v % 2 == 0)?$v+$c:$c; });
echo "Sum even: $sumEven\n";


$sumEvenIndex=array_reduce_key($list,function($c,$v,$i,$a){return ($i % 2 === 0)?$v+$c:$c; });
echo "Sum of items with even index numbers (index starts with 0):   $sumEvenIndex\n";

array_reduce_key($list,function($c,$v,$i,$a){echo "($c ... $v)"; });
// ( ... 1)( ... 2)( ... 3)( ... 4)( ... 5)

array_reduce_JS($list,function($c,$v,$i,$a){echo "$c ... $v"; });
// (1 ... 2)( ... 3)( ... 4)( ... 5) 
// Note the difference:
// without initial value of $c, the default initial value is the first item of input ARRAY
// and the function runs with second item of ARRAY for $v and $i 

/* Additional examples */

$List=[
        ["plant"=>"lotus","new"=>true, "comment"=>"morning"],
        ["plant"=>"clove","new"=>true, "comment"=>"aroma"],
        ["plant"=>"juniper","new"=>true, "comment"=>"aromatic"],
        ["plant"=>"agarwood","new"=>true, "comment"=>"hard to find"],
        ["plant"=>"sandalwood","new"=>true, "comment"=>"coming"],
        ["plant"=>"sandalwood","new"=>false, "comment"=>"not sure"],
        ["plant"=>"agarwood","new"=>true, "comment"=>"ok"],
        ["plant"=>"juniper","new"=>false, "comment"=>"not sure"]
];
$List[-1]=['plant'=>'sandalwood',"new"=>false];
$List[-108]=['plant'=>'udumbara',"new"=>false];


$RList=[
        ["plant"=>"sandalwood","new"=>false],
        ["plant"=>"juniper","new"=>true]
];


//eg. get array of indexes where plant is 'udumbara' OR 'sandalwood'
echo "Arrow function: ";
$r=findIndexes($List,fn($w,$i,$a) => $w['plant']=='udumbara' || $w['plant']=='sandalwood'); print_r($r); // [4,5,-1,-108]

echo "Inline function: ";
$r=findIndex($List,function($w,$i,$a){ return $w['plant']=='juniper' && $w['new']===false; }); echo "$r\n"; // 7

echo "Anonymous function: ";
$func=function($w,$i) { return $w['plant']=='juniper'; };
$r=findIndex($List,$func); echo "$r\n"; // 2

echo "Function (using quotes to point to function name without parameter): ";
function func($w,$i) { return $w['plant']=='juniper'; }
$r=findIndex($List,'func'); echo "$r\n"; // 2

echo "Function nested with parameter: ";
$findThis='juniper';
function funcOuter($name) { return function($w) use ($name) {
                return $w['plant']==$name;
        };
}
$r=findIndex($List,funcOuter($findThis)); echo "$r\n"; // 2



//Slightly more complex examples, with using array_filter
//
//Remove $List entries with duplicate pairs of 'plant' AND 'new'
//
//$v current item of array_filter
//$k being index from array_filter
//... can pass these and other parameters as needed
//
//$w,$i,$a is from the findIndex CALLBACK on the array 
//
//
echo "Inline arrow function using List twice: ";
$r=array_filter($List,fn($v,$k) => findIndex($List,fn($w) => $w['plant']==$v['plant'] && $w['new']===$v['new']) == $k,ARRAY_FILTER_USE_BOTH);
print_r($r); echo "\n";


echo "Inline function: ";
$r=array_filter($List,fn($v,$k) => findIndex($List,function($w,$i,$a) use ($v) {return $w['plant']==$v['plant'] && $w['new']===$v['new'];}) == $k,ARRAY_FILTER_USE_BOTH);
print_r($r);




//
//Note: $func2(...)  <--- use brackets when calling
// same results from these 
//
echo "Arrow function nesting: ";
$func2 = fn($v,$k) => fn($w,$i,$a) => $w['plant']==$v['plant'] && $w['new']===$v['new'];

echo "Anonymous function and arrow function: ";
$func2 = function($v,$k) { return fn($w,$i,$a) => $w['plant']==$v['plant'] && $w['new']===$v['new']; }; // <--- semi-colon required

echo "Anonymous function nesting note the semi-colon ';' requirements: ";
$func2 = function($v,$k) {
        return function($w,$i,$a) use ($v,$k) {
                return $w['plant']==$v['plant'] && $w['new']===$v['new'];
        }; // <--- semi-colon required
}; // <--- semi-colon required
$r=array_filter($List,fn($v,$k) => findIndex($List,$func2($v,$k)) == $k,ARRAY_FILTER_USE_BOTH);
print_r($r);


echo "Function nesting: ";
function func2($v,$k) {
        return function($w,$i,$a) use ($v,$k) {
                return $w['plant']==$v['plant'] && $w['new']===$v['new'];
        }; // <--- semi-colon required
}
$r=array_filter($List,fn($v,$k) => findIndex($List,func2($v,$k)) == $k,ARRAY_FILTER_USE_BOTH);
print_r($r);


echo "Function inline nesting: ";
$r=array_filter($List, function($v,$k) use ($List) {
                                return findIndex($List, function($w,$i,$a) use ($v,$k) {
                                        return $w['plant']==$v['plant'] && $w['new']===$v['new'];
                                } )==$k;
} ,ARRAY_FILTER_USE_BOTH);
print_r($r);
/* Array (
    [0] => Array ( [plant] => lotus [new] => 1 [comment] => morning )
    [1] => Array ( [plant] => clove [new] => 1 [comment] => aroma )
    [2] => Array ( [plant] => juniper [new] => 1 [comment] => aromatic )
    [3] => Array ( [plant] => agarwood [new] => 1 [comment] => hard to find )
    [4] => Array ( [plant] => sandalwood [new] => 1 [comment] => coming ) 
    [5] => Array ( [plant] => sandalwood [new] => [comment] => not sure )
    [7] => Array ( [plant] => juniper [new] => [comment] => not sure )
    [-108] => Array ( [plant] => udumbara [new] => )
) */


//Remove entries $List with matching pairs of (plant AND new) in $RList
//
//NOTE:
//must use strict type comparison ('===') with null (not found)
//or use is_null function
//
echo "Inline arrow:";
$r=array_filter($List,fn($v) => findIndex($RList,fn($w) => $w['plant']==$v['plant'] && $w['new']===$v['new'])===null  );
print_r($r);
/* Array (
    [0] => Array ( [plant] => lotus [new] => 1 [comment] => morning )
    [1] => Array ( [plant] => clove [new] => 1 [comment] => aroma )
    [3] => Array ( [plant] => agarwood [new] => 1 [comment] => hard to find )
    [4] => Array ( [plant] => sandalwood [new] => 1 [comment] => coming )
    [6] => Array ( [plant] => agarwood [new] => 1 [comment] => ok )
    [7] => Array ( [plant] => juniper [new] => [comment] => not sure )
    [-108] => Array ( [plant] => udumbara [new] => )
) */

//
//Example with negative key/index
//
echo "Inline arrow function (negative index): ";
$r=findIndex($List,fn($w) => $w['plant']=='udumbara');
var_dump($r);

?>
