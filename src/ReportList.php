<?php

declare(strict_types=1);
/*
 * All rights reserved © 2024 Legow Hosting Kft.
 */

namespace Aoc2024;

use Aoc2024\Report;

use function array_reduce;
use function array_map;
use function explode;
use function trim;

/**
 * Description of Report
 *
 * @author Turcsán Ádám <turcsan.adam@legow.hu>
 */
final class ReportList
{
    private array $reports = [];

    public function __construct(Report ... $reports) {
        $this->reports = $reports;
    }

    public static function fromFile(string $path): self
    {
        $file = fopen($path, 'r');
        $reportList = new static();
        while($reportLine = fgets($file)) {
            $reportList->reports[] = new Report(...array_map('intval', explode(' ', trim($reportLine))));
        }
        return $reportList;
    }

    public function countSafeReport(): int
    {
        return array_reduce($this->reports, fn(int $counter, Report $report) => $report->safe ? ++$counter : $counter, 0);
    }

    public function countDampenedSafeReport(): int
    {
        return array_reduce($this->reports, fn(int $counter, Report $report) => $report->dampenedSafe ? ++$counter : $counter, 0);
    }
}
