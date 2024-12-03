<?php

declare(strict_types=1);
/*
 * All rights reserved © 2024 Legow Hosting Kft.
 */

namespace Aoc2024Test;

use Aoc2024\ListComparator;
use Aoc2024\ListInput;
use PHPUnit\Framework\TestCase;

/**
 * Description of ListComparatorTest
 *
 * @author Turcsán Ádám <turcsan.adam@legow.hu>
 */
final class ListComparatorTest extends TestCase
{
    public function testDistanceCalculation(): void
    {
        // Arrange
        $comparator = new ListComparator();
        $listA = [3, 4, 2, 1, 3, 3];
        $listB = [4, 3, 5, 3, 9, 3];
        $expectedDistance = 11;

        // Act
        $distance = $comparator->calculateDistance(ListInput::fromArrays($listA, $listB));

        // Assert
        self::assertSame($expectedDistance, $distance);
    }

    public function testSimilarityScoreCalculation(): void
    {
        // Arrange
        $comparator = new ListComparator();
        $listA = [3, 4, 2, 1, 3, 3];
        $listB = [4, 3, 5, 3, 9, 3];
        $expectedSimilarityScore = 31;

        // Act
        $similarityScore = $comparator->calculateSimilarityScore(ListInput::fromArrays($listA, $listB));

        // Assert
        self::assertSame($expectedSimilarityScore, $similarityScore);
    }
}
