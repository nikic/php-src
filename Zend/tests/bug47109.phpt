--TEST--
Bug #47109 (Memory leak on $a->{"a"."b"} when $a is not an object)
--FILE--
<?php

function fn67039740()
{
    $a->{"a" . "b"};
}
fn67039740();
--EXPECTF--
Notice: Undefined variable: a in %sbug47109.php on line %d

Notice: Trying to get property of non-object in %sbug47109.php on line %d

