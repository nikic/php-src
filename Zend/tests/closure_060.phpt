--TEST--
runtime cache must be invalidated for Closure::call()
--FILE--
<?php

class A
{
    private static $priv = 7;
    static function get()
    {
        return function () {
            var_dump(isset(A::$priv));
        };
    }
}
function fn359101146()
{
    $closure = A::get();
    $closure();
    // init rt_cache
    $closure->call(new class
    {
    }, null);
    $closure();
}
fn359101146();
--EXPECT--
bool(true)
bool(false)
bool(true)
