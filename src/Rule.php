<?php

declare(strict_types=1);
/*
 * All rights reserved © 2024 Legow Hosting Kft.
 */

namespace Aoc2024;

/**
 * Description of Rule
 *
 * @author Turcsán Ádám <turcsan.adam@legow.hu>
 */
final class Rule
{
    public function __construct(public readonly int $first, public readonly int $after)
    {
        ;
    }

    public function isApplicable(int $a, int $b): bool
    {
        return ($this->first === $a || $this->after === $a) && ($this->first === $b || $this->after === $b);
    }

    public function decide(int $a, int $b) {
        if ($a === $this->first) {
            return -1;
        }
        return 1;
    }
}
