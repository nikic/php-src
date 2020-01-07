--TEST--
Static return type
--FILE--
<?php

class A {
    public function test1(): static {
        return new static;
    }
    public function test2(): static {
        return new self;
    }
    public function test3(): static {
        return new static;
    }
    public function test4(): static|array {
        return new self;
    }
}

class B extends A {
    public function test3(): static {
        return new C;
    }
}

class C extends B {}

function test(): static {
    return new stdClass;
}

$a = new A;
$b = new B;

var_dump($a->test1());
var_dump($b->test1());

echo "\n";
var_dump($a->test2());
try {
    var_dump($b->test2());
} catch (TypeError $e) {
    echo $e->getMessage(), "\n";
}

echo "\n";
var_dump($a->test3());
var_dump($b->test3());

echo "\n";
var_dump($a->test4());
try {
    var_dump($b->test4());
} catch (TypeError $e) {
    echo $e->getMessage(), "\n";
}

echo "\n";
try {
    var_dump(test());
} catch (TypeError $e) {
    echo $e->getMessage(), "\n";
}

?>
--EXPECT--
object(A)#3 (0) {
}
object(B)#3 (0) {
}

object(A)#3 (0) {
}
Return value of A::test2() must be an instance of static, instance of A returned

object(A)#3 (0) {
}
object(C)#3 (0) {
}

object(A)#3 (0) {
}
Return value of A::test4() must be of type static|array, instance of A returned

Return value of test() must be an instance of static, instance of stdClass returned
