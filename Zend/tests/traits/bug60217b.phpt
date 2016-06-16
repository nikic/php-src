--TEST--
Bug #60217 (Requiring the same method from different traits and abstract methods have to be compatible)
--FILE--
<?php

trait TBroken1
{
    public abstract function foo($a);
}
trait TBroken2
{
    public abstract function foo($a, $b = 0);
}
class CBroken
{
    use TBroken1, TBroken2;
    public function foo($a)
    {
        echo 'FOO';
    }
}
function fn1043493091()
{
    $o = new CBroken();
    $o->foo(1);
}
fn1043493091();
--EXPECTF--
Fatal error: Declaration of TBroken2::foo($a, $b = 0) must be compatible with TBroken1::foo($a) in %s on line %d
