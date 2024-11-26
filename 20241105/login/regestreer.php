<?php

$host = 'localhost';
$db   = 'your_database_name';
$user = 'your_username';
$pass = 'your_password';
$charset = 'utf8mb4';

$dsn = "mysql:host=$host;dbname=$db;charset=$charset";
$options = [
    PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    PDO::ATTR_EMULATE_PREPARES   => false,
];

try {
    $pdo = new PDO($dsn, $user, $pass, $options);
} catch (\PDOException $e) {
    throw new \PDOException($e->getMessage(), (int)$e->getCode());
}

$errors = [];
$success = false;

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $firstname = trim($_POST['firstname']);
    $lastname = trim($_POST['lastname']);
    $username = trim($_POST['username']);
    $gender = $_POST['gender'];
    $photo = trim($_POST['photo']);

    if (empty($firstname) || strlen($firstname) > 100) {
        $errors[] = "Voornaam is verplicht en mag niet langer zijn dan 100 karakters.";
    }

    if (empty($lastname) || strlen($lastname) > 100) {
        $errors[] = "Naam is verplicht en mag niet langer zijn dan 100 karakters.";
    }

    if (empty($username) || strlen($username) > 20) {
        $errors[] = "Username is verplicht en mag niet langer zijn dan 20 karakters.";
    } else {
        // Controleer of username uniek is
        $stmt = $pdo->prepare("SELECT COUNT(*) FROM members WHERE username = ?");
        $stmt->execute([$username]);
        if ($stmt->fetchColumn() > 0) {
            $errors[] = "Deze username is al in gebruik.";
        }
    }

    if (!in_array($gender, ['m', 'f', 'x'])) {
        $errors[] = "Kies een geldig geslacht (m, f, of x).";
    }

    if (!empty($photo) && !filter_var($photo, FILTER_VALIDATE_URL)) {
        $errors[] = "Geef een geldige URL voor de foto.";
    }

    if (empty($errors)) {
        $stmt = $pdo->prepare("INSERT INTO members (firstname, lastname, username, gender, photo) VALUES (?, ?, ?, ?, ?)");
        if ($stmt->execute([$firstname, $lastname, $username, $gender, $photo])) {
            $success = true;
        } else {
            $errors[] = "Er is een fout opgetreden bij het registreren.";
        }
    }
}

include 'index.php';
