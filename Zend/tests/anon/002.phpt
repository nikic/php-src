--TEST--
declare anonymous class extending another
--FILE--
<?php

class A
{
}
interface B
{
    public function method();
}
function fn2004453338()
{
    $a = new class extends A implements B
    {
        public function method()
        {
            return true;
        }
    };
    var_dump($a instanceof A, $a instanceof B);
}
fn2004453338();
--EXPECTF--
bool(true)
bool(true)

