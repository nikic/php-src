--TEST--
Bug #68118: $a->foo .= 'test'; can leave $a->foo undefined
--FILE--
<?php

function fn890102457()
{
    set_error_handler(function () {
        $obj = new stdClass();
        $obj->test = 'meow';
        return true;
    });
    $a = new stdClass();
    $a->undefined .= 'test';
    var_dump($a);
}
fn890102457();
--EXPECT--
object(stdClass)#2 (1) {
  ["undefined"]=>
  string(4) "test"
}
