<?php

declare(strict_types=1);
/*
 * All rights reserved © 2024 Legow Hosting Kft.
 */

namespace Aoc2024;

use function explode;

/**
 * Description of Update
 *
 * @author Turcsán Ádám <turcsan.adam@legow.hu>
 */
final class Update
{
    private RuleSet $rules;
    private UpdateInstructions $instructions;

    public int $ruleCount {
        get => $this->rules->count;
    }
    public int $instructionCount {
        get => $this->instructions->count;
    }

    public function __construct(string $updateDoc)
    {
        [$rules, $instructions] = explode("\n\n", $updateDoc);

        $this->rules = new RuleSet($rules);
        $this->instructions = new UpdateInstructions($instructions);
    }

    public function validInstructionSum(): int
    {
        $sum = 0;
        foreach ($this->instructions->instructions as $instruction) {
            if ($this->rules->isAllowed($instruction)) {
                $sum += $instruction->pages[floor(count($instruction->pages)/2)];
            }
        }
        return $sum;
    }

    public function reorderedInstructionSum(): int
    {
        $sum = 0;
        foreach ($this->instructions->instructions as $instruction) {
            if (!$this->rules->isAllowed($instruction)) {
                $pages = $this->reorderPages($instruction);
                $sum += $pages[floor(count($pages)/2)];
            }
        }
        return $sum;
    }

    private function reorderPages(PrintOrder $instruction): array
    {
        return $this->rules->reorder($instruction)->pages;
    }
}
