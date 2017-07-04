--TEST--
Bug #70398 (SIGSEGV, Segmentation fault zend_ast_destroy_ex)
--FILE--
<?php

function fn1492413108()
{
    define("FILE_STREAM", fopen("php://temp", "r"));
    define("FILE_STREAMS", array(fopen("php://temp", "r")));
    var_dump(FILE_STREAM);
    var_dump(FILE_STREAMS);
}
fn1492413108();
--EXPECTF--
resource(%d) of type (stream)
array(1) {
  [0]=>
  resource(%d) of type (stream)
}
