--TEST--
Ensure valid vm_stack even when it needed to be copied to a new page
--FILE--
<?php

function f(...$args)
{
    var_dump(count($args));
}
function fn1210557626()
{
    (function () {
        $a = array_fill(0, 1024, true);
        f(...$a);
        yield;
    })()->valid();
}
fn1210557626();
--EXPECT--
int(1024)
