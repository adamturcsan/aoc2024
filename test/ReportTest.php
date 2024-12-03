<?php

declare(strict_types=1);
/*
 * All rights reserved © 2024 Legow Hosting Kft.
 */

namespace Aoc2024Test;

use Aoc2024\Report;
use PHPUnit\Framework\TestCase;

/**
 * Description of ReportTest
 *
 * @author Turcsán Ádám <turcsan.adam@legow.hu>
 */
final class ReportTest extends TestCase
{

    public function testIsSafeDampenedReverseDir(): void
    {
        // Arrange
        $report = new Report(47, 57, 54, 51, 48);

        // Act

        // Assert
        self::assertSame(false, $report->safe);
        self::assertSame(true, $report->dampenedSafe);
    }
}
