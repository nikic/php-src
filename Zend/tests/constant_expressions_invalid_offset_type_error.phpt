--TEST--
Can't use arrays as key for constant array
--FILE--
<?php

const C2 = [C1, [] => 1];
const C1 = 1; // force dynamic evaluation
var_dump(C2);

?>
--EXPECTF--
Fatal error: Uncaught TypeError: Illegal offset type in %s:%d
Stack trace:
#0 {main}
  thrown in %s on line %d
