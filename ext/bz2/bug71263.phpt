--TEST--
Bug #71263: fread() does not detects decoding errors from filter bzip2.decompress
--FILE--
<?php

// Should the second fread() call return false?
// Should notices be generated?

function test($case) {
	$plain = "The quick brown fox jumps over the lazy dog.";
	$fn = "bug71263.bz2";
	$compressed = (string) bzcompress($plain);
	echo "Compressed len = ", strlen($compressed), "\n";
	
    if ($case == 1) {
        // Set a random byte in the middle of the compressed data
        // --> php_bz2_decompress_filter() detects fatal error
        // --> fread() displays empty string then garbage, no errors detected:
        $compressed[strlen($compressed) - 15] = 'X';
    } else if ($case == 2) {
        // Truncate the compressed data
        // --> php_bz2_decompress_filter() does not detect errors,
        // --> fread() displays the empty string:
    	$compressed = substr($compressed, 0, strlen($compressed) - 20);
    } else {
        // Corrupted final CRC
        // --> php_bz2_decompress_filter() detects fatal error
        // --> fread() displays an empty string, then the correct plain text, no error detected:
    	$compressed[strlen($compressed)-2] = 'X';
    }

	file_put_contents($fn, $compressed);
	
	$r = fopen($fn, "r");
	stream_filter_append($r, 'bzip2.decompress', STREAM_FILTER_READ);
    $s = fread($r, 100);
    echo "read: "; var_dump($s);
    echo "eof: ", feof($r), "\n";
    $s = fread($r, 100);
    echo "read: "; var_dump($s);
	fclose($r);
	unlink($fn);
}

test(1);
test(2);
test(3);
?>
--EXPECT--
Compressed len = 81
read: bool(false)
eof: 1
read: string(0) ""
Compressed len = 81
read: string(0) ""
eof: 1
read: string(0) ""
Compressed len = 81
read: bool(false)
eof: 1
read: string(0) ""
