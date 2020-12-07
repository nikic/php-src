--TEST--
Bug #65481 (shutdown segfault due to serialize)
--FILE--
<?php
echo "Test\n";

class A {
    public $e = array();
}

class Token implements \Serializable {
    public function serialize()
    {
        $c = new A;

        for ($i = 0; $i < 4; $i++)
        {
            $e = new A;
            $c->e[] = $e;
            $e->e = $c->e;
        }

        return serialize(array(serialize($c)));
    }

    public function unserialize($str)
    {
        $r = unserialize($str);
        $r = unserialize($r[0]);
    }
}

$token = new Token;
$token = serialize($token);

?>
Done
--EXPECTF--
Test

Deprecated: The Serializable interface is deprecated. If you need to retain the Serializable interface for cross-version compatibility, you can suppress this warning by implementing __serialize() and __unserialize() in addition, which will take precedence over Serializable in PHP versions that support them in %s on line %d
Done
