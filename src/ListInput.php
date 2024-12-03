<?php

declare(strict_types=1);
/*
 * All rights reserved © 2024 Legow Hosting Kft.
 */

namespace Aoc2024;

use function array_map;
use function explode;
use function fgets;
use function fopen;
use function trim;

/**
 * Description of ListInput
 *
 * @author Turcsán Ádám <turcsan.adam@legow.hu>
 */
final class ListInput
{
    private(set) array $left = [];
    private(set) array $right = [];

    public static function fromFile(string $path): self
    {
        $list = new self();
        $file = fopen($path, 'r');
        $key = 0;
        while($line = fgets($file)) {
            [$list->left[$key], $list->right[$key]] = array_map('intval', explode('   ', trim($line)));
            $key++;
        }
        return $list;
    }

    public static function fromArrays(array $left, array $right): self
    {
        $list = new self();
        $list->left = $left;
        $list->right = $right;
        return $list;
    }
}
