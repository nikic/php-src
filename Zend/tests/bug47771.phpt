--TEST--
Bug #47771 (Exception during object construction from arg call calls object's destructor)
--FILE--
<?php

function throw_exc()
{
    throw new Exception('TEST_EXCEPTION');
}
class Test
{
    public function __construct()
    {
        echo 'Constr' . "\n";
    }
    public function __destruct()
    {
        echo 'Destr' . "\n";
    }
}
function fn1480720843()
{
    try {
        $T = new Test(throw_exc());
    } catch (Exception $e) {
        echo 'Exception: ' . $e->getMessage() . "\n";
    }
}
fn1480720843();
--EXPECT--
Exception: TEST_EXCEPTION
