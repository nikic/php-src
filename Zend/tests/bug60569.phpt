--TEST--
Bug #60569 (Nullbyte truncates Exception $message.)
--FILE--
<?php

function fn1609692005()
{
    try {
        $msg = "Some error   message";
        throw new Exception($msg);
    } catch (Exception $e) {
        var_dump($e->getMessage(), $msg);
    }
}
fn1609692005();
--EXPECT--
string(20) "Some error   message"
string(20) "Some error   message"
