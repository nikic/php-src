--TEST--
output buffering - ob_get_flush
--FILE--
<?php

function fn917053040()
{
    ob_start();
    echo "foo\n";
    var_dump(ob_get_flush());
}
fn917053040();
--EXPECT--
foo
string(4) "foo
"
