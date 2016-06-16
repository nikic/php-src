--TEST--
Ensure catch blocks for unknown exception types do not trigger autoload.
--FILE--
<?php

function __autoload($name)
{
    echo "In autoload: ";
    var_dump($name);
}
function f()
{
    throw new Exception();
}
function fn494122982()
{
    try {
        f();
    } catch (UndefC $u) {
        echo "In UndefClass catch block.\n";
    } catch (Exception $e) {
        echo "In Exception catch block. Autoload should not have been triggered.\n";
    }
}
fn494122982();
--EXPECTF--
In Exception catch block. Autoload should not have been triggered.
