<?php

use DanielSkiepko\Rss\NationalGeographic;

require_once (__DIR__."/../vendor/autoload.php");

if (! empty($argv[3])) {
    $csv_type = $argv[1];
    $link = $argv[2];
    $path = $argv[3];
    $rss = new NationalGeographic();

    $rss->saveCsv($csv_type, $link, $path);
} else {
    die('Komenda powinna zawierać 3 argumenty!');
}