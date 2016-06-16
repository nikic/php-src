--TEST--
Yield can be used during a method call
--FILE--
<?php

class A
{
    public function b($c)
    {
        echo $c, "\n";
    }
}
function gen()
{
    $a = new A();
    $a->b(yield);
}
function fn263248333()
{
    $gen = gen();
    $gen->send('foo');
    // test resource cleanup
    $gen = gen();
    $gen->rewind();
    unset($gen);
}
fn263248333();
--EXPECT--
foo
