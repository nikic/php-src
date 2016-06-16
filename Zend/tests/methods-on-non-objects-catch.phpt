--TEST--
Catch method calls on non-objects raise recoverable errors
--FILE--
<?php

function fn370566410()
{
    set_error_handler(function ($code, $message) {
        var_dump($code, $message);
    });
    $x = null;
    try {
        var_dump($x->method());
    } catch (Error $e) {
        var_dump($e->getCode(), $e->getMessage());
    }
    echo "Alive\n";
}
fn370566410();
--EXPECTF--

int(0)
string(%d) "Call to a member function method() on null"
Alive
