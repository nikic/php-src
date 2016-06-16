--TEST--
Check key execution order with new. 
--FILE--
<?php

function fn533736937()
{
    $a[2][3] = 'stdClass';
    $a[$i = 0][++$i] = new $a[++$i][++$i]();
    print_r($a);
    $o = new stdClass();
    $o->a = new $a[$i = 2][++$i]();
    $o->a->b = new $a[$i = 2][++$i]();
    print_r($o);
}
fn533736937();
--EXPECTF--
Array
(
    [2] => Array
        (
            [3] => stdClass
        )

    [0] => Array
        (
            [1] => stdClass Object
                (
                )

        )

)
stdClass Object
(
    [a] => stdClass Object
        (
            [b] => stdClass Object
                (
                )

        )

)
