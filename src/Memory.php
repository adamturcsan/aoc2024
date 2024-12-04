<?php

declare(strict_types=1);
/*
 * All rights reserved © 2024 Legow Hosting Kft.
 */

namespace Aoc2024;

/**
 * Description of Memory
 *
 * @author Turcsán Ádám <turcsan.adam@legow.hu>
 */
final class Memory
{
    public function __construct(public readonly string $memoryContent)
    {
        ;
    }

    public static function fromFile(string $path): self
    {
        return new self(file_get_contents($path));
    }
}
