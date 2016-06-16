--TEST--
ZE2 post increment/decrement property of overloaded object
--FILE--
<?php

class Test
{
    private $real_a = 2;
    function __set($property, $value)
    {
        if ($property == "a") {
            $this->real_a = $value;
        }
    }
    function __get($property)
    {
        if ($property == "a") {
            return $this->real_a;
        }
    }
}
function fn1394901908()
{
    $obj = new Test();
    var_dump($obj->a);
    $obj->a++;
    var_dump($obj->a);
    echo "---Done---\n";
}
fn1394901908();
--EXPECT--
int(2)
int(3)
---Done---
