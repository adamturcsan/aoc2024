<?php

require_once './vendor/autoload.php';

/* 
 * All rights reserved © 2024 Legow Hosting Kft.
 */

$listComparator = new Aoc2024\ListComparator();

$listInput = Aoc2024\ListInput::fromFile(__DIR__ . '/input/day1');

echo $listComparator->calculateDistance($listInput) . PHP_EOL;
echo $listComparator->calculateSimilarityScore($listInput) . PHP_EOL;

var_dump(memory_get_usage() / 1024, memory_get_peak_usage() / 1024);

$time = microtime(true);
$reportList = Aoc2024\ReportList::fromFile(__DIR__ . '/input/day2');
echo $reportList->countSafeReport() . PHP_EOL;
echo $reportList->countDampenedSafeReport() . PHP_EOL;
echo microtime(true) - $time . PHP_EOL;

var_dump(memory_get_usage() / 1024, memory_get_peak_usage() / 1024);
