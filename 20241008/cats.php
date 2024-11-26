<?php
include("data.php");
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
                <h2>Overzicht van Lego</h2>
                <p>Lego van unsplash:</p>
            </header>
            <?php
            foreach ($photos as $inedx => $photo) { ?>
                <aside>
                    <a href="detail.php?id=<?php echo $inedx ?>">
                        <img src="<?php echo $photo; ?>" />
                </aside>
            <?php
            }
            ?>
        </section>
    </main>
</body>

</html>