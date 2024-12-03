<?php

declare(strict_types=1);
/*
 * All rights reserved © 2024 Legow Hosting Kft.
 */

namespace Aoc2024;

use function array_sum;
use function sort;

/**
 * Description of ListComparator
 *
 * @author Turcsán Ádám <turcsan.adam@legow.hu>
 */
final class ListComparator
{
    private array $appearance = [];

    public function calculateDistance(ListInput $input): int
    {
        $listA = $input->left;
        $listB = $input->right;
        sort($listA);
        sort($listB);
        $distance = 0;
        foreach($listA as $key => $left) {
            $right = $listB[$key];
            $distance += abs($left - $right);
        }
        return $distance;
    }

    public function calculateSimilarityScore(ListInput $input): int
    {
        $appearances = [];
        foreach($input->left as $left) {
            $appearances[] = $left * $this->getAppearance($left, $input->right);
        }
        return array_sum($appearances);
    }

    private function getAppearance(int $num, array $list): int
    {
        if (isset($this->appearance[$num])) {
            return $this->appearance[$num];
        }
        $this->appearance[$num] = 0;
        foreach($list as $candidate) {
            if ($num === (int)$candidate) $this->appearance[$num]++;
        }
        return $this->appearance[$num];
    }
}
