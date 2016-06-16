--TEST--
Testing heredoc (double quotes) with escape sequences
--FILE--
<?php

function fn718044908()
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
fn718044908();
--EXPECT--
bool(true)
bool(true)
bool(true)
bool(true)
bool(true)
