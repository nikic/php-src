--TEST--
Bug #23279 (exception handler stops after first function call)
--FILE--
<?php

function redirect_on_error($e)
{
    ob_end_clean();
    echo "Goodbye Cruel World\n";
}
function fn605200673()
{
    ob_start();
    set_exception_handler('redirect_on_error');
    echo "Hello World\n";
    throw new Exception();
}
fn605200673();
--EXPECT--
Goodbye Cruel World
