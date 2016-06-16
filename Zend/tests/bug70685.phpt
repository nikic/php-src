--TEST--
Bug #70685: Segfault for getClosure() internal method rebind with invalid $this
--FILE--
<?php

class cls
{
}
function fn1668519604()
{
    $c = (new ReflectionMethod('SplStack', 'count'))->getClosure(new SplStack());
    $c = $c->bindTo(new cls());
    var_dump($c);
    $c = (new ReflectionMethod('SplStack', 'count'))->getClosure(new SplStack());
    $c = $c->bindTo(new SplStack(), 'cls');
    var_dump($c);
}
fn1668519604();
--EXPECTF--
Warning: Cannot bind method SplDoublyLinkedList::count() to object of class cls in %s on line %d
NULL

Warning: Cannot rebind scope of closure created by ReflectionFunctionAbstract::getClosure() in %s on line %d
NULL
