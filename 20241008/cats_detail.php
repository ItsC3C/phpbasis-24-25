<?php
include("cats_data.php");
$id = @$_GET["id"];
if ($id >= count($photos)) {
    echo "ERROR. UNVALUED ID";
    exit;
} elseif ($id === null) {
    echo "ERROR. UNVALUED ID";
    exit;
} elseif (!isset($photos[$id])) {
    echo "ERROR.UNVALUED ID";
    exit;
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

    <title>Cats cats cats</title>
</head>

<body>
    <main>
        <section>
            <header>
                <h2>Detail kat</h2>
            </header>
            <img src="<?php echo $photos[$id]; ?>">
        </section>
    </main>
</body>

</html>