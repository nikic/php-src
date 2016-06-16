--TEST--
Closure 013: __invoke() on temporary result
--FILE--
<?php

class Foo
{
    function __invoke()
    {
        echo "Hello World!\n";
    }
}
function foo()
{
    return function () {
        echo "Hello World!\n";
    };
}
function fn991338909()
{
    $test = new Foo();
    $test->__invoke();
    $test = foo();
    $test->__invoke();
    $test = foo()->__invoke();
}
fn991338909();
--EXPECT--
Hello World!
Hello World!
Hello World!
