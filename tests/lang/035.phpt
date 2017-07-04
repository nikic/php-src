--TEST--
ZE2: set_exception_handler()
--FILE--
<?php

class MyException extends Exception
{
    function __construct($_error)
    {
        $this->error = $_error;
    }
    function getException()
    {
        return $this->error;
    }
}
function ThrowException()
{
    throw new MyException("'This is an exception!'");
}
function fn1516893848()
{
    try {
    } catch (MyException $exception) {
        print "There shouldn't be an exception: " . $exception->getException();
        print "\n";
    }
    try {
        ThrowException();
    } catch (MyException $exception) {
        print "There was an exception: " . $exception->getException();
        print "\n";
    }
}
fn1516893848();
--EXPECT--
There was an exception: 'This is an exception!'
