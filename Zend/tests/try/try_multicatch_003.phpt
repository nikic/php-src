--TEST--
Catch second exception in the multicatch
--FILE--
<?php

function fn999478583()
{
    require_once __DIR__ . '/exceptions.inc';
    try {
        echo 'TRY' . PHP_EOL;
        throw new Exception2();
    } catch (Exception1|Exception2|Exception3 $e) {
        echo get_class($e) . PHP_EOL;
    } finally {
        echo 'FINALLY' . PHP_EOL;
    }
}
fn999478583();
--EXPECT--
TRY
Exception2
FINALLY
