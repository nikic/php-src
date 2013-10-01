--TEST--
Bug #47704 (crashes on some "bad" operations with string offsets)
--FILE--
<?php
$s = "abd";
$s[0]->a += 1;
?>
--EXPECTF--
Fatal error: Uncaught exception 'EngineException' with message 'Cannot use string offset as an object' in %s:%d
Stack trace:
#0 {main}
  thrown in %s on line %d
