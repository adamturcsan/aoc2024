<?php

declare(strict_types=1);
/*
 * All rights reserved © 2024 Legow Hosting Kft.
 */

namespace Aoc2024Test;

use Aoc2024\PrintOrder;
use Aoc2024\RuleSet;
use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\TestCase;

/**
 * Description of PrintRuleTest
 *
 * @author Turcsán Ádám <turcsan.adam@legow.hu>
 */
final class RuleSetTest extends TestCase
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
    DATA;

    public function testRulesCreation(): void
    {
        // Arrange

        // Act
        $ruleSet = new RuleSet(self::TEST_DATA);

        // Assert
        self::assertSame(21, $ruleSet->count);
    }

    #[DataProvider('providePrintOrder')]
    public function testIsAllowed(PrintOrder $printOrder, bool $expectedAllow): void
    {
        // Arrange
        $ruleSet = new RuleSet(self::TEST_DATA);

        // Act
        $isAllowed = $ruleSet->isAllowed($printOrder);

        // Assert
        self::assertSame($expectedAllow, $isAllowed);
    }

    public static function providePrintOrder(): iterable
    {
        yield [
            'printOrder' => new PrintOrder(75,47,61,53,29),
            'expectedAllow' => true,
        ];
        yield [
            'printOrder' => new PrintOrder(97,61,53,29,13),
            'expectedAllow' => true,
        ];
        yield [
            'printOrder' => new PrintOrder(75,29,13),
            'expectedAllow' => true,
        ];
        yield [
            'printOrder' => new PrintOrder(75,97,47,61,53),
            'expectedAllow' => false,
        ];
        yield [
            'printOrder' => new PrintOrder(61,13,29),
            'expectedAllow' => false,
        ];
        yield [
            'printOrder' => new PrintOrder(97,13,75,29,47),
            'expectedAllow' => false,
        ];
    }
}
