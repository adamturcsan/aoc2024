<?php

declare(strict_types=1);
/*
 * All rights reserved © 2024 Legow Hosting Kft.
 */

namespace Aoc2024;

/**
 * Description of DiskBlock
 *
 * @author Turcsán Ádám <turcsan.adam@legow.hu>
 */
final class DiskBlock
{
    public function __construct(public int $id, public int $fileSize, public int $freeSpace)
    {
        ;
    }
}
