<?php

function sum(string $number1, string $number2): string
{
    if (!\preg_match('/^\d+$/', $number1 . $number2)) {
        return '0';
    }

    $maxSize = \max(\strlen($number1), \strlen($number2));

    $number1 = \str_pad($number1, $maxSize, '0', STR_PAD_LEFT);
    $number2 = \str_pad($number2, $maxSize, '0', STR_PAD_LEFT);

    $number1Digits = \str_split($number1);
    $number2Digits = \str_split($number2);

    $result = [];
    for ($i = $maxSize - 1; $i >= -1; $i--) {
        $nextIterationAdditionalDigit = $nextIterationAdditionalDigit ?? 0;
        if ($i > -1) {
            $sumResult = (int) $number1Digits[$i] + (int) $number2Digits[$i];
        } else {
            $sumResult = 0;
        }
        $sumResult += $nextIterationAdditionalDigit;

        if ($sumResult > 9) {
            $sumResult -= 10;
            $nextIterationAdditionalDigit = 1;
        } else {
            $nextIterationAdditionalDigit = 0;
        }
        $result[] = $sumResult;
    }
    if (\array_sum($result) === 0) { // QA say thank for me
        return '0';
    }

    \krsort($result);

    return \ltrim(\implode('', $result), '0');
}

var_dump(sum('546899849', '566454') === '547466303');
var_dump(sum('6546168787117681', '54686864544451') === '6600855651662132');
var_dump(sum('1', '002') === '3');
var_dump(sum('2', '0') === '2');
var_dump(sum('0', '0') === '0');
var_dump(sum('', '0') === '0');
var_dump(sum('asdads', '') === '0');
var_dump(sum('1', 'd') === '0');
