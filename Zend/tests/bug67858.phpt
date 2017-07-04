--TEST--
Bug #67858: Leak when $php_errormsg already set
--INI--
track_errors=1
error_reporting=E_ALL
--FILE--
<?php

function f()
{
    $php_errormsg = [1, 2, 3];
    echo $var;
    var_dump($php_errormsg);
}
function fn1952967160()
{
    f();
}
fn1952967160();
--EXPECTF--
Deprecated: Directive 'track_errors' is deprecated in Unknown on line %d

Notice: Undefined variable: var in %s on line %d
string(23) "Undefined variable: var"
