<?php
require('db.inc.php');
$authors = getAuthors();

// print '<pre>';
// print_r($_POST);
// print '</pre>';

// 1: ALLE DEFAULT VALUES DECLAREREN: 
$title = "";
$body = "";
$author_id = null;
$status = 0;
$errors = [];
$datum = 0;

// KIJK OF HET FORMULIER GE-SUBMIT WERD
if (@$_POST['submit']) { // IS "SUBMIT" ALS KEY AANWEZIG IN DE $_POST ARRAY?


    // 2: VALIDATIE UITVOEREN:

    // VALIDATIE TITLE
    if (!$_POST['title']) { // IS DE TITLE AANWEZIG?
        $errors[] = "title field missing!";
    } else {
        if (strlen($_POST['title']) == 0) { // IS DE TITLE LANG GENOEG?
            $errors[] = 'title field can not be empty';
        } else { // GEEN PROBLEM? -> PUSH IN DATABANK
            $title = $_POST['title'];
        }
    }

    // VALIADTIE BODY
    if (!$_POST['body']) { // IS DE BODY AANWEZIG?
        $errors[] = "body field missing!";
    } else { // GEEN PROBLEM? -> PUSH IN DATABANK
        $body = $_POST['body'];
    }

    // VALIDATIE AUTHOR
    if (!$_POST['author']) { // IS DE AUTHOR AANGEDUID?
        $errors[] = "author field missing!";
    } else {
        if ((int)$_POST['author'] === 0) { // AUTHOR NIET IS AANGEDUID DAN IS AUTHOR = null !
            $_POST['author'] = null;
        }
        if (!isset($authors[$_POST['author']]) && $_POST['author'] == null) { // BESTAAT DE AUTHOR_ID?
            $errors = "author ID does not exist!";
        } else { // GEEN PROBLEEM? -> PUSH IN DATABANK
            $author_id = $_POST['author'];
        }
    }

    // VALIDATIE STATUS
    if (isset($_POST['status']) && $_POST['status'] == 1) { // ZIT DE STATUS IN MIJN POST EN IS DEZE GELIJKAAN 1
        $status = 1;
    }

    if (isset($_POST['datum'])) {
        $datum = $_POST['datum'] . ' 00:00:00';
    }

    // 3: VALIDATIE OK? -> INSERT INTO DATABASE:
    if (count($errors) == 0) { // GEEN FOUTEN?
        insertNewsItem($title, $body, $author_id, $status, $datum); // ENKEL ALS HIJ GESUBMIT WORDT GAAT HIJ IETS LEEG IN DE DATABANK STEKEN
        header("Location: index.php?message=Record werd toegevoegd");
    }
}

?>
<!doctype html>
<html lang="nl">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>My first CRUD - Add new item</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" integrity="sha384-tViUnnbYAV00FLIhhi3v/dWt3Jxw4gZQcNoSCxCIFNJVCx7/D55/wXsrNIRANwdD" crossorigin="anonymous">
</head>

<body>


    <div class="container">
        <main class="col-md-9">
            <h2>Add new item</h2>

            <?php if (count($errors) > 0): ?>
                <div class="p-3 text-warning-emphasis bg-warning-subtle border border-warning-subtle rounded-3">
                    <ul>
                        <?php foreach ($errors as $error): ?>
                            <li><?= $error ?></li>
                        <?php endforeach; ?>
                    </ul>
                </div>
            <?php endif; ?>

            <?php if (@$_POST['submit'] && count($errors) == 0): ?>
                <div class="p-3 text-success-emphasis bg-success-subtle border border-success-subtle rounded-3">
                    Nieuws item werd toegevoegd...
                </div>
            <?php endif; ?>

            <!-- bij een form altijd een method (hoe verstuur je die? GET of POST), action (naar waar versturen we de form) -->
            <form method="post" action="form.php">
                <div class="mb-3">
                    <label for="title" class="form-label">Title *:</label>
                    <input type="text" class="form-control" id="title" name="title" placeholder="Enter title..." value="<?= $title ?>" />
                </div>
                <div class="mb-3">
                    <label for="body" class="form-label">Article *:</label>
                    <textarea class="form-control" id="body" name="body" rows="5"><?= $body; ?></textarea>
                </div>

                <div class="mb-3">
                    <select id="author" name="author" class="form-select" aria-label="Author">
                        <option <?php $author_id ?> value="0">Please select an author</option>
                        <?php foreach ($authors as $index => $author): ?>
                            <option value="<?= $index; ?>" <?= $index == $author_id ? 'selected' : ' '; ?>><?= $author; ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>

                <div class="mb-3">
                    <div class="form-check form-switch">
                        <input class="form-check-input" type="checkbox" role="switch" id="status" name="status" value="1" <?= @$_POST['submit'] && $status == 0 ? '' : 'checked' ?>>
                        <label class="form-check-label" for="status">Published</label>
                    </div>
                </div>

                <div class="mb-3">
                    <div class="form-check form-switch">
                        <label for="startDate">Publication date</label>
                        <input id="startDate" name="datum" class="form-control" type="date" />
                        <span id="startDateSelected"></span>
                    </div>
                </div>

                <input type="submit" name="submit" id="submit" />
            </form>

        </main>

    </div>

    <script src="/docs/5.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>

</html>