--TEST--
Trait using parent used inside class without parent
--FILE--
<?php
  
trait T {
    function foo(parent $x) {}
}

class A {
    use T;
}
class B extends A {
    function foo(parent $x) {}
}

?>
--EXPECTF--
Warning: Declaration of B::foo(A $x) should be compatible with A::foo(parent $x) in %s on line %d
