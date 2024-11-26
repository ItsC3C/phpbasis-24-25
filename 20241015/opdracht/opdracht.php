<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

include("data.php");
$itemsPerPage = 6;
$start = 0;
$currentPage = @$_GET['page']; // ? @$_GET['page] : 1 doet hetzelfde als onderstaande if functie
$currentPage = (int)$currentPage;

if ($currentPage == 0) {
    $currentPage = 1;
}

$start = ($currentPage - 1) * $itemsPerPage; // OPGELET arrays starten bij 0, dus 1 aftrekken!!!
$stop = $start + $itemsPerPage;

$totalAmountOfPhotos = count($photos);
$totalAmountOfPages = ceil($totalAmountOfPhotos / $itemsPerPage);
if ($stop > $totalAmountOfPhotos) {
    $stop = $totalAmountOfPhotos;
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

    <title>Lego</title>
</head>

<body>
    <main>
        <section>
            <header>
                <h2>Overzicht van lego</h2>
                <p><?= $totalAmountOfPhotos; ?> Lego foto's van unsplash:</p>
            </header>
            <?php
            for ($i = $start; $i < $stop; $i++):
            ?>
                <aside style="background-color: <?php echo $photos[$i]['color']; ?>">
                    <a href="lego_detail.php?id=<?= $i; ?>"><img src="<?php echo $photos[$i]['url']; ?>" /></a>
                </aside>
            <?php
            endfor;
            ?>
            <?php if ($currentPage < $totalAmountOfPages): ?>
                <a href="opdracht.php?page=<?= $currentPage + 1; ?>"><b>Next</b></a>
            <?php
            endif;
            ?>
        </section>
    </main>
</body>

</html>