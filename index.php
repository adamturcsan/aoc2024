<?php

require_once './vendor/autoload.php';

/* 
 * All rights reserved © 2024 Legow Hosting Kft.
 */

echo '======' . PHP_EOL;
echo 'DAY  1' . PHP_EOL;
echo '======' . PHP_EOL;

$listComparator = new Aoc2024\ListComparator();

$listInput = Aoc2024\ListInput::fromFile(__DIR__ . '/input/day1');

echo $listComparator->calculateDistance($listInput) . PHP_EOL;
echo $listComparator->calculateSimilarityScore($listInput) . PHP_EOL;

var_dump(memory_get_usage() / 1024, memory_get_peak_usage() / 1024);

echo '======' . PHP_EOL;
echo 'DAY  2' . PHP_EOL;
echo '======' . PHP_EOL;

$time = microtime(true);
$reportList = Aoc2024\ReportList::fromFile(__DIR__ . '/input/day2');
echo $reportList->countSafeReport() . PHP_EOL;
echo $reportList->countDampenedSafeReport() . PHP_EOL;
echo microtime(true) - $time . PHP_EOL;

var_dump(memory_get_usage() / 1024, memory_get_peak_usage() / 1024);

echo '======' . PHP_EOL;
echo 'DAY  3' . PHP_EOL;
echo '======' . PHP_EOL;


$time = microtime(true);
$memoryCleaner = new Aoc2024\MemoryCleaner(Aoc2024\Memory::fromFile(__DIR__ . '/input/day3'));
echo $memoryCleaner->getCleanedUpResult() . PHP_EOL;
echo $memoryCleaner->getConditionalCleanedUpResult() . PHP_EOL;
echo microtime(true) - $time . PHP_EOL;

var_dump(memory_get_usage() / 1024, memory_get_peak_usage() / 1024);

echo '======' . PHP_EOL;
echo 'DAY  4' . PHP_EOL;
echo '======' . PHP_EOL;

$time = microtime(true);
$wordSearch = new Aoc2024\WordSearch(Aoc2024\WordSearchTable::fromFile(__DIR__ . '/input/day4'));
echo $wordSearch->countAllXmas() . PHP_EOL;
echo $wordSearch->countXshapedMas() . PHP_EOL;
echo microtime(true) - $time . PHP_EOL;

var_dump(memory_get_usage() / 1024, memory_get_peak_usage() / 1024);

echo '======' . PHP_EOL;
echo 'DAY  5' . PHP_EOL;
echo '======' . PHP_EOL;

$time = microtime(true);
$update = new Aoc2024\Update(file_get_contents(__DIR__ . '/input/day5'));
echo $update->validInstructionSum() . PHP_EOL;
echo $update->reorderedInstructionSum() . PHP_EOL;
echo microtime(true) - $time . PHP_EOL;


echo '======' . PHP_EOL;
echo 'DAY  9' . PHP_EOL;
echo '======' . PHP_EOL;

$time = microtime(true);
$disk = Aoc2024\Disk::fromRawFile(__DIR__ . '/input/day9');
echo 'answer:' . $disk->rearrange()->split()->checksum() . PHP_EOL;
echo 'answer:' . $disk->rearrangeWholeFiles()->split()->checksum() . PHP_EOL;
echo microtime(true) - $time . PHP_EOL;

var_dump(memory_get_usage() / 1024, memory_get_peak_usage() / 1024);
