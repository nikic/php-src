--TEST--
Bug #33771 (error_reporting falls to 0 when @ was used inside try/catch block)
--FILE--
<?php

function make_exception()
{
    throw new Exception();
}
function make_exception_and_change_err_reporting()
{
    error_reporting(E_ALL & ~E_STRICT);
    throw new Exception();
}
function fn411271420()
{
    error_reporting(E_ALL | E_STRICT);
    var_dump(error_reporting());
    try {
        @make_exception();
    } catch (Exception $e) {
    }
    var_dump(error_reporting());
    try {
        @make_exception_and_change_err_reporting();
    } catch (Exception $e) {
    }
    var_dump(error_reporting());
    echo "Done\n";
}
fn411271420();
--EXPECTF--	
int(32767)
int(32767)
int(30719)
Done
