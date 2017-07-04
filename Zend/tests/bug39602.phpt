--TEST--
Bug #39602 (Invalid session.save_handler crashes PHP)
--SKIPIF--
<?php if (!extension_loaded("session")) die("skip session extension required"); ?>
--INI--
session.save_handler=qwerty
error_reporting=0
--FILE--
<?php

function fn1929909482()
{
    ini_set("session.save_handler", "files");
    $x = new stdClass();
    echo "ok";
}
fn1929909482();
--EXPECT--
ok
