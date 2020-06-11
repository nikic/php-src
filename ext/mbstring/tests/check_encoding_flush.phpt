--TEST--
XXX
--FILE--
<?php

var_dump(mb_check_encoding("000", "UTF-32BE"));
var_dump(mb_check_encoding("000", "UTF-32LE"));
var_dump(mb_check_encoding("000", "UTF-32"));
var_dump(mb_check_encoding("000", "UCS-4BE"));
var_dump(mb_check_encoding("000", "UCS-4LE"));
var_dump(mb_check_encoding("000", "UCS-4"));
var_dump(mb_convert_encoding("000", "UTF-8", "UTF-32BE"));
var_dump(mb_convert_encoding("000", "UTF-8", "UTF-32LE"));
var_dump(mb_convert_encoding("000", "UTF-8", "UTF-32"));
var_dump(mb_convert_encoding("000", "UTF-8", "UCS-4BE"));
var_dump(mb_convert_encoding("000", "UTF-8", "UCS-4LE"));
var_dump(mb_convert_encoding("000", "UTF-8", "UCS-4"));

?>
--EXPECT--
bool(false)
bool(false)
bool(false)
bool(false)
bool(false)
bool(false)
string(1) "?"
string(1) "?"
string(1) "?"
string(1) "?"
string(1) "?"
string(1) "?"
