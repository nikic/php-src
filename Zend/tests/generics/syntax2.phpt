--TEST--
Generics syntax tests
--FILE--
<?php

// Using "final" because I only implemented the variant with modifiers...
final class Foo{T} { const BAR = 42; }
final class Bar{T : int|string} {}

var_dump(new Foo{T});
var_dump(Foo{T}::BAR);
var_dump(new Foo{A, B}(1));

// %A to suppress memory leaks from the parser

?>
--EXPECTF--
object(Foo)#1 (0) {
}
int(42)
object(Foo)#1 (0) {
}
%A
