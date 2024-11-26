<?php

function subFib($start, $count)
{
    $sum = 0;
    for ($i = $start; $i < ($start + $count); $i++) {
        $sum += $i;
    }
    return $sum;
}

echo subFib(20, 2) . "<br />";
echo subFib(20, 3) . "<br />";
echo subFib(50, 100) . "<br />";

$basis = 10000;
function superSum(int $one, int $two, $basis): int // $basis kan ook als global in de function MAAR onprofessioneel
{
    return $one + $two + $basis;
};

echo "De supersom van 5 en 10 = " . superSum(5, 10, $basis) . "<br/>";
