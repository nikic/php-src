--TEST--
Bug #24783 ($key not binary safe in "foreach($arr as $key => $val)")
--FILE--
<?php

function fn286750268()
{
    error_reporting(E_ALL);
    $arr = array("foo bar" => "foo bar");
    foreach ($arr as $key => $val) {
        echo strlen($key), ': ';
        echo urlencode($key), ' => ', urlencode($val), "\n";
    }
}
fn286750268();
--EXPECT--
7: foo%00bar => foo%00bar
