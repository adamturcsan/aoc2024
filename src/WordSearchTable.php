<?php

declare(strict_types=1);
/*
 * All rights reserved © 2024 Legow Hosting Kft.
 */

namespace Aoc2024;

/**
 * Description of WordSearchTable
 *
 * @author Turcsán Ádám <turcsan.adam@legow.hu>
 */
final class WordSearchTable
{
    private ?array $_lines = null;
    public array $lines {
        get => $this->_lines ??= explode("\n", $this->rawTable);
    }

    private ?array $_columns = null;
    public array $columns {
        get => $this->_columns ??= $this->invertAndExplode();
    }

    private ?array $_diagonalsToRight = null;
    public array $diagonalsToRight {
        get => $this->_diagonalsToRight ??= $this->diagonalsToRight();
    }

    private ?array $_diagonalsToLeft = null;
    public array $diagonalsToLeft {
        get => $this->_diagonalsToLeft ??= $this->diagonalsToLeft();
    }

    public function __construct(public readonly string $rawTable)
    {
        ;
    }

    public static function fromFile(string $path): self
    {
        return new WordSearchTable(file_get_contents($path));
    }

    private function invertAndExplode(): array
    {
        $arraySplitLines = array_map(fn(string $line) => str_split($line), $this->lines);
        $lastIndexOfALine = array_key_last($arraySplitLines[0]);
        $invertedMatrix = [];
        foreach(range(0, $lastIndexOfALine) as $index) {
            $invertedMatrix[] = implode(array_column($arraySplitLines, $index));
        }
        return $invertedMatrix;
    }


    private function diagonalsToRight(): array
    {
        $diagonals = [];
        $lastStartColumnKey = array_key_last($this->columns);
        foreach(range($lastStartColumnKey, 0) as $startColumnKey) { // From which column we start
            $diagonal = '';
            foreach(range(0, $lastStartColumnKey - $startColumnKey) as $lineKey) { // From which line we get
                $diagonal .= substr($this->lines[$lineKey], $startColumnKey + $lineKey, 1);
            }
            $diagonals[] = $diagonal;
        }
        $lastStartLineKey = array_key_last($this->lines);
        foreach(range($lastStartLineKey, 1) as $startLineKey) { // From which line we start, the 0 is covered above
            $diagonal = '';
            foreach(range(0, $lastStartLineKey - $startLineKey) as $columnKey) { // From which line we get
                $diagonal .= substr($this->lines[$startLineKey + $columnKey], $columnKey, 1);
            }
            $diagonals[] = $diagonal;
        }
        return $diagonals;
    }


    private function diagonalsToLeft(): array
    {
        $diagonals = [];
        $lastStartColumnKey = array_key_last($this->columns);
        foreach(range(0, $lastStartColumnKey) as $startColumnKey) { // From which column we start
            $diagonal = '';
            foreach(range(0, $startColumnKey) as $lineKey) { // From which line we get
                $diagonal .= substr($this->lines[$lineKey], $startColumnKey - $lineKey, 1);
            }
            $diagonals[] = $diagonal;
        }
        $lastStartLineKey = array_key_last($this->lines);
        foreach(range(1, $lastStartLineKey) as $startLineKey) { // From which line we start, the 0 is covered above
            $diagonal = '';
            foreach(range($lastStartColumnKey, $startLineKey) as $columnKey) { // From which line we get
                $lineKey = $startLineKey + ($lastStartColumnKey - $columnKey);
                $diagonal .= substr($this->lines[$lineKey], $columnKey, 1);
            }
            $diagonals[] = $diagonal;
        }
        return $diagonals;
    }
}
