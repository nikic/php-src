--TEST--
Testing isset and unset with variable variables
--FILE--
<?php

function fn1101747383()
{
    print "- isset ---\n";
    $var_name = 'unexisting';
    if (isset(${$var_name})) {
        print "error\n";
    }
    $test = 'var_name';
    if (isset(${${$test}})) {
        print "error\n";
    }
    print "- unset ---\n";
    unset(${$var_name});
    unset(${${$test}});
    print "done\n";
}
fn1101747383();
--EXPECT--
- isset ---
- unset ---
done
