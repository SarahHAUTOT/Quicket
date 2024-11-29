<?php

if (php_sapi_name() !== 'cli') {
	echo "This script may only be run from the command line.", PHP_EOL;
	exit(1);
}

set_time_limit(0);

$delay = 5 * 60;

echo "Starting cron job...\n";

while (true) {
	sleep($delay);
	echo "Performing cron job on ", date("d-m-Y H:i:s"), PHP_EOL;
	$out = shell_exec("php ".realpath(__DIR__."/public/index.php")." cron $delay");
	if (is_string($out) && strlen($out) > 0) {
		file_put_contents(__DIR__."/writable/logs/cronjob.log",
			date("d-m-Y H:i:s").PHP_EOL.
			str_repeat("-", 15).PHP_EOL.
			$out.PHP_EOL.PHP_EOL, FILE_APPEND);
	}
}
