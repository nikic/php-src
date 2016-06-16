--TEST--
Closure 007: Nested lambdas in classes
--FILE--
<?php

class A
{
    private $x = 0;
    function getClosureGetter()
    {
        return function () {
            return function () {
                $this->x++;
            };
        };
    }
    function printX()
    {
        echo $this->x . "\n";
    }
}
function fn956230805()
{
    $a = new A();
    $a->printX();
    $getClosure = $a->getClosureGetter();
    $a->printX();
    $closure = $getClosure();
    $a->printX();
    $closure();
    $a->printX();
    echo "Done\n";
}
fn956230805();
--EXPECT--
0
0
0
1
Done
