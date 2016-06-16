--TEST--
Testing __debugInfo() magic method
--FILE--
<?php

class Foo
{
    public $d = 4;
    protected $e = 5;
    private $f = 6;
    public function __debugInfo()
    {
        return ['a' => 1, " * b" => 2, " Foo c" => 3];
    }
}
class Bar
{
    public $val = 123;
    public function __debugInfo()
    {
        return null;
    }
}
function fn1837418965()
{
    $f = new Foo();
    var_dump($f);
    $b = new Bar();
    var_dump($b);
}
fn1837418965();
--EXPECTF--
object(Foo)#%d (3) {
  ["a"]=>
  int(1)
  ["b":protected]=>
  int(2)
  ["c":"Foo":private]=>
  int(3)
}
object(Bar)#%d (0) {
}
