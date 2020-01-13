--TEST--
Concrete parameterized types used in type expressions
--FILE--
<?php

abstract class AbstractTest<T> {
    public function method(T $param) {
        var_dump($param);
    }
}

class ConcreteInt extends AbstractTest<int> {
}

class ConcreteString extends AbstractTest<string> {
}

function test(AbstractTest<int> $test) {
    $test->method(42);
}

test(new ConcreteInt);
// This should throw
test(new ConcreteString);

?>
--EXPECT--
int(42)
string(2) "42"
