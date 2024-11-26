<?php
// CONNECTIE MAKEN MET DE DB
function connectToDB()
{
    // CONNECTIE CREDENTIALS
    $db_host = '127.0.0.1';
    $db_user = 'root';
    $db_password = 'root';
    $db_db = 'bondscoach';
    $db_port = 8889;
    try {
        $db = new PDO('mysql:host=' . $db_host . '; port=' . $db_port . '; dbname=' . $db_db, $db_user, $db_password);
    } catch (PDOException $e) {
        echo "Error!: " . $e->getMessage() . "<br />";
        die();
    }
    $db->setAttribute(PDO::ATTR_EMULATE_PREPARES, FALSE);
    return $db;
}

// HAAL ALLES OP UIT DB COACHES
function name(): array
{
    $sql = "SELECT * FROM Coaches";
    $stmt = connectToDB()->prepare($sql);
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

// HAAL ALLES OP UIT DB SUGGESTIES
function nameSuggesties(): array
{
    $sql = "SELECT * FROM Suggesties";
    $stmt = connectToDB()->prepare($sql);
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

// ANDERE TOEVOEGEN IN DB SUGGESTIES
function addSugg($naam)
{
    $db = connectToDB();
    $sql = "INSERT INTO bondscoach.Suggesties(naam_sug) VALUES (:naam)";
    $stmt = $db->prepare($sql);
    $stmt->execute([
        ':naam' => $naam
    ]);
    return $db->lastInsertId();
}

// VERHOOG AANTAL VAN COACHES
function oneMore($id)
{
    $db = connectToDB();
    $sql = "UPDATE Coaches SET aantal =+1 WHERE idCoaches = (:id)";
    $stmt = $db->prepare($sql);
    $stmt->execute([
        ':id' => $id
    ]);
    return $db->lastInsertId();
}
