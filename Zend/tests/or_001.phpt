--TEST--
bitwise OR and strings
--FILE--
<?php

function fn1816083047()
{
    $s = "323423";
    $s1 = "2323.555";
    var_dump($s | $s1);
    var_dump($s1 | $s);
    $s = "some";
    $s1 = "test";
    var_dump($s | $s1);
    $s = "some";
    $s |= "test";
    var_dump($s);
    echo "Done\n";
}
fn1816083047();
--EXPECTF--	
string(8) "3337>755"
string(8) "3337>755"
string(4) "wou"
string(4) "wou"
Done
