--TEST--
eval() test
--FILE--
<?php

function fn621177853()
{
    error_reporting(0);
    $message = "echo \"hey\n\";";
    for ($i = 0; $i < 10; $i++) {
        eval($message);
        echo $i . "\n";
    }
}
fn621177853();
--EXPECT--
hey
0
hey
1
hey
2
hey
3
hey
4
hey
5
hey
6
hey
7
hey
8
hey
9
