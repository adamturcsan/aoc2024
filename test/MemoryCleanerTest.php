<?php

declare(strict_types=1);
/*
 * All rights reserved © 2024 Legow Hosting Kft.
 */

namespace Aoc2024Test;

use PHPUnit\Framework\TestCase;
use Aoc2024\Memory;
use Aoc2024\MemoryCleaner;

/**
 * Description of MemoryCleanerTest
 *
 * @author Turcsán Ádám <turcsan.adam@legow.hu>
 */
final class MemoryCleanerTest extends TestCase
{
    public function testCleanUp(): void
    {
        // Arrange
        $memory = new Memory('xmul(2,4)%&mul[3,7]!@^do_not_mul(5,5)+mul(32,64]then(mul(11,8)mul(8,5))');
        $cleaner = new MemoryCleaner($memory);
        $expectedResult = 161;

        // Act
        $result = $cleaner->getCleanedUpResult();

        // Assert
        self::assertSame($expectedResult, $result);
    }

    public function testConditionalCleanUp(): void
    {
        // Arrange
        $memory = new Memory("xmul(2,4)&mul[3,7]!^don't()_mul(5,5)+mul(32,64](mul(11,8)undo()?mul(8,5))");
        $cleaner = new MemoryCleaner($memory);
        $expectedResult = 48;

        // Act
        $result = $cleaner->getConditionalCleanedUpResult();

        // Assert
        self::assertSame($expectedResult, $result);
    }
}
