--TEST--
CURL file uploading
--INI--
--SKIPIF--
<?php include 'skipif.inc'; ?>
--FILE--
<?php

function testcurl($ch, $name, $mime = '', $postname = '')
{
	if(!empty($postname)) {
		$file = new CurlFile($name, $mime, $postname);
	} else if(!empty($mime)) {
		$file = new CurlFile($name, $mime);
	} else {
		$file = new CurlFile($name);
	}
	curl_setopt($ch, CURLOPT_POSTFIELDS, array("file" => $file));
	var_dump(curl_exec($ch));
}

include 'server.inc';
$host = curl_cli_server_start();
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, "{$host}/get.php?test=file");
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);

testcurl($ch, __DIR__ . '/curl_testdata1.txt');
testcurl($ch, __DIR__ . '/curl_testdata1.txt', 'text/plain');
testcurl($ch, __DIR__ . '/curl_testdata1.txt', '', 'foo.txt');
testcurl($ch, __DIR__ . '/curl_testdata1.txt', 'text/plain', 'foo.txt');

$file = new CurlFile(__DIR__ . '/curl_testdata1.txt');
$file->setMimeType('text/plain');
var_dump($file->getMimeType());
var_dump($file->getFilename());
curl_setopt($ch, CURLOPT_POSTFIELDS, array("file" => $file));
var_dump(curl_exec($ch));

$file = curl_file_create(__DIR__ . '/curl_testdata1.txt');
$file->setPostFilename('foo.txt');
var_dump($file->getPostFilename());
curl_setopt($ch, CURLOPT_POSTFIELDS, array("file" => $file));
var_dump(curl_exec($ch));

$params = array('file' => '@' . __DIR__ . '/curl_testdata1.txt');
curl_setopt($ch, CURLOPT_POSTFIELDS, $params);
var_dump(curl_exec($ch));

curl_setopt($ch, CURLOPT_URL, "{$host}/get.php?test=post");
$params = array('file' => '@' . __DIR__ . '/curl_testdata1.txt');
curl_setopt($ch, CURLOPT_POSTFIELDS, $params);
var_dump(curl_exec($ch));

curl_close($ch);
?>
--EXPECTF--
string(%d) "curl_testdata1.txt|application/octet-stream"
string(%d) "curl_testdata1.txt|text/plain"
string(%d) "foo.txt|application/octet-stream"
string(%d) "foo.txt|text/plain"
string(%d) "text/plain"
string(%d) "%s/curl_testdata1.txt"
string(%d) "curl_testdata1.txt|text/plain"
string(%d) "foo.txt"
string(%d) "foo.txt|application/octet-stream"
string(0) ""
string(%d) "array(1) {
  ["file"]=>
  string(%d) "@%s/curl_testdata1.txt"
}
"
