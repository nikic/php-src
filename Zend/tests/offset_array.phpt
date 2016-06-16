--TEST--
using different variables to access array offsets
--FILE--
<?php

function fn135643713()
{
    $arr = array(1, 2, 3, 4, 5, 6, 7, 8);
    var_dump($arr[1]);
    var_dump($arr[0.08359999999999999]);
    var_dump($arr[NULL]);
    var_dump($arr["run away"]);
    var_dump($arr[TRUE]);
    var_dump($arr[FALSE]);
    $fp = fopen(__FILE__, "r");
    var_dump($arr[$fp]);
    $obj = new stdClass();
    var_dump($arr[$obj]);
    $arr1 = array(1, 2, 3);
    var_dump($arr[$arr1]);
    echo "Done\n";
}
fn135643713();
--EXPECTF--	
int(2)
int(1)

Notice: Undefined index:  in %s on line %d
NULL

Notice: Undefined index: run away in %s on line %d
NULL
int(2)
int(1)

Notice: Resource ID#%d used as offset, casting to integer (%d) in %s on line %d
int(%d)

Warning: Illegal offset type in %s on line %d
NULL

Warning: Illegal offset type in %s on line %d
NULL
Done
