--TEST--
Star width and precision in sprintf()
--FILE--
<?php


$f = 1.23456789012345678;
var_dump($f);

printf("%.*f\n", 10, $f);
printf("%.*G\n", 10, $f);
printf("%.*G\n", -1, $f);
printf("%.*s\n", 3, "foobar");
echo "\n";

printf("%*f\n", 10, $f);
printf("%*G\n", 10, $f);
printf("%*s\n", 10, "foobar");
echo "\n";

printf("%*.*f\n", 10, 3, $f);
printf("%*.*G\n", 10, 3, $f);
printf("%*.*s\n", 10, 3, "foobar");
echo "\n";

printf("%1$.*2\$f\n", $f, 10);
printf("%.*2\$f\n", $f, 10);
printf("%2$.*f\n", 10, $f);
printf("%1$*2\$f\n", $f, 10);
printf("%*2\$f\n", $f, 10);
printf("%2$*f\n", 10, $f);
printf("%1$*2$.*3\$f\n", $f, 10, 3);
printf("%*2$.*3\$f\n", $f, 10, 3);
printf("%3$*.*f\n", 10, 3, $f);
echo "\n";

try {
    printf("%.*G\n", "foo", 1.5);
} catch (ValueError $e) {
    echo $e->getMessage(), "\n";
}

try {
    printf("%.*G\n", -100, 1.5);
} catch (ValueError $e) {
    echo $e->getMessage(), "\n";
}

try {
    printf("%.*s\n", -1, "Foo");
} catch (ValueError $e) {
    echo $e->getMessage(), "\n";
}

try {
    printf("%*G\n", -1, $f);
} catch (ValueError $e) {
    echo $e->getMessage(), "\n";
}

?>
--EXPECTF--
float(1.2345678901234567)
1.2345678901
1.23456789
1.2345678901234567
foo

  1.234568
   1.23457
    foobar

     1.235
      1.23
       foo

1.2345678901
1.2345678901
1.2345678901
  1.234568
  1.234568
  1.234568
     1.235
     1.235
     1.235

Precision must be an integer
Precision must be between -1 and 2147483647
Precision -1 is only supported for %g and %G
Width must be greater than zero and less than 2147483647
