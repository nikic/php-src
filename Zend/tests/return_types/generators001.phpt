--TEST--
Valid generator return types

--FILE--
<?php

function test1() : Generator
{
    (yield 1);
}
function test2() : Iterator
{
    (yield 2);
}
function test3() : Traversable
{
    (yield 3);
}
function fn1819785416()
{
    var_dump(test1(), test2(), test3());
}
fn1819785416();
--EXPECTF--
object(Generator)#%d (%d) {
}
object(Generator)#%d (%d) {
}
object(Generator)#%d (%d) {
}
