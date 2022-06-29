<?php

declare(strict_types = 1);

$root = dirname(__DIR__) . DIRECTORY_SEPARATOR;

define('APP_PATH', $root . 'app' . DIRECTORY_SEPARATOR);
define('FILES_PATH', $root . 'transaction_files' . DIRECTORY_SEPARATOR);
define('VIEWS_PATH', $root . 'views' . DIRECTORY_SEPARATOR);

include APP_PATH . "formatter.php";
/* YOUR CODE (Instructions in README.md) */
include APP_PATH . "app.php";

$transactions = getTransactions(FILES_PATH, 'extractTransaction');

include VIEWS_PATH . "transactions.php";
