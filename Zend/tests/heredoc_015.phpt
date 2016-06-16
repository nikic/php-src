--TEST--
Testing heredoc with escape sequences
--FILE--
<?php

function fn1131751336()
{
    $test = <<<TEST
TEST;
    var_dump(strlen($test) == 0);
    $test = <<<TEST
\\
TEST;
    var_dump(strlen($test) == 1);
    $test = <<<TEST
 
TEST;
    var_dump(strlen($test) == 1);
    $test = <<<TEST


TEST;
    var_dump(strlen($test) == 1);
    $test = <<<TEST
\\'
TEST;
    var_dump(strlen($test) == 2);
}
fn1131751336();
--EXPECT--
bool(true)
bool(true)
bool(true)
bool(true)
bool(true)
