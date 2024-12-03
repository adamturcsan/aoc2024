<?php

declare(strict_types=1);
/*
 * All rights reserved © 2024 Legow Hosting Kft.
 */

namespace Aoc2024Test;

use Aoc2024\ListInput;
use PHPUnit\Framework\TestCase;

/**
 * Description of ListInputTest
 *
 * @author Turcsán Ádám <turcsan.adam@legow.hu>
 */
final class ListInputTest extends TestCase
{
    public function testListInput(): void
    {
        // Arrange
        $path = __DIR__ . '/fixture/first_input.txt';
        $left = [3, 4, 2, 1, 3, 3];
        $right = [4, 3, 5, 3, 9, 3];

        // Act
        $input = ListInput::fromFile($path);

        // Assert
        self::assertSame($left, $input->left);
        self::assertSame($right, $input->right);
    }
}
