--TEST--
Bug #69534 (Cycle leaks through declared properties on internal classes)
--FILE--
<?php

class Node extends SplObjectStorage
{
    public $prop;
}
function fn737246126()
{
    $node1 = new Node();
    $node2 = new Node();
    $node1->prop = $node2;
    $node2->prop = $node1;
    unset($node1);
    unset($node2);
    var_dump(gc_collect_cycles());
}
fn737246126();
--EXPECT--
int(2)
