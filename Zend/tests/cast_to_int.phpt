--TEST--
casting different variables to integer
--FILE--
<?php

class test
{
    function __toString()
    {
        return "10";
    }
}
function fn459720990()
{
    $r = fopen(__FILE__, "r");
    $o = new test();
    $vars = array("string", "8754456", "", "\0", 9876545, 0.1, array(), array(1, 2, 3), false, true, NULL, $r, $o);
    foreach ($vars as $var) {
        $tmp = (int) $var;
        var_dump($tmp);
    }
    echo "Done\n";
}
fn459720990();
--EXPECTF--	
int(0)
int(8754456)
int(0)
int(0)
int(9876545)
int(0)
int(0)
int(1)
int(0)
int(1)
int(0)
int(%d)

Notice: Object of class test could not be converted to int in %s on line %d
int(1)
Done
