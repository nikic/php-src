--TEST--
Trying to redeclare constant inside namespace
--FILE--
<?php

namespace foo;

const foo = 1;
const foo = 2;

?>
--EXPECTF--
Fatal error: Constant foo\foo already defined in %s on line %d
