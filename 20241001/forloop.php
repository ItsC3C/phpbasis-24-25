<?php
// $x = 50;
// echo $x;

$x =  @$_GET["count"];
$y = @$_GET["start"];

for ($i = $y; $i <= ($y + $x); $i = $i + 1) { // $i = start; $i is kleiner dan of gelijkaan dan start + count; $i is gelijkaan $i + 2 (evengetallen)
    $isPrime = true;

    for ($divider = 2; $divider < $i; $divider += 1) {
        if ($i % $divider == 0) {
            $isPrime = false;
        }
    }
    if ($isPrime) {
        echo "$i is een priemgetal! <br/>";
    }
}
