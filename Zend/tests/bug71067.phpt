--TEST--
Bug #71067 (Local object in class method stays in memory for each call)
--INI--
opcache.enable=0
error_reporting=0
--FILE--
<?php

class Test
{
    public function test()
    {
        $arr = (object) ['children' => []];
        $arr->children[] = 1;
        return $arr;
    }
}
function fn75580677()
{
    $o = new Test();
    $o->test();
    print_r($o->test());
}
fn75580677();
--EXPECT--
stdClass Object
(
    [children] => Array
        (
            [0] => 1
        )

)
