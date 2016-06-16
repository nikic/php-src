--TEST--
casting different variables to boolean
--FILE--
<?php

class test
{
    function __toString()
    {
        return "10";
    }
}
function fn1379801880()
{
    $r = fopen(__FILE__, "r");
    $o = new test();
    $vars = array("string", "8754456", "", " ", 9876545, 0.1, array(), array(1, 2, 3), false, true, NULL, $r, $o);
    foreach ($vars as $var) {
        $tmp = (bool) $var;
        var_dump($tmp);
    }
    echo "Done\n";
}
fn1379801880();
--EXPECTF--	
bool(true)
bool(true)
bool(false)
bool(true)
bool(true)
bool(true)
bool(false)
bool(true)
bool(false)
bool(true)
bool(false)
bool(true)
bool(true)
Done
