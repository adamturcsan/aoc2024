<?php

declare(strict_types=1);
/*
 * All rights reserved © 2024 Legow Hosting Kft.
 */

namespace Aoc2024;

use function array_merge;
use function array_pop;
use function array_shift;
use function preg_match;
use function var_dump;


/**
 * Description of MemoryCleaner
 *
 * @author Turcsán Ádám <turcsan.adam@legow.hu>
 */
final class MemoryCleaner
{
    public function __construct(private Memory $memory)
    {
    }

    public function getCleanedUpResult(): int
    {
        return $this->parseConditionsAndGiveResult($this->memory->memoryContent);
    }

    public function getConditionalCleanedUpResult(): int
    {
        $enabledMemoryChunks = $this->sliceUp($this->memory->memoryContent);
        $sum = 0;
        foreach ($enabledMemoryChunks as $chunk) {
            $sum += $this->parseConditionsAndGiveResult($chunk);
        }
        return $sum;
    }

    private function parseConditionsAndGiveResult(string $memoryChunk): int
    {
        $matches = null;
        if (preg_match_all('/mul\(\d{1,3},\d{1,3}\)/', $memoryChunk, $matches)) {
            return $this->sumOfProducts($matches[0]);
        }
        return 0;
    }

    private function sumOfProducts(array $multiplicationCommands): int
    {
        $sum = 0;
        foreach($multiplicationCommands as $command) {
            [$left, $right] = explode(',', substr(substr($command, 4), 0, -1));
            $sum += (int)$left * (int)$right;
        }
        return $sum;
    }

    private function sliceUp(string $content): array
    {
        $enabledMemoryChunks = [];
        $explodedByDoNot = explode("don't()", $content);
        $enabledMemoryChunks[] = array_shift($explodedByDoNot);
        foreach ($explodedByDoNot as $disabledChunks) {
            $explodedByDo = explode('do()', $disabledChunks);
            array_shift($explodedByDo); // Discard the first, as it is disabled
            $enabledMemoryChunks = array_merge($enabledMemoryChunks, $explodedByDo);
        }
        return $enabledMemoryChunks;
    }
}
