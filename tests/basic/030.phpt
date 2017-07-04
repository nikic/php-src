--TEST--
Bug#55504 (Content-Type header is not parsed correctly on HTTP POST request)
--INI--
file_uploads=1
--POST_RAW--
Content-Type: multipart/form-data; boundary=BVoyv; charset=iso-8859-1
--BVoyv
Content-Disposition: form-data; name="data"

abc
--BVoyv--
--FILE--
<?php

function fn787022170()
{
    var_dump($_POST);
}
fn787022170();
--EXPECT--
array(1) {
  ["data"]=>
  string(3) "abc"
}
