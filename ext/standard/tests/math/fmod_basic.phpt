--TEST--
Test fmod() - basic function test fmod()
--INI--
precision=14
--FILE--
<?php
$values1 = array(234,
				-234,
				23.45e1,
				-23.45e1,
				0xEA,
				0352,
				"234",
				"234.5",
				"23.45e1",
				null,
				true,
				false);

$values2 = array(2,
				-2,
				2.3e1,
				-2.3e1,
				0x2,
				02,
				"2",
				"2.3",
				"2.3e1",
				null,
				true,
				false);
for ($i = 0; $i < count($values1); $i++) {
	echo "\niteration ", $i, "\n";

	for ($j = 0; $j < count($values2); $j++) {
		$res = fmod($values1[$i], $values2[$j]);
		var_dump($res);
	}
}
?>
--EXPECTF--
iteration 0
float(0)
float(0)
float(4)
float(4)
float(0)
float(0)
float(0)
float(1.7)
float(4)

Deprecated: Passing null to argument of type float is deprecated in %s on line %d
float(NAN)
float(0)
float(NAN)

iteration 1
float(-0)
float(-0)
float(-4)
float(-4)
float(-0)
float(-0)
float(-0)
float(-1.7)
float(-4)

Deprecated: Passing null to argument of type float is deprecated in %s on line %d
float(NAN)
float(-0)
float(NAN)

iteration 2
float(0.5)
float(0.5)
float(4.5)
float(4.5)
float(0.5)
float(0.5)
float(0.5)
float(2.2)
float(4.5)

Deprecated: Passing null to argument of type float is deprecated in %s on line %d
float(NAN)
float(0.5)
float(NAN)

iteration 3
float(-0.5)
float(-0.5)
float(-4.5)
float(-4.5)
float(-0.5)
float(-0.5)
float(-0.5)
float(-2.2)
float(-4.5)

Deprecated: Passing null to argument of type float is deprecated in %s on line %d
float(NAN)
float(-0.5)
float(NAN)

iteration 4
float(0)
float(0)
float(4)
float(4)
float(0)
float(0)
float(0)
float(1.7)
float(4)

Deprecated: Passing null to argument of type float is deprecated in %s on line %d
float(NAN)
float(0)
float(NAN)

iteration 5
float(0)
float(0)
float(4)
float(4)
float(0)
float(0)
float(0)
float(1.7)
float(4)

Deprecated: Passing null to argument of type float is deprecated in %s on line %d
float(NAN)
float(0)
float(NAN)

iteration 6
float(0)
float(0)
float(4)
float(4)
float(0)
float(0)
float(0)
float(1.7)
float(4)

Deprecated: Passing null to argument of type float is deprecated in %s on line %d
float(NAN)
float(0)
float(NAN)

iteration 7
float(0.5)
float(0.5)
float(4.5)
float(4.5)
float(0.5)
float(0.5)
float(0.5)
float(2.2)
float(4.5)

Deprecated: Passing null to argument of type float is deprecated in %s on line %d
float(NAN)
float(0.5)
float(NAN)

iteration 8
float(0.5)
float(0.5)
float(4.5)
float(4.5)
float(0.5)
float(0.5)
float(0.5)
float(2.2)
float(4.5)

Deprecated: Passing null to argument of type float is deprecated in %s on line %d
float(NAN)
float(0.5)
float(NAN)

iteration 9

Deprecated: Passing null to argument of type float is deprecated in %s on line %d
float(0)

Deprecated: Passing null to argument of type float is deprecated in %s on line %d
float(0)

Deprecated: Passing null to argument of type float is deprecated in %s on line %d
float(0)

Deprecated: Passing null to argument of type float is deprecated in %s on line %d
float(0)

Deprecated: Passing null to argument of type float is deprecated in %s on line %d
float(0)

Deprecated: Passing null to argument of type float is deprecated in %s on line %d
float(0)

Deprecated: Passing null to argument of type float is deprecated in %s on line %d
float(0)

Deprecated: Passing null to argument of type float is deprecated in %s on line %d
float(0)

Deprecated: Passing null to argument of type float is deprecated in %s on line %d
float(0)

Deprecated: Passing null to argument of type float is deprecated in %s on line %d

Deprecated: Passing null to argument of type float is deprecated in %s on line %d
float(NAN)

Deprecated: Passing null to argument of type float is deprecated in %s on line %d
float(0)

Deprecated: Passing null to argument of type float is deprecated in %s on line %d
float(NAN)

iteration 10
float(1)
float(1)
float(1)
float(1)
float(1)
float(1)
float(1)
float(1)
float(1)

Deprecated: Passing null to argument of type float is deprecated in %s on line %d
float(NAN)
float(0)
float(NAN)

iteration 11
float(0)
float(0)
float(0)
float(0)
float(0)
float(0)
float(0)
float(0)
float(0)

Deprecated: Passing null to argument of type float is deprecated in %s on line %d
float(NAN)
float(0)
float(NAN)
