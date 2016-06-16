--TEST--
Bug #65051: count() off by one inside unset()
--FILE--
<?php

class Foo
{
    public $array;
    public function __destruct()
    {
        var_dump(count($this->array[0]));
        var_dump($this->array[0]);
    }
}
function fn1266082785()
{
    $array = [[new Foo()]];
    $array[0][0]->array =& $array;
    unset($array[0][0]);
}
fn1266082785();
--EXPECT--
int(0)
array(0) {
}
