--TEST--
Bug #60569 (Nullbyte truncates Exception $message.)
--FILE--
<?php

function fn1041282446()
{
    try {
        $msg = "Some error \0 message";
        throw new Exception($msg);
    } catch (Exception $e) {
        var_dump($e->getMessage(), $msg);
    }
}
fn1041282446();
--EXPECT--
string(20) "Some error   message"
string(20) "Some error   message"
