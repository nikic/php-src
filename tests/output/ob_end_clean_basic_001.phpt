--TEST--
Test return type and value, as well as basic behaviour, for ob_end_clean()
--FILE--
<?php

function fn2006665374()
{
    /* 
     * proto bool ob_end_clean(void)
     * Function is implemented in main/output.c
    */
    var_dump(ob_end_clean());
    ob_start();
    var_dump(ob_end_clean());
    ob_start();
    echo "Hello";
    var_dump(ob_end_clean());
    var_dump(ob_end_clean());
}
fn2006665374();
--EXPECTF--

Notice: ob_end_clean(): failed to delete buffer. No buffer to delete in %s on line %d
bool(false)
bool(true)
bool(true)

Notice: ob_end_clean(): failed to delete buffer. No buffer to delete in %s on line %d
bool(false)

