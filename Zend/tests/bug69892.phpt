--TEST--
Bug #69892: Different arrays compare indentical due to integer key truncation
--SKIPIF--
<?php if (PHP_INT_SIZE != 8) die("skip this test is for 64bit platforms only"); ?>
--FILE--
<?php

function fn830953631()
{
    var_dump([0 => 0] === [0x100000000 => 0]);
}
fn830953631();
--EXPECT--
bool(false)
