--TEST--
bug79897: Promoted constructor params with attribs cause crash
--FILE--
<?php

#[Attribute]
class B {
    public function __construct($value)
    {
    }
}

class A {
    public function __construct(
        #[B(12, X)] public $b
    )
    {
    }
}

const X = 42;

var_dump((new ReflectionParameter(['A', '__construct'], 'b'))->getAttributes()[0]->getArguments());
var_dump((new ReflectionProperty('A', 'b'))->getAttributes()[0]->getArguments());
?>
--EXPECTF--
Fatal error: Attributes on promoted properties are currently not supported in %s on line %d
