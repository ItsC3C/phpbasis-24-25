<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

include("answers.php");

$previousAnswers = [];

function getRandomAnswer($answers, $previousAnswers)
{
    if (count($previousAnswers) >= count($answers)) {
        return null;
    }
    do {
        $randomElement = $answers[array_rand($answers)];
    } while (in_array($randomElement, $previousAnswers)); // geen herhaling!
    $previousAnswers[] = $randomElement;
    return $randomElement;
}

$randomElement = null;

if (isset($_GET['8-ball'])) {
    $randomElement = getRandomAnswer($answers, $previousAnswers);
}
?>
<!DOCTYPE html>
<html lang="en" data-lt-installed="true">

<head>
    <link rel="icon" href="https://via.placeholder.com/70x70">
    <link rel="stylesheet" href="https://unpkg.com/mvp.css">

    <meta charset="utf-8">
    <meta name="description" content="My description">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>8 BALL</title>
</head>

<body>
    <main>
        <section>
            <header>Welcome to the MAGIC 8 BALL</header>
            <form method="GET">
                Enter question: <input type="text" name="8-ball"><br />
                <input type="submit" value="<?php echo ($randomElement !== null) ? 'ASK AGAIN' : 'ASK 8-BALL'; ?>" name="Button"><br /> <!-- if true : 'ASK AGAIN' (ALTIJD!) if false : 'ASK 8-BALL'-->
                <?php if ($randomElement !== null) { ?>
                    <p>ANSWER: <?php echo getRandomAnswer($answers, $previousAnswers); ?></p>
                <?php } ?>
            </form>
        </section>
    </main>
</body>

</html>