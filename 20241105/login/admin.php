<?php
require_once 'registreer.php';

if (isset($_POST['delete'])) {
    $id = $_POST['delete'];
    $stmt = $pdo->prepare("DELETE FROM members WHERE id = ?");
    $stmt->execute([$id]);
}

$stmt = $pdo->query("SELECT * FROM members");
$members = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="nl">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin - Members Overzicht</title>
    <style>
        table {
            border-collapse: collapse;
        }

        th,
        td {
            border: 1px solid black;
            padding: 5px;
        }
    </style>
</head>

<body>
    <h1>Members Overzicht</h1>
    <table>
        <tr>
            <th>ID</th>
            <th>Voornaam</th>
            <th>Naam</th>
            <th>Username</th>
            <th>Geslacht</th>
            <th>Foto</th>
            <th>Actie</th>
        </tr>
        <?php foreach ($members as $member): ?>
            <tr>
                <td><?php echo htmlspecialchars($member['id']); ?></td>
                <td><?php echo htmlspecialchars($member['firstname']); ?></td>
                <td><?php echo htmlspecialchars($member['lastname']); ?></td>
                <td><?php echo htmlspecialchars($member['username']); ?></td>
                <td><?php echo htmlspecialchars($member['gender']); ?></td>
                <td><?php echo $member['photo'] ? '<img src="' . htmlspecialchars($member['photo']) . '" alt="Profielfoto" width="50">' : 'Geen foto'; ?></td>
                <td>
                    <form method="post" onsubmit="return confirm('Weet je zeker dat je deze member wilt verwijderen?');">
                        <button type="submit" name="delete" value="<?php echo $member['id']; ?>">Verwijderen</button>
                    </form>
                </td>
            </tr>
        <?php endforeach; ?>
    </table>
</body>

</html>