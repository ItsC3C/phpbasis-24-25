<?php

$title = "";
$name = ucwords(strtolower(@$_GET['name'])); // ucwords = eerste letter een hoofdletter en strtolower = alles een kleine letter

$gender = @$_GET['gender'];
if ($gender == "f") {
    $title = "Mv. ";
} else if ($gender == "m") {
    $title = "Mr. ";
}

echo "Beste $title$name";
