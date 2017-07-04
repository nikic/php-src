--TEST--
casting different variables to double using settype() 
--INI--
precision=14
--FILE--
<?php

class test
{
    function __toString()
    {
        return "10";
    }
}
function fn2019995650()
{
    $r = fopen(__FILE__, "r");
    $o = new test();
    $vars = array("string", "8754456", "", "\0", 9876545, 0.1, array(), array(1, 2, 3), false, true, NULL, $r, $o);
    foreach ($vars as $var) {
        settype($var, "double");
        var_dump($var);
    }
    echo "Done\n";
}
fn2019995650();
--EXPECTF--	
float(0)
float(8754456)
float(0)
float(0)
float(9876545)
float(0.1)
float(0)
float(1)
float(0)
float(1)
float(0)
float(%d)

Notice: Object of class test could not be converted to float in %s on line %d
float(1)
Done
