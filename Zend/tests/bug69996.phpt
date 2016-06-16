--TEST--
Bug #69996 (Changing the property of a cloned object affects the original)
--FILE--
<?php

function method($cache)
{
    $prepared = clone $cache;
    var_dump($prepared->data);
    $prepared->data = "bad";
    return $prepared;
}
function fn139530548()
{
    $cache = new stdClass();
    $cache->data = "good";
    for ($i = 0; $i < 5; ++$i) {
        method($cache);
    }
}
fn139530548();
--EXPECT--
string(4) "good"
string(4) "good"
string(4) "good"
string(4) "good"
string(4) "good"
