--TEST--
Test wrong number of arguments and wrong arg types for ob_start()
--FILE--
<?php

/* 
 * proto bool ob_start([ string|array user_function [, int chunk_size [, bool erase]]])
 * Function is implemented in main/output.c
*/
class C
{
    static function f($str)
    {
        return $str;
    }
}
function fn1730999623()
{
    var_dump(ob_start(array("nonExistent", "f")));
    var_dump(ob_start(array("C", "nonExistent")));
    var_dump(ob_start("C::no"));
    var_dump(ob_start("no"));
    echo "done";
}
fn1730999623();
--EXPECTF--
Warning: ob_start(): class 'nonExistent' not found in %s on line %d

Notice: ob_start(): failed to create buffer in %s on line %d
bool(false)

Warning: ob_start(): class 'C' does not have a method 'nonExistent' in %s on line %d

Notice: ob_start(): failed to create buffer in %s on line %d
bool(false)

Warning: ob_start(): class 'C' does not have a method 'no' in %s on line %d

Notice: ob_start(): failed to create buffer in %s on line %d
bool(false)

Warning: ob_start(): function 'no' not found or invalid function name in %s on line %d

Notice: ob_start(): failed to create buffer in %s on line %d
bool(false)
done
