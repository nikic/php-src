--TEST--
Bug #72119 (Interface declaration compatibility regression with default values)
--FILE--
<?php

interface Foo
{
    public function bar(array $baz = null);
}
class Hello implements Foo
{
    public function bar(array $baz = [])
    {
    }
}
function fn714000415()
{
    echo "OK\n";
}
fn714000415();
--EXPECTF--
Fatal error: Declaration of Hello::bar(array $baz = Array) must be compatible with Foo::bar(?array $baz = NULL) in %s on line %d

