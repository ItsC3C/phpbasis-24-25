<?php
include("data.php");
$id = @$_GET["id"];
if ($id >= count($photos))
    if ($id >= count($photos) || $id < 0 || !isset($photos[$id])) { //isset = isset — Determine if a variable is declared and is different than null
        $id = 0;
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

    <title>Lego - detail</title>
</head>

<body>
    <main>
        <section>
            <header>
                <h2>Detail lego</h2>
            </header>
            <img src="<?php echo $photos[$id]['url']; ?>">
        </section>
    </main>
</body>

</html>