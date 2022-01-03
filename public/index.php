<?php

try {
	include __DIR__ . '/../classes/EntryPoint.php';
	include __DIR__ . '/../classes/SiteRoutes.php';

	
	$route = ltrim(strtok($_SERVER['REQUEST_URI'], '?'), '/');

	$entryPoint = new EntryPoint($route, new SiteRoutes());
	$entryPoint->run();
}

catch (PDOException $e) {
	$title = 'An error has occurred';

	$output = 'Database error: ' . $e->getMessage() . ' in ' .
	$e->getFile() . ':' . $e->getLine();
}

