--TEST--
Classes do not exist at compile-time and have incorrect variance at runtime
--FILE--
<?php

if (true) {
    class X {}
    class Y {}
}

class A {
    public function method(): X {}
}
class B extends A {
    public function method(): Y {}
}

?>
--EXPECT--
Should fail.
