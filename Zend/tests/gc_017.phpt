--TEST--
GC 017: GC and destructors with unset
--INI--
zend.enable_gc=1
--FILE--
<?php

class Node
{
    public $name;
    public $children;
    public $parent;
    function __construct($name)
    {
        $this->name = $name;
        $this->parent = null;
    }
    function insert($node)
    {
        $node->parent = $this;
        $this->children[] = $node;
    }
    function __destruct()
    {
        var_dump($this->name);
        unset($this->name);
        unset($this->children);
        unset($this->parent);
    }
}
function fn190822558()
{
    $a = new Node('A');
    $b = new Node('B');
    $c = new Node('C');
    $a->insert($b);
    $a->insert($c);
    unset($a);
    unset($b);
    unset($c);
    var_dump(gc_collect_cycles() >= 7);
    echo "ok\n";
}
fn190822558();
--EXPECTF--
string(1) "%s"
string(1) "%s"
string(1) "%s"
bool(true)
ok
