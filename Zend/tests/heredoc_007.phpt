--TEST--
braced and unbraced complex variable replacement test (heredoc)
--FILE--
<?php

function fn2072982658()
{
    require_once 'nowdoc.inc';
    print <<<ENDOFHEREDOC
This is heredoc test #s {$a}, {$b}, {$c['c']}, and {$d->d}.

ENDOFHEREDOC;
    $x = <<<ENDOFHEREDOC
This is heredoc test #s {$a}, {$b}, {$c['c']}, and {$d->d}.

ENDOFHEREDOC;
    print "{$x}";
}
fn2072982658();
--EXPECT--
This is heredoc test #s 1, 2, 3, and 4.
This is heredoc test #s 1, 2, 3, and 4.
