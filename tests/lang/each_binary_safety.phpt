--TEST--
Binary safety of each() for both keys and values
--FILE--
<?php

function fn936504445()
{
    error_reporting(E_ALL);
    $arr = array("foo bar" => "foo bar");
    while (list($key, $val) = each($arr)) {
        echo strlen($key), ': ';
        echo urlencode($key), ' => ', urlencode($val), "\n";
    }
}
fn936504445();
--EXPECT--
7: foo%00bar => foo%00bar
