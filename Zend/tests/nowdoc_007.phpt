--TEST--
braced and unbraced complex variable replacement test (nowdoc)
--FILE--
<?php

function fn1744327463()
{
    require_once 'nowdoc.inc';
    print <<<'ENDOFNOWDOC'
This is nowdoc test #s $a, {$b}, {$c['c']}, and {$d->d}.

ENDOFNOWDOC;
    $x = <<<'ENDOFNOWDOC'
This is nowdoc test #s $a, {$b}, {$c['c']}, and {$d->d}.

ENDOFNOWDOC;
    print "{$x}";
}
fn1744327463();
--EXPECT--
This is nowdoc test #s $a, {$b}, {$c['c']}, and {$d->d}.
This is nowdoc test #s $a, {$b}, {$c['c']}, and {$d->d}.
