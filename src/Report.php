<?php

declare(strict_types=1);
/*
 * All rights reserved © 2024 Legow Hosting Kft.
 */

namespace Aoc2024;

use function abs;
use function array_all;
use function array_key_last;
use function array_map;
use function array_slice;
use function array_splice;
use function range;

/**
 * Description of Report
 *
 * @author Turcsán Ádám <turcsan.adam@legow.hu>
 */
final class Report
{
    private array $levels;

    private ?bool $isSafe = null;
    public bool $safe {
        get {
            $this->isSafe ??= $this->isSafe(null, $this->levels);
            return $this->isSafe;
        }
    }

    private ?bool $isDampenedSafe = null;
    public bool $dampenedSafe {
        get {
            $this->isDampenedSafe ??= $this->isDampenedSafe();
            return $this->isDampenedSafe;
        }
    }

    public function __construct(int ... $levels)
    {
        $this->levels = $levels;
    }

    /**
     * $param array<int> $levels
     */
    private function isSafe(?int $removedKey, array $levels): bool
    {
        if ($removedKey !== null) {
            array_splice($levels, $removedKey, 1);
        }

        $levelsStart = array_slice($levels, 0, -1);
        $levelsShifted = array_slice($levels, 1);
        $diffs = array_map(fn(int $a, int $b): int => $a - $b, $levelsStart, $levelsShifted);
        $isNegative = $diffs[0] < 0;

        return array_all($diffs, fn(int $diff) => $diff !== 0 && abs($diff) < 4 && ($diff < 0 === $isNegative));
    }

    private function isDampenedSafe(): bool
    {
        if($this->safe) {
            return true;
        }
        foreach(range(0, array_key_last($this->levels)) as $removedKey) {
            if($this->isSafe($removedKey, $this->levels)) {
                return true;
            }
        }
        return false;
    }
}
