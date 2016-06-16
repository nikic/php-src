--TEST--
Bug #71300 (Segfault in zend_fetch_string_offset)
--FILE--
<?php

function test1()
{
    for ($n = 'a'; $n < 'g'; $n++) {
        ${$n} = 1;
    }
    ${$n} = ${$n}[++$n] = "test";
    return ${$n};
}
function test2()
{
    /* See #71303 for why not using for loop here */
    $n = "a";
    ${$n} .= ${$n}[++$n] = "test";
    return ${$n};
}
function fn205781145()
{
    var_dump(test1());
    var_dump(test2());
}
fn205781145();
--EXPECTF--
string(4) "test"

Notice: Array to string conversion in %sbug71300.php on line %d
string(9) "Arraytest"
