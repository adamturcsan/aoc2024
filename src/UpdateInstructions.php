<?php

declare(strict_types=1);
/*
 * All rights reserved © 2024 Legow Hosting Kft.
 */

namespace Aoc2024;

/**
 * Description of UpdateInstructions
 *
 * @author Turcsán Ádám <turcsan.adam@legow.hu>
 */
final class UpdateInstructions
{
    public readonly array $instructions;

    public int $count {
        get => count($this->instructions);
    }

    public function __construct(string $instuctionsInput)
    {
        $instructions = [];
        foreach (explode("\n", $instuctionsInput) as $instructionLine) {
            $pages = array_map(intval(...), explode(',', $instructionLine));
            $instructions[] = new PrintOrder(...$pages);
        }
        $this->instructions = $instructions;
    }
}
