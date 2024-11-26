<?php
$db_host = '127.0.0.1';
$db_user = 'root';
$db_password = 'root';
$db_db = 'phpbasis';
$db_port = 8889;
try {
  $db = new PDO('mysql:host=' . $db_host . '; port=' . $db_port . '; dbname=' . $db_db, $db_user, $db_password);
} catch (PDOException $e) {
  echo "Error!: " . $e->getMessage() . "<br />";
  die();
}

$sort = 'title';
$direction = 'ASC';
if (@$_GET['sort'] != null) {
  if (in_array(@$_GET['sort'], ['id', 'title', 'release_year', 'production_studio', 'genres'])) {
    $sort = @$_GET['sort'];
  }
}
if (in_array(@$_GET['dir'], ['down'])) {
  $direction = 'DESC';
}


$db->setAttribute(PDO::ATTR_EMULATE_PREPARES, FALSE);
$sql = "SELECT * FROM movies ORDER BY $sort $direction";
$stmt = $db->prepare($sql);
$stmt->execute();
$movies = $stmt->fetchAll(PDO::FETCH_ASSOC);

// print '<pre>';
// print_r($movies);
// exit;

?>
<!DOCTYPE html>
<html lang="en">

<head>
  <link rel="stylesheet" href="https://unpkg.com/mvp.css" />
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <style>
    table thead tr th a {
      color: white;
    }
  </style>
  <title>Movies</title>
</head>

<body>
  <main>
    <h1>MOVIES</h1>
    <table>
      <thead>
        <tr>
          <th><a href="?sort=id&dir=<?= ($sort == 'id' && $direction == 'ASC' ? 'down' : 'up') ?>">ID</a></th>
          <th><a href="?sort=title&dir=<?= ($sort == 'title' && $direction == 'ASC' ? 'down' : 'up') ?>">Title</a></th>
          <th><a href="?sort=release_year&dir=<?= ($sort == 'release_year' && $direction == 'ASC' ? 'down' : 'up') ?>">Year</a></th>
          <th><a href="?sort=production_studio&dir=<?= ($sort == 'production_studio' && $direction == 'ASC' ? 'down' : 'up') ?>">Production Studio</a></th>
          <th><a href="?sort=genres&dir=<?= ($sort == 'genres' && $direction == 'ASC' ? 'down' : 'up') ?>">Genres</a></th>
        </tr>
      </thead>
      <tbody>
        <?php foreach ($movies as $movie) : ?>
          <tr>
            <td><?= $movie['id']; ?></td>
            <td><?= $movie['title']; ?></td>
            <td><?= $movie['release_year']; ?></td>
            <td><?= $movie['production_studio']; ?></td>
            <td><?= $movie['genres']; ?></td>
          </tr>
        <?php endforeach ?>
      </tbody>
    </table>
  </main>
</body>

</html>