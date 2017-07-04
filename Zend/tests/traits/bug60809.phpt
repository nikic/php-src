--TEST--
Bug #60809 (TRAITS - PHPDoc Comment Style Bug)
--FILE--
<?php

class ExampleParent
{
    private $hello_world = "hello foo\n";
    public function foo()
    {
        echo $this->hello_world;
    }
}
class Example extends ExampleParent
{
    use ExampleTrait;
}
trait ExampleTrait
{
    /**
     *
     */
    private $hello_world = "hello bar\n";
    /**
     *
     */
    public $prop = "ops";
    public function bar()
    {
        echo $this->hello_world;
    }
}
function fn1526757834()
{
    $x = new Example();
    $x->foo();
    $x->bar();
}
fn1526757834();
--EXPECT--
hello foo
hello bar
