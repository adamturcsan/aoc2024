<?php

declare(strict_types=1);
/*
 * All rights reserved © 2024 Legow Hosting Kft.
 */

namespace Aoc2024Test;

use Aoc2024\WordSearch;
use Aoc2024\WordSearchTable;
use PHPUnit\Framework\TestCase;

/**
 * Description of WordSearchTest
 *
 * @author Turcsán Ádám <turcsan.adam@legow.hu>
 */
final class WordSearchTest extends TestCase
{
    private const string TEST_TABLE = <<<TABLE
    MMMSXXMASM
    MSAMXMSMSA
    AMXSXMAAMM
    MSAMASMSMX
    XMASAMXAMM
    XXAMMXXAMA
    SMSMSASXSS
    SAXAMASAAA
    MAMMMXMMMM
    MXMXAXMASX
    TABLE;

    public function testCountRight(): void
    {
        // Arrange
        $wordSearch = new WordSearch(new WordSearchTable(self::TEST_TABLE));

        // Act
        $count = $wordSearch->countRight();

        // Assert
        self::assertSame(3, $count);
    }

    public function testCountLeft(): void
    {
        // Arrange
        $wordSearch = new WordSearch(new WordSearchTable(self::TEST_TABLE));

        // Act
        $count = $wordSearch->countLeft();

        // Assert
        self::assertSame(2, $count);
    }

    public function testCountDown(): void
    {
        // Arrange
        $wordSearch = new WordSearch(new WordSearchTable(self::TEST_TABLE));

        // Act
        $count = $wordSearch->countLeft();

        // Assert
        self::assertSame(2, $count);
    }

    public function testCountUp(): void
    {
        // Arrange
        $wordSearch = new WordSearch(new WordSearchTable(self::TEST_TABLE));

        // Act
        $count = $wordSearch->countLeft();

        // Assert
        self::assertSame(2, $count);
    }

    public function testCountDownRight(): void
    {
        // Arrange
        $wordSearch = new WordSearch(new WordSearchTable(self::TEST_TABLE));

        // Act
        $count = $wordSearch->countDownRight();

        // Assert
        self::assertSame(1, $count);
    }

    public function testCountUpLeft(): void
    {
        // Arrange
        $wordSearch = new WordSearch(new WordSearchTable(self::TEST_TABLE));

        // Act
        $count = $wordSearch->countUpLeft();

        // Assert
        self::assertSame(4, $count);
    }

    public function testCountDownLeft(): void
    {
        // Arrange
        $wordSearch = new WordSearch(new WordSearchTable(self::TEST_TABLE));

        // Act
        $count = $wordSearch->countDownLeft();

        // Assert
        self::assertSame(1, $count);
    }

    public function testCountAll(): void
    {
        // Arrange
        $wordSearch = new WordSearch(new WordSearchTable(self::TEST_TABLE));

        // Act
        $count = $wordSearch->countAllXmas();

        // Assert
        self::assertSame(18, $count);
    }

    public function testCountXshapedMas(): void
    {
        // Arrange
        $wordSearch = new WordSearch(new WordSearchTable(self::TEST_TABLE));

        // Act
        $count = $wordSearch->countXshapedMas();

        // Assert
        self::assertSame(9, $count);
    }
}
