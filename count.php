<?php

$total = 0;
$count = 0;

foreach (importData() as $data) {
	$count++;
	$total += (int)$data[1];
	echo $data[0] . ':' . $data[1] . ' count:' . $count . ' total:' . $total . "\n";
}

function importData(): Generator {
	$fh = fopen('input.txt', 'r');

	while(!feof($fh)) {
		yield explode(':', trim(fgets($fh)));
	}

	fclose($fh);
}