--TEST--
Bug #61000 (Exceeding max nesting level doesn't delete numerical vars)
--INI--
max_input_nesting_level=2
--POST--
1[a][]=foo&1[a][b][c]=bar
--GET--
a[a][]=foo&a[a][b][c]=bar
--FILE--
<?php

function fn543632896()
{
    print_r($_GET);
    print_r($_POST);
}
fn543632896();
--EXPECTF--
Array
(
)
Array
(
)
