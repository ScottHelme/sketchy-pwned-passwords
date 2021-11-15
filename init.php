<?php

use Palicao\PhpRebloom\CountMinSketch;
use Palicao\PhpRebloom\Pair;
use Palicao\PhpRebloom\RedisClient;
use Palicao\PhpRebloom\RedisConnectionParams;

require __DIR__ . '/vendor/autoload.php';

$w = 2000000;
$d = 302;

$countMinSketch = new CountMinSketch(
	new RedisClient(
		new Redis(),
		new RedisConnectionParams('127.0.0.1', 6379)
	)
);

$start = microtime(true);
$before = memory_get_usage();
$countMinSketch->initByDimensions('pwned-sketch', $w, $d);
$after = memory_get_usage();
echo ($after - $before) . "\n";
$end = microtime(true);
echo 'Execution time: ' . ($end - $start) / 60 . 'm';
