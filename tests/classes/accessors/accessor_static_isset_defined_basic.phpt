--TEST--
ZE2 Tests that a static auto-implemented setter has a protected auto-implemented variable defined and that it can be set through the accessor
--FILE--
<?php

class AccessorTest {
	public static $b {
		set;
		isset {
			echo "static isset AccessorTest::\$b Called.\n"; 
			return self::$b != NULL;
		}
	}
}

echo "isset(AccessorTest::\$b) = ".(int)isset(AccessorTest::$b)."\n";
AccessorTest::$b = 10;
echo "AccessorTest::\$b = 10;\n";
echo "isset(AccessorTest::\$b) = ".(int)isset(AccessorTest::$b)."\n";
AccessorTest::$b = NULL;
echo "AccessorTest::\$b = NULL;\n";
echo "isset(AccessorTest::\$b) = ".(int)isset(AccessorTest::$b)."\n";
echo "Done";
?>
--EXPECTF--
static isset AccessorTest::$b Called.
isset(AccessorTest::$b) = 0
AccessorTest::$b = 10;
static isset AccessorTest::$b Called.
isset(AccessorTest::$b) = 1
AccessorTest::$b = NULL;
static isset AccessorTest::$b Called.
isset(AccessorTest::$b) = 0
Done