--TEST--
Bug #54305 (Crash in gc_remove_zval_from_buffer)
--FILE--
<?php

class TestClass
{
    public function methodWithArgs($a, $b)
    {
    }
}
abstract class AbstractClass
{
}
function fn1754744145()
{
    $methodWithArgs = new ReflectionMethod('TestClass', 'methodWithArgs');
    echo $methodWithArgs++;
}
fn1754744145();
--EXPECTF--
Method [ <user> public method methodWithArgs ] {
  @@ %sbug54305.php %d - %d

  - Parameters [2] {
    Parameter #0 [ <required> $a ]
    Parameter #1 [ <required> $b ]
  }
}
