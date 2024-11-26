<?php
$height = @$_GET['h'];
if ($height === null) {
    $height = 21;
}

for ($i = 1; $i <= $height; $i += 2) {

    $spaces = floor(($height - $i) / 2);

    echo str_repeat("&nbsp;", $spaces);

    $char = "*";
    echo str_repeat($char, $i);

    echo str_repeat("&nbsp;", $spaces);

    echo "<br >";
}
