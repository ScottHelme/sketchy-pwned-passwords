<?php

use Palicao\PhpRebloom\CountMinSketch;
use Palicao\PhpRebloom\Pair;
use Palicao\PhpRebloom\RedisClient;
use Palicao\PhpRebloom\RedisConnectionParams;

require __DIR__ . '/vendor/autoload.php';

$countMinSketch = new CountMinSketch(
	new RedisClient(
		new Redis(),
		new RedisConnectionParams('127.0.0.1', 6379)
	)
);

$count = 0;
foreach (importData($argv[1]) as $data) {
	$countMinSketch->incrementBy('pwned-sketch', new Pair($data[0], (int)$data[1]));
	$count++;
	echo $data[0] . ':' . $data[1] . ' ' . $count . "\n";
}

function importData($file): Generator {
	$fh = fopen($file, 'r');

	while(!feof($fh)) {
		yield explode(':', trim(fgets($fh)));
	}

	fclose($fh);
}