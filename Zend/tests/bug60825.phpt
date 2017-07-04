--TEST--
Bug #60825 (Segfault when running symfony 2 tests) (PHP7)
--DESCRIPTION--
run this with valgrind
--FILE--
<?php

class test
{
    public static $x;
    public function __toString()
    {
        self::$x = $this;
        return __FILE__;
    }
}
function fn1558329704()
{
    $a = new test();
    require_once $a;
    debug_zval_dump($a, test::$x);
}
fn1558329704();
--EXPECTF--
object(test)#%d (0) refcount(%d){
}
object(test)#%d (0) refcount(%d){
}
