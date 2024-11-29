<?php

use CodeIgniter\Test\TestLogger;
use Config\Logger;

if (php_sapi_name() !== 'cli') {
	echo "This script may only be run from the command line.", PHP_EOL;
	exit(1);
}

set_time_limit(0);

require_once __DIR__ . '/system/Test/TestLogger.php';
require_once __DIR__ . '/system/Log/Logger.php';

const _LOGGER = new TestLogger(new Logger());

$delay = 5 * 60;

echo "Starting cron job...\n";

while (true) {
	sleep($delay);
	echo "Performing cron job on ", date("d-m-Y H:i:s"), PHP_EOL;
	$out = shell_exec("php ".realpath(__DIR__."/public/index.php")." cron $delay");
	if (is_string($out) && strlen($out) > 0) {
		_LOGGER->log('notice', $out);
	}
}
