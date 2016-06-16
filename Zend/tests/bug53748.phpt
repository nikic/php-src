--TEST--
Bug #53748 (Using traits lead to a segmentation fault)
--FILE--
<?php

trait Singleton
{
    protected static $instances = array();
    protected abstract function __construct($config);
    public static function getInstance($config)
    {
        if (!isset(self::$instances[$serialize = serialize($config)])) {
            self::$instances[$serialize] = new self($config);
        }
        return self::$instances[$serialize];
    }
}
class MyHelloWorld
{
    use Singleton;
    public function __construct($config)
    {
        var_dump($config);
    }
}
function fn1789399684()
{
    $o = myHelloWorld::getInstance(1);
    $o = myHelloWorld::getInstance(1);
    $o = myHelloWorld::getInstance(2);
    $o = myHelloWorld::getInstance(array(1 => 2));
    $o = myHelloWorld::getInstance(array(1 => 2));
}
fn1789399684();
--EXPECTF--
int(1)
int(2)
array(1) {
  [1]=>
  int(2)
}
