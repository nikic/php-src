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
try {
    test(new ConcreteString);
} catch (TypeError $e) {
    echo $e->getMessage(), "\n";
}

?>
--EXPECTF--
Fatal error: Uncaught TypeError: Argument 1 passed to test() must be of type AbstractTest<int>, instance of ConcreteInt given, called in %s:%d
Stack trace:
#0 %s(%d): test(Object(ConcreteInt))
#1 {main}
  thrown in %s on line %d
