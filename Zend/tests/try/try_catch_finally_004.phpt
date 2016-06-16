--TEST--
Try catch finally (re-throw exception in catch block)
--CREDITS--
adoy
--FILE--
<?php

function dummy($msg)
{
    var_dump($msg);
}
function fn96740452()
{
    try {
        try {
            var_dump("try");
            return;
        } catch (Exception $e) {
            dummy("catch");
            throw $e;
        } finally {
            dummy("finally");
        }
    } catch (Exception $e) {
        dummy("catch2");
    } finally {
        dummy("finally2");
    }
    var_dump("end");
}
fn96740452();
--EXPECTF--
string(3) "try"
string(7) "finally"
string(8) "finally2"
