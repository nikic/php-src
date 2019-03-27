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
--EXPECTF--
Fatal error: Declaration of B::method(): Y must be compatible with A::method(): X in %s on line 12
