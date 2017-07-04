--TEST--
Bug #46308 (Invalid write when changing property from inside getter)
--FILE--
<?php

class main
{
    public static $dummy = NULL;
    public static $dataAccessor = NULL;
}
class dataAccessor
{
}
class relay
{
    public function __get($name)
    {
        main::$dataAccessor = new dataAccessor();
    }
}
class dummy
{
}
function fn1696290734()
{
    main::$dummy = new dummy();
    main::$dataAccessor = new relay();
    main::$dataAccessor->bar;
    echo "ok\n";
}
fn1696290734();
--EXPECT--
ok
