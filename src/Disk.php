<?php

declare(strict_types=1);
/*
 * All rights reserved © 2024 Legow Hosting Kft.
 */

namespace Aoc2024;

use PhpParser\Node\Expr\BinaryOp\Spaceship;
use function array_fill;
use function array_key_last;

use function array_pop;
use function array_reverse;


use function array_shift;
use function array_slice;

use function fgets;

use function fopen;


use function str_split;
use function var_dump;


/**
 * Description of Disk
 *
 * @author Turcsán Ádám <turcsan.adam@legow.hu>
 */
final class Disk
{
    public function __construct(public readonly array $blocks)
    {
    }

    public static function fromRawContent(string $rawContent): self
    {
        return new self(self::createBlocksFromRawContent($rawContent));
    }

    public static function fromRawFile(string $path): self
    {
        $line = fgets(fopen($path, 'r'));
        return new self(self::createBlocksFromRawContent($line));
    }

    private static function createBlocksFromRawContent(string $rawContent): array
    {
        $blocks = str_split($rawContent, 2);
        return array_map(
            fn(string $chunk, int $blockId): DiskBlock => new DiskBlock($blockId, (int)str_split($chunk)[0], (int)(str_split($chunk)[1] ?? 0)),
            $blocks,
            array_keys($blocks)
        );
    }

    public function explode(): string
    {
        $fullDisk = '';
        foreach ($this->blocks as $block) {
            $fullDisk .= implode('', array_fill(0, $block->fileSize, $block->id));
            $fullDisk .= implode('', array_fill(0, $block->freeSpace, '.'));
        }
        return $fullDisk;
    }

    public function rearrange(): Disk
    {
        $disk = $this;
        /** @var DiskBlock $block */
        while(array_any($this->blocks, fn(DiskBlock $block) => $block->freeSpace > 0)) {
            $rearrangedDisk = $this->rearrangeAStep($disk);
            if ($rearrangedDisk === $disk) {
                return $rearrangedDisk;
            }
            $disk = $rearrangedDisk;
        }
        return $disk;
    }

    public function rearrangeWholeFiles(): Disk
    {
        $disk = $this;
        $movedId = count($this->blocks);
        $idsMoved = [];
        $cycleCount = 0;
        foreach(range(1, count($this->blocks)) as $cnt) {
            
            foreach(array_reverse($disk->blocks, true) as $moveIndex => $blockToMove) {
                if ($blockToMove->fileSize === 0 || $movedId < $blockToMove->id || in_array($blockToMove->id, $idsMoved, true)) {
                    continue;
                }
                if ($blockToMove->id === 0) {
                    break 2;
                }
                $cycleCount++;
                foreach($disk->blocks as $targetIndex => $target) {
                    if ($target === $blockToMove) {
                        break;
                    }
                    if ($target->freeSpace >= $blockToMove->fileSize) {
                        $movedId = $blockToMove->id;
                        $idsMoved[] = $movedId;
                        $disk = $disk->moveFile($moveIndex, $targetIndex);
                        break 2;
                    }
                }
            }
        }
//        echo 'cycleCount: ' . $cycleCount . PHP_EOL;
        return $disk;
    }

    private function moveFile(int $moveIndex, int $targetIndex): Disk
    {
        $target = $this->blocks[$targetIndex];
        $move = $this->blocks[$moveIndex];
        $start = array_slice($this->blocks, 0, $targetIndex);
        $middle = array_slice($this->blocks, $targetIndex + 1, $moveIndex - $targetIndex - 1);
        $finish = array_slice($this->blocks, $moveIndex + 1);
        $blocks = [
            ...$start,
            new DiskBlock($target->id, $target->fileSize, 0),
            new DiskBlock($move->id, $move->fileSize, $target->freeSpace - $move->fileSize),
            ...$middle,
            new DiskBlock($move->id, 0, $move->fileSize + $move->freeSpace),
            ...$finish
        ];
        return new Disk($blocks);
    }

    public function checksum(): int
    {
        $checksum = 0;
        foreach($this->blocks as $index => $block) {
            if ($block->fileSize === 0) {
                continue;
            }
            $checksum += $index * $block->id;
        }
        return $checksum;
    }

    public function split(): Disk
    {
        $splitBlocks = [];
        foreach($this->blocks as $block) {
            if ($block->fileSize > 0) {
                foreach(range(1, $block->fileSize) as $cnt) {
                    $splitBlocks[] = new DiskBlock($block->id, 1, 0);
                }
            }
            if ($block->freeSpace > 0) {
                foreach(range(1, $block->freeSpace) as $cnt) {
                    $splitBlocks[] = new DiskBlock($block->id, 0, 1);
                }
            }
        }
        return new Disk($splitBlocks);
    }

    private function rearrangeAStep(Disk $disk): Disk
    {
        $firstFreeBlock = null;
        $firstFreeBlockIndex = null;
        $lastBlock = null;
        $lastBlockIndex = null;
        $endIsAllEmpty = null;
        foreach($disk->blocks as $key => $block) {
            if ($block->freeSpace > 0 && $firstFreeBlock === null) {
                $firstFreeBlock = $block;
                $firstFreeBlockIndex = $key;
            }
            if ($block->fileSize > 0) {
                $lastBlock = $block;
                $lastBlockIndex = $key;
            }
            if ($block->fileSize === 0 && $endIsAllEmpty === null) {
                $endIsAllEmpty = true;
            }
            if (($endIsAllEmpty && $block->fileSize > 0) || ($block->fileSize > 0 && $block->freeSpace > 0)) {
                $endIsAllEmpty = false;
            }
        }
        if ($endIsAllEmpty || $lastBlockIndex === $firstFreeBlockIndex) {
            return $disk;
        }
        $first = new DiskBlock($firstFreeBlock->id, $firstFreeBlock->fileSize, 0);
        $next = new DiskBlock($lastBlock->id, $lastBlock->fileSize, $firstFreeBlock->freeSpace - $lastBlock->fileSize);
        $last = new DiskBlock($lastBlock->id, 0, $lastBlock->freeSpace + $lastBlock->fileSize);
        if ($lastBlock->fileSize > $firstFreeBlock->freeSpace) {
            $next = new DiskBlock($lastBlock->id, $firstFreeBlock->freeSpace, 0);
            $last = new DiskBlock($lastBlock->id, $lastBlock->fileSize - $firstFreeBlock->freeSpace, $lastBlock->freeSpace + $firstFreeBlock->freeSpace);
        }
        return new Disk([
            ...array_slice($disk->blocks, 0, $firstFreeBlockIndex),
            $first,
            $next,
            ...array_slice($disk->blocks, $firstFreeBlockIndex + 1, $lastBlockIndex - $firstFreeBlockIndex - 1),
            $last
        ]);
    }
}
