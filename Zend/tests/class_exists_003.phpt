--TEST--
Checking if exists interface, trait, abstract and final class
--FILE--
<?php

interface a
{
}
abstract class b
{
}
final class c
{
}
trait d
{
}
function fn355001972()
{
    var_dump(class_exists('a'));
    var_dump(class_exists('b'));
    var_dump(class_exists('c'));
    var_dump(class_exists('d'));
}
fn355001972();
--EXPECT--
bool(false)
bool(true)
bool(true)
bool(false)
