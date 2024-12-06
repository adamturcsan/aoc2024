<?php

declare(strict_types=1);
/*
 * All rights reserved © 2024 Legow Hosting Kft.
 */

namespace Aoc2024;

/**
 * Description of PrintOrder
 *
 * @author Turcsán Ádám <turcsan.adam@legow.hu>
 */
final class PrintOrder
{
    public readonly array $pages;

    public function __construct(int ... $pages)
    {
        $this->pages = $pages;
    }
}
