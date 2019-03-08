--TEST--
fwrite() tests
--FILE--
<?php

$filename = dirname(__FILE__)."/fwrite.dat";

$fp = fopen($filename, "r");
var_dump(fwrite($fp, "data"));

$fp = fopen($filename, "w");
var_dump(fwrite($fp, "data", -1));
var_dump(fwrite($fp, "data", 100000));
fclose($fp);

var_dump(fwrite($fp, "data", -1));

var_dump(file_get_contents($filename));

@unlink($filename);
echo "Done\n";
?>
--EXPECTF--
int(0)
int(0)
int(4)
int(0)
string(4) "data"
Done
