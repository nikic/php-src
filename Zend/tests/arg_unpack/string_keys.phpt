--TEST--
Argument unpacking does not work with string keys (forward compatibility for named args)
--FILE--
<?php

function fn1566159384()
{
    set_error_handler(function ($errno, $errstr) {
        var_dump($errstr);
    });
    try {
        var_dump(...[1, 2, "foo" => 3, 4]);
    } catch (Error $ex) {
        var_dump($ex->getMessage());
    }
    try {
        var_dump(...new ArrayIterator([1, 2, "foo" => 3, 4]));
    } catch (Error $ex) {
        var_dump($ex->getMessage());
    }
}
fn1566159384();
--EXPECTF--
string(36) "Cannot unpack array with string keys"
string(42) "Cannot unpack Traversable with string keys"
