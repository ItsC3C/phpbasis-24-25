<?php
// ini_set('display_errors', 1);
// ini_set('display_startup_errors', 1);
// error_reporting(E_ALL); 
// -> alle errors tonen bij crash!

$firstname = "Voornaam"; // default waarde
$lastname = "Achternaam";

$id = @$_GET["id"]; // neemt de waarde van id in de url
$modus = @$_GET["mode"];

// if ($id == 1) {
//   $firstname = "Cédric";
//   $lastname = "Van Hoorebeke";
// } elseif ($id == 2) {
//   $firstname = "Jana";
//   $lastname = "Neirinck";
// }
switch ($id) {
  case 1:
    $firstname = "Cédric";
    $lastname = "Van Hoorebeke";
    break;
  case 2:
    $firstname = "blabla";
    $lastname = "lalalalalala";
    break;
}
?>
<html>

<head>
  <title>Portfolio <?php echo "$firstname $lastname"; ?></title>
  <link rel="stylesheet" href="https://unpkg.com/mvp.css">
</head>

<body>
  <main>
    <h1><?php echo "$firstname $lastname"; ?></h1>

    <!-- 
    <h1><?php echo $firstname . " " . $lastname; ?></h1>  KIES 
    <h1><?php echo '$firstname $lastname'; ?></h1> FOUT 
    -->

    <h2>Student FSD</h2>
    <p>
      Lorem ipsum dolor, sit amet consectetur adipisicing elit. Praesentium hic
      unde ipsam veritatis asperiores soluta. Dicta eligendi optio consequuntur,
      eum repellat tenetur? Alias, quos. Quisquam magni animi maxime nostrum
      unde! Illo nesciunt fuga odio, eum eligendi provident? Architecto quisquam
      quos facilis deleniti quod iste maxime vitae optio aliquam modi? Quis
      ullam iure ab asperiores. Illum eveniet perferendis error a neque!
      <br />Sed impedit rerum dolorum. Soluta, commodi illo. Natus dolorum est
      harum, error atque, expedita nihil reiciendis perspiciatis illum optio
      eveniet fugiat quos similique aliquam. Nostrum voluptatum cumque illum
      suscipit accusamus. Nulla, numquam. Quod non consequatur sed dolores odio
      hic! Sequi modi hic a at corrupti voluptate veritatis recusandae quisquam.
      Reiciendis accusamus voluptas assumenda fugit in molestias, veniam
      expedita tenetur veritatis.
    </p>
    <p>
      Lorem ipsum, dolor sit amet consectetur adipisicing elit. Est fugiat eaque
      labore dolores delectus! Eligendi minima suscipit fugiat eum in excepturi
      culpa reiciendis aspernatur, ducimus esse, asperiores distinctio, qui eos!
    </p>
    <ul>
      <li>
        <a
          href="https://www.instagram.com/cedricvanhoorebekee/"
          target="_blank"
          title="Mijn instagram">Instagram</a>
      </li>
      <li>
        <a
          href="https://www.linkedin.com/in/cédric-van-hoorebeke-951554227"
          target="_blank"
          title="linkedin">Linkedin</a>
      </li>
      <li>
        <a
          href="mailto:cedricvanhoorebeke@outlook.com?subject=Contact formulier website"
          target="_blank"
          title="Mijn email">Email</a>
      </li>
    </ul>
    <ol>
      <li>Gent</li>
      <li>Mechelen</li>
      <li>Antwerpen</li>
    </ol>
  </main>
  <footer>
    <hr>
    <p>
      <small>© Copyright 2024 by <?php print "$firstname $lastname"; ?></small>
    </p>
  </footer>
</body>

</html>

<!-- serverside (PHP) vs clientside (JavaScript) -->