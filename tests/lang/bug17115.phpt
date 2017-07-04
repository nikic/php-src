--TEST--
Bug #17115 (lambda functions produce segfault with static vars)
--FILE--
<?php

function fn295533997()
{
    $func = create_function('', '
	static $foo = 0;
	return $foo++;
');
    var_dump($func());
    var_dump($func());
    var_dump($func());
}
fn295533997();
--EXPECTF--
Deprecated: Function create_function() is deprecated in %s on line %d
int(0)
int(1)
int(2)
