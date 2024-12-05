<?php

declare(strict_types=1);
/*
 * All rights reserved © 2024 Legow Hosting Kft.
 */

namespace Aoc2024;

use function array_key_last;
use function in_array;
use function strrev;
use function substr;
use function substr_count;


/**
 * Description of WordSearch
 *
 * @author Turcsán Ádám <turcsan.adam@legow.hu>
 */
final class WordSearch
{
    public function __construct(private WordSearchTable $table)
    {
        ;
    }

    public function countAllXmas(): int
    {
        return $this->countHorizontal()
            + $this->countVertical()
            + $this->countDiagonalForward()
            + $this->countDiagonalBackward();
    }

    private function countHorizontal(): int
    {
        $count = 0;
        foreach($this->table->lines as $line) {
            $count += substr_count($line, 'XMAS');
            $count += substr_count(strrev($line), 'XMAS');
        }
        return $count;
    }

    private function countVertical(): int
    {
        $count = 0;
        foreach($this->table->columns as $line) {
            $count += substr_count($line, 'XMAS');
            $count += substr_count(strrev($line), 'XMAS');
        }
        return $count;
    }

    private function countDiagonalForward(): int
    {
        $count = 0;
        foreach($this->table->diagonalsToRight as $line) {
            $count += substr_count($line, 'XMAS');
            $count += substr_count(strrev($line), 'XMAS');
        }
        return $count;
    }

    private function countDiagonalBackward(): int
    {
        $count = 0;
        foreach($this->table->diagonalsToLeft as $line) {
            $count += substr_count($line, 'XMAS');
            $count += substr_count(strrev($line), 'XMAS');
        }
        return $count;
    }

    public function countRight(): int
    {
        $count = 0;
        foreach($this->table->lines as $line) {
            $count += substr_count($line, 'XMAS');
        }
        return $count;
    }

    public function countLeft(): int
    {
        $count = 0;
        foreach($this->table->lines as $line) {
            $count += substr_count(strrev($line), 'XMAS');
        }
        return $count;
    }

    public function countDown(): int
    {
        $count = 0;
        foreach($this->table->columns as $line) {
            $count += substr_count($line, 'XMAS');
        }
        return $count;
    }

    public function countUp(): int
    {
        $count = 0;
        foreach($this->table->columns as $line) {
            $count += substr_count(strrev($line), 'XMAS');
        }
        return $count;
    }

    public function countDownRight(): int
    {
        $count = 0;
        foreach($this->table->diagonalsToRight as $line) {
            $count += substr_count($line, 'XMAS');
        }
        return $count;
    }

    public function countUpLeft(): int
    {
        $count = 0;
        foreach($this->table->diagonalsToRight as $line) {
            $count += substr_count(strrev($line), 'XMAS');
        }
        return $count;
    }

    public function countDownLeft(): int
    {
        $count = 0;
        foreach($this->table->diagonalsToLeft as $line) {
            $count += substr_count($line, 'XMAS');
        }
        return $count;
    }

    public function countUpRight(): int
    {
        $count = 0;
        foreach($this->table->diagonalsToLeft as $line) {
            $count += substr_count(strrev($line), 'XMAS');
        }
        return $count;
    }

    public function countXshapedMas(): int
    {
        $maxColumnKey = array_key_last($this->table->columns);
        $maxLineKey = array_key_last($this->table->lines);
        $counter = 0;
        foreach ($this->table->lines as $lineKey => $line) {
            if ($lineKey < 1 || $lineKey === $maxLineKey) {
                continue;
            }
            foreach(range(1, $maxColumnKey - 1) as $columnKey) {
                if (substr($line, $columnKey, 1) !== 'A') {
                    continue;
                }
                $counter += (int)$this->checkCorners($lineKey, $columnKey);
            }
        }
        return $counter;
    }

    private function checkCorners(int $line, int $column): bool
    {
        $cornersAroundTheClock =
             substr($this->table->lines[$line - 1], $column - 1, 1)
            .substr($this->table->lines[$line - 1], $column + 1, 1)
            .substr($this->table->lines[$line + 1], $column + 1, 1)
            .substr($this->table->lines[$line + 1], $column - 1, 1);
        return in_array($cornersAroundTheClock, [
            'MMSS', 'SMMS', 'SSMM', 'MSSM'
        ], true);
    }
}
