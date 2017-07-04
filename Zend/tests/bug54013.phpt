--TEST--
Bug #54013 (ReflectionParam for duplicate parameter contains garbage) (PHP7)
--FILE--
<?php

class a
{
    function b($aaaaaaaa, $aaaaaaaa)
    {
        $params = func_get_args();
    }
}
function fn760241717()
{
    $c = new a();
    $c->b('waa?', 'meukee!');
    $reflectionClass = new ReflectionClass($c);
    $params = $reflectionClass->getMethod('b')->getParameters();
    var_dump($params[0], $params[1]);
}
fn760241717();
--EXPECTF--
Fatal error: Redefinition of parameter $aaaaaaaa in %sbug54013.php on line %d
