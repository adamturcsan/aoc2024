<?php

declare(strict_types=1);
/*
 * All rights reserved © 2024 Legow Hosting Kft.
 */

namespace Aoc2024;

/**
 * Description of RuleSet
 *
 * @author Turcsán Ádám <turcsan.adam@legow.hu>
 */
final class RuleSet
{
    private readonly array $rules;

    private ?array $rulesExistFor = null;

    public int $count {
        get => count($this->rules);
    }

    public function __construct(string $ruleString)
    {
        $rules = [];
        foreach (explode("\n", $ruleString) as $ruleLine) {
            [$first, $after] = explode('|', $ruleLine);
            $rules[] = new Rule((int)$first, (int)$after);
        }
        $this->rules = $rules;
    }

    public function isAllowed(PrintOrder $order): bool
    {
        foreach($order->pages as $key => $page) {
            if (!$this->hasRuleFor($page)) {
                continue;
            }
            $previousPages = array_slice($order->pages, 0, $key);
            foreach ($this->rules as $rule) {
                if ($rule->first === $page && in_array($rule->after, $previousPages)) {
                    return false;
                }
            }
        }
        return true;
    }

    private function compare(int $a, $b): int
    {
        foreach ($this->rules as $rule) {
            if ($rule->isApplicable($a, $b)) {
                return $rule->decide($a, $b);
            }
        }
        return 0;
    }

    public function reorder(PrintOrder $order): PrintOrder
    {
        $pages = $order->pages;
        usort($pages, $this->compare(...));
        return new PrintOrder(...$pages);
    }

    private function hasRuleFor(int $pageNo): bool
    {
        if ($this->rulesExistFor === null) {
            foreach ($this->rules as $rule) {
                $this->rulesExistFor[] = $rule->first;
            }
        }
        return in_array($pageNo, $this->rulesExistFor);
    }
}
