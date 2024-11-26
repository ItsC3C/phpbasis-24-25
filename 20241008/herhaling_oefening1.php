<?php

// OEF: Bereken deze keer de soms van alle getallen (tussen $start en $start + $count zoals gezien in de laatste oefeningen)
// Dus: indien $start gelijk is aan 10 en $count gelijk aan 3, dan zou het resultaat 33 moeten zijn (10 + 11 + 12)
$getal1 = @$_GET['start'];
$getal2 = $getal1 + @$_GET['stop'];
$som = 0;

for ($i = $getal1; $i < $getal2; $i++) {
    echo "$i <br >";
    $som = $som + $i;
}

echo "De som bedraagt $som";
