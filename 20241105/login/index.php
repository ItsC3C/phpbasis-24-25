<!DOCTYPE html>
<html lang="nl">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registratie</title>
    <style>
        .error {
            color: red;
        }

        .success {
            color: green;
        }
    </style>
</head>

<body>
    <h1>Member Registratie</h1>

    <?php if ($success): ?>
        <p class="success">Registratie succesvol!</p>
    <?php endif; ?>

    <?php if (!empty($errors)): ?>
        <ul class="error">
            <?php foreach ($errors as $error): ?>
                <li><?php echo htmlspecialchars($error); ?></li>
            <?php endforeach; ?>
        </ul>
    <?php endif; ?>

    <form method="post">
        <div>
            <label for="firstname">Voornaam:</label>
            <input type="text" id="firstname" name="firstname" maxlength="100" required>
        </div>
        <div>
            <label for="lastname">Naam:</label>
            <input type="text" id="lastname" name="lastname" maxlength="100" required>
        </div>
        <div>
            <label for="username">Username:</label>
            <input type="text" id="username" name="username" maxlength="20" required>
        </div>
        <div>
            <label for="gender">Geslacht:</label>
            <select id="gender" name="gender" required>
                <option value="">Kies...</option>
                <option value="m">Man</option>
                <option value="f">Vrouw</option>
                <option value="x">Anders</option>
            </select>
        </div>
        <div>
            <label for="photo">Foto URL (optioneel):</label>
            <input type="url" id="photo" name="photo">
        </div>
        <div>
            <button type="submit">Registreren</button>
        </div>
    </form>
</body>

</html>