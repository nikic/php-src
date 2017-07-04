--TEST--
Test wrong number of arguments and wrong arg types for ob_start()
--FILE--
<?php

/* 
 * proto bool ob_start([ string|array user_function [, int chunk_size [, bool erase]]])
 * Function is implemented in main/output.c
*/
function justPrint($str)
{
    return $str;
}
function fn1406918455()
{
    $arg_1 = "justPrint";
    $arg_2 = 0;
    $arg_3 = false;
    $extra_arg = 1;
    echo "\n- Too many arguments\n";
    var_dump(ob_start($arg_1, $arg_2, $arg_3, $extra_arg));
    echo "\n- Arg 1 wrong type\n";
    var_dump(ob_start(1.5));
    echo "\n- Arg 2 wrong type\n";
    var_dump(ob_start("justPrint", "this should be an int"));
    echo "\n- Arg 3 wrong type\n";
    var_dump(ob_start("justPrint", 0, "this should be a bool"));
}
fn1406918455();
--EXPECTF--
- Too many arguments

Warning: ob_start() expects at most 3 parameters, 4 given in %s on line %d
NULL

- Arg 1 wrong type

Warning: ob_start(): no array or string given in %s on line %d

Notice: ob_start(): failed to create buffer in %s on line %d
bool(false)

- Arg 2 wrong type

Warning: ob_start() expects parameter 2 to be integer, string given in %s on line %d
NULL

- Arg 3 wrong type

Warning: ob_start() expects parameter 3 to be integer, string given in %s on line %d
NULL
