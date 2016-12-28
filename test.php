<?php
require 'vendor/autoload.php';

use Channel\Channel;
use Channel\Routine;

function someFunction($ch, $x) {
    $ch->write($x);
}

$routine = new Routine;
$ch1 = new Channel;
$ch2 = new Channel;

$routine->go('someFunc', $ch, 12345);

$routine->go(function($x) use ($ch1) { 
    $ch1->write($a); 
}, 100000);

$routine->go(function() use ($ch1, $ch2) {
    list($a, $b) = [$ch->read(), $ch->read()];
    $result = $a + $b;

    $ch2->write($result);
});

echo $ch2->read();
