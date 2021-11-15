<?php

use Palicao\PhpRebloom\CountMinSketch;
use Palicao\PhpRebloom\RedisClient;
use Palicao\PhpRebloom\RedisConnectionParams;

require __DIR__ . '/vendor/autoload.php';

$countMinSketch = new CountMinSketch(
	new RedisClient(
		new Redis(),
		new RedisConnectionParams('127.0.0.1', 6379)
	)
);

$candidates = [
	'password1234' => 24695, // pwned
	'troyhuntsucks' => 0, // not pwned
	'hunter1' => 149080, // pwned
	'scotthelmerules' => 0, // not pwned
	'chucknorris' => 3501, // pwned
];

foreach ($candidates as $candidate => $actualCount) {
	$start = microtime(true);
	$pair = $countMinSketch->query('pwned-sketch', strtoupper(sha1($candidate)));
	$end = microtime(true);
	echo $pair[0]->getItem() . ' estimate:' . $pair[0]->getValue() . ' vs. actual:' . $actualCount . ' in ' . ($end - $start) . "ms.\n";
}