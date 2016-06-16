--TEST--
ZE2 object cloning, 6
--SKIPIF--
<?php if (version_compare(zend_version(), '2.0.0-dev', '<')) die('skip ZendEngine 2 needed'); ?>
--INI--
error_reporting=2047
--FILE--
<?php

class MyCloneable
{
    static $id = 0;
    function __construct()
    {
        $this->id = self::$id++;
    }
    function __clone()
    {
        $this->address = "New York";
        $this->id = self::$id++;
    }
}
function fn112116207()
{
    $original = new MyCloneable();
    $original->name = "Hello";
    $original->address = "Tel-Aviv";
    echo $original->id . "\n";
    $clone = clone $original;
    echo $clone->id . "\n";
    echo $clone->name . "\n";
    echo $clone->address . "\n";
}
fn112116207();
--EXPECTF--
Notice: Accessing static property MyCloneable::$id as non static in %s on line %d

Notice: Accessing static property MyCloneable::$id as non static in %s on line %d
0

Notice: Accessing static property MyCloneable::$id as non static in %s on line %d

Notice: Accessing static property MyCloneable::$id as non static in %s on line %d
1
Hello
New York
