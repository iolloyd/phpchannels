<?php
require_once __DIR__.'/vendor/autoload.php';

use Channel\Channel;
use Channel\Routine;

function someFunction($ch, $x) {
    $ch->write($x);
}

$routine = new Routine;

$ch1 = new Channel;
$ch2 = new Channel;

$routine->go('someFunction', $ch1, 12345);

$routine->go(function($x) use ($ch1) { 
    $ch1->write(printf("%s", $x));
}, 67890);

$routine->go(function() use ($ch1, $ch2) {
    list($a, $b) = [$ch1->read(), $ch1->read()];

    $ch2->write($a);
    $ch2->write($b);
});

echo $ch2->read();
