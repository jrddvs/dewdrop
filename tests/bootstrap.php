<?php

require_once __DIR__ . '/../vendor/autoload.php';

$paths = new \Dewdrop\Paths();
require_once $paths->getRoot() . '/wp-config.php';
require_once $paths->getRoot() . '/wp-includes/wp-db.php';
