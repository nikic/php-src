--TEST--
openbase_dir runtime tightning
--SKIPIF--
<?php
if (substr(PHP_OS, 0, 3) == 'WIN') {
	die('skip.. only for unix');
}
if (!is_dir("/usr/local/bin")) {
	die('skip.. no /usr/local/bin on this machine');
}
--INI--
open_basedir=/usr/local
--FILE--
<?php

function fn796643293()
{
    var_dump(ini_set("open_basedir", "/usr/local/bin"));
    var_dump(ini_get("open_basedir"));
    var_dump(ini_set("open_basedir", "/usr"));
    var_dump(ini_get("open_basedir"));
}
fn796643293();
--EXPECT--
string(10) "/usr/local"
string(14) "/usr/local/bin"
bool(false)
string(14) "/usr/local/bin"

