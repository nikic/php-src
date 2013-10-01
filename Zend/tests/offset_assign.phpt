--TEST--
Crash on $x['x']['y'] += 1 when $x is string
--FILE--
<?php
$x = "a";
$x['x']['y'] += 1; 

echo "Done\n";
?>
--EXPECTF--	
Warning: Illegal string offset 'x' in %soffset_assign.php on line %d

Fatal error: Uncaught exception 'EngineException' with message 'Cannot use string offset as an array' in %s:%d
Stack trace:
#0 {main}
  thrown in %s on line %d
