<?php
require('wikis.php');

$index = @$_GET['id'];
$g = @$_GET['g'];
$guesses = explode(',', $g);

if (!isset($wikis[$index])) {
    header("HTTP/1.0 404 Not Found");
    header('Location: index.php');
    exit;
}

$wiki = $wikis[$index];

include($wiki['data']);


$allowed_words = ['in', 'de', 'door', 'het', 'is', 'een'];

$text_parts = explode(' ', $text);

// print '<pre>';
// var_dump($text);
// print_r($text_parts);
// print '<pre>';

for ($i = 0; $i < count($text_parts); $i++) {
    if (!in_array($text_parts[$i], $allowed_words)) {
        $len = strlen($text_parts[$i]);
        $text_parts[$i] = str_repeat("*", $len);
    }
}

$text = implode(' ', $text_parts);
?>
<!DOCTYPE html>
<html lang="en" data-lt-installed="true">

<head>
    <link rel="icon" href="https://via.placeholder.com/70x70">
    <link rel="stylesheet" href="https://unpkg.com/mvp.css">

    <meta charset="utf-8">
    <meta name="description" content="WikiWisKwis voor <?= $wiki['episode']; ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>WikiWisKwis - <?= $wiki['episode']; ?></title>
</head>

<body>
    <main>
        <section>
            <header>
                <h1>WikiWisKwis - <?= $wiki['episode']; ?></h1>
            </header>

            <ul>
                <?php foreach ($guesses as $guess): ?>
                    <li><?= $guess; ?></li>
                <?php endforeach; ?>
            </ul>


            <?= $text; ?>

        </section>
    </main>

</body>

</html>