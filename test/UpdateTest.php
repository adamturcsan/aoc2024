<?php

declare(strict_types=1);
/*
 * All rights reserved © 2024 Legow Hosting Kft.
 */

namespace Aoc2024Test;

use Aoc2024\Update;
use PHPUnit\Framework\TestCase;

/**
 * Description of UpdateTest
 *
 * @author Turcsán Ádám <turcsan.adam@legow.hu>
 */
final class UpdateTest extends TestCase
{
    private const string TEST_DATA = <<<DATA
    47|53
    97|13
    97|61
    97|47
    75|29
    61|13
    75|53
    29|13
    97|29
    53|29
    61|53
    97|53
    61|29
    47|13
    75|47
    97|75
    47|61
    75|61
    47|29
    75|13
    53|13

    75,47,61,53,29
    97,61,53,29,13
    75,29,13
    75,97,47,61,53
    61,13,29
    97,13,75,29,47
    DATA;

    public function testUpdate(): void
    {
        // Arrange

        // Act
        $update = new Update(self::TEST_DATA);

        // Assert
        self::assertSame(21, $update->ruleCount);
        self::assertSame(6, $update->instructionCount);
    }

    public function testSumCalculation(): void
    {
        // Arrange

        // Act
        $update = new Update(self::TEST_DATA);

        // Assert
        self::assertSame(143, $update->validInstructionSum());
    }

    public function testReorderedSumCalculation(): void
    {
        // Arrange

        // Act
        $update = new Update(self::TEST_DATA);

        // Assert
        self::assertSame(123, $update->reorderedInstructionSum());
    }
    
}
