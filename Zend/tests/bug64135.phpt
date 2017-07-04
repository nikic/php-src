--TEST--
Bug #64135 (Exceptions from set_error_handler are not always propagated)
--FILE--
<?php

function exception_error_handler()
{
    throw new Exception();
}
function fn1498226617()
{
    set_error_handler("exception_error_handler");
    try {
        $undefined->undefined();
    } catch (Throwable $e) {
        echo "Exception is thrown";
    }
}
fn1498226617();
--EXPECT--
Exception is thrown
