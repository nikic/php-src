--TEST--
Test generic syntax
--FILE--
<?php

class Foo { const BAR = 42; }
var_dump(Foo<A>::BAR);
var_dump(Foo<A, B>::BAR);
var_dump(new Foo<A>);
var_dump(new Foo<A>(1));
var_dump(new Foo<A, B>);
var_dump(new Foo<A, B>(1));

?>
--EXPECT--
int(42)
int(42)
object(Foo)#1 (0) {
}
object(Foo)#1 (0) {
}
object(Foo)#1 (0) {
}
object(Foo)#1 (0) {
}
