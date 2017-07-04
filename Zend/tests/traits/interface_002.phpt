--TEST--
Checking error message when the trait doesn't implements the interface
--FILE--
<?php

trait foo
{
    public function a()
    {
    }
}
interface baz
{
    public function abc();
}
class bar implements baz
{
    use foo;
}
function fn1620252797()
{
    new bar();
}
fn1620252797();
--EXPECTF--
Fatal error: Class bar contains 1 abstract method and must therefore be declared abstract or implement the remaining methods (baz::abc) in %s on line %d
