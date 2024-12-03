<?php

declare(strict_types=1);
/*
 * All rights reserved © 2024 Legow Hosting Kft.
 */

namespace Aoc2024Test;

use Aoc2024\Report;
use Aoc2024\ReportList;
use PHPUnit\Framework\TestCase;

/**
 * Description of ReportListTest
 *
 * @author Turcsán Ádám <turcsan.adam@legow.hu>
 */
final class ReportListTest extends TestCase
{
    public function testIsSafe(): void
    {
        // Arrange
        $path = __DIR__ . '/fixture/second_input.txt';
        $reportList = ReportList::fromFile($path);
        $expectedSafeReportCount = 7;

        // Act
        $safeReports = $reportList->countSafeReport();

        // Assert
        self::assertSame($expectedSafeReportCount, $safeReports);
    }

    public function testIsSafeDampened(): void
    {
        // Arrange
        $path = __DIR__ . '/fixture/second_input.txt';
        $reportList = ReportList::fromFile($path);
        $expectedSafeReportCount = 17;

        // Act
        $safeReports = $reportList->countDampenedSafeReport();

        // Assert
        self::assertSame($expectedSafeReportCount, $safeReports);
    }
}
