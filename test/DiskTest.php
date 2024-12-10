<?php

declare(strict_types=1);
/*
 * All rights reserved © 2024 Legow Hosting Kft.
 */

namespace Aoc2024Test;

use Aoc2024\Disk;
use PHPUnit\Framework\TestCase;

/**
 * Description of DiskTest
 *
 * @author Turcsán Ádám <turcsan.adam@legow.hu>
 */
final class DiskTest extends TestCase
{
    public function testDiskCreation(): void
    {
        // Arrange

        // Act
        $disk = Disk::fromRawContent('2333133121414131402');

        // Assert
        self::assertCount(10, $disk->blocks);
    }

    public function testDiskExplode(): void
    {
        // Arrange

        // Act
        $disk = Disk::fromRawContent('2333133121414131402');

        // Assert
        self::assertSame('00...111...2...333.44.5555.6666.777.888899', $disk->explode());
    }

    public function testDiskRearrange(): void
    {
        // Arrange

        // Act
        $disk = Disk::fromRawContent('2333133121414131402');

        // Assert
        self::assertSame('0099811188827773336446555566....', $disk->rearrange()->explode());
    }

    public function testDiskRearrangedChecksum(): void
    {
        // Arrange

        // Act
        $disk = Disk::fromRawContent('2333133121414131402');

        // Assert
        self::assertSame(1928, $disk->rearrange()->split()->checksum());
    }

    public function testDiskRearrangedWholeFilesChecksum(): void
    {
        // Arrange

        // Act
        $disk = Disk::fromRawContent('2333133121414131402');

        // Assert
        self::assertSame(2858, $disk->rearrangeWholeFiles()->split()->checksum());
    }
}
