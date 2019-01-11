--TEST--
Property types in inference
--INI--
opcache.enable=1
opcache.enable_cli=1
opcache.optimization_level=-1
opcache.opt_debug_level=0x200000
opcache.preload=
--SKIPIF--
<?php require_once('skipif.inc'); ?>
--FILE--
<?php

class Test {
    public bool $public;
    protected int $protected;
    private float $private;

    public function inTest() {
        var_dump($this->public, $this->protected, $this->private);
    }

    public function inTestWithTest2(Test2 $test2) {
        var_dump($test2->public, $test2->protected, $test2->private);
    }
}

class Test2 extends Test {
    private array $private;

    public function inTest2() {
        var_dump($this->public, $this->protected, $this->private);
    }
}

function noScope(Test $test) {
    var_dump($test->public, $test->protected, $test->private);
}

?>
--EXPECTF--
$_main: ; (lines=2, args=0, vars=0, tmps=0, ssa_vars=0, no_loops)
    ; (before dfa pass)
    ; %s
    ; return  [long] RANGE[1..1]
BB0: start exit lines=[0-1]
    ; level=0
            VERIFY_VARIANCE string("test2")
            RETURN int(1)

noScope: ; (lines=10, args=1, vars=1, tmps=1, ssa_vars=5, no_loops)
    ; (before dfa pass)
    ; %s
    ; return  [null] RANGE[0..0]
    ; #0.CV0($test) NOVAL [undef]
BB0: start exit lines=[0-9]
    ; level=0
            #1.CV0($test) [object (instanceof Test)] = RECV 1
            INIT_FCALL 3 %d string("var_dump")
            #2.T1 [bool] = FETCH_OBJ_R #1.CV0($test) [object (instanceof Test)] string("public")
            SEND_VAL #2.T1 [bool] 1
            #3.T1 [any] = FETCH_OBJ_R #1.CV0($test) [object (instanceof Test)] string("protected")
            SEND_VAL #3.T1 [any] 2
            #4.T1 [any] = FETCH_OBJ_R #1.CV0($test) [object (instanceof Test)] string("private")
            SEND_VAL #4.T1 [any] 3
            DO_ICALL
            RETURN null

Test::inTest: ; (lines=9, args=0, vars=0, tmps=1, ssa_vars=3, no_loops)
    ; (before dfa pass)
    ; %s
    ; return  [null] RANGE[0..0]
BB0: start exit lines=[0-8]
    ; level=0
            INIT_FCALL 3 %d string("var_dump")
            #0.T0 [bool] = FETCH_OBJ_R THIS string("public")
            SEND_VAL #0.T0 [bool] 1
            #1.T0 [long] = FETCH_OBJ_R THIS string("protected")
            SEND_VAL #1.T0 [long] 2
            #2.T0 [double] = FETCH_OBJ_R THIS string("private")
            SEND_VAL #2.T0 [double] 3
            DO_ICALL
            RETURN null

Test::inTestWithTest2: ; (lines=10, args=1, vars=1, tmps=1, ssa_vars=5, no_loops)
    ; (before dfa pass)
    ; %s
    ; return  [null] RANGE[0..0]
    ; #0.CV0($test2) NOVAL [undef]
BB0: start exit lines=[0-9]
    ; level=0
            #1.CV0($test2) [object (instanceof Test2)] = RECV 1
            INIT_FCALL 3 %d string("var_dump")
            #2.T1 [bool] = FETCH_OBJ_R #1.CV0($test2) [object (instanceof Test2)] string("public")
            SEND_VAL #2.T1 [bool] 1
            #3.T1 [long] = FETCH_OBJ_R #1.CV0($test2) [object (instanceof Test2)] string("protected")
            SEND_VAL #3.T1 [long] 2
            #4.T1 [double] = FETCH_OBJ_R #1.CV0($test2) [object (instanceof Test2)] string("private")
            SEND_VAL #4.T1 [double] 3
            DO_ICALL
            RETURN null

Test2::inTest2: ; (lines=9, args=0, vars=0, tmps=1, ssa_vars=3, no_loops)
    ; (before dfa pass)
    ; %s
    ; return  [null] RANGE[0..0]
BB0: start exit lines=[0-8]
    ; level=0
            INIT_FCALL 3 %d string("var_dump")
            #0.T0 [bool] = FETCH_OBJ_R THIS string("public")
            SEND_VAL #0.T0 [bool] 1
            #1.T0 [long] = FETCH_OBJ_R THIS string("protected")
            SEND_VAL #1.T0 [long] 2
            #2.T0 [array of [any, ref]] = FETCH_OBJ_R THIS string("private")
            SEND_VAL #2.T0 [array of [any, ref]] 3
            DO_ICALL
            RETURN null
