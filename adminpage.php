<?php

$db = mysqli_connect(
    'localhost',
    'root',
    '',
    'db_website'
);

$query = "SELECT * FROM website";

$result = mysqli_query($db, $query)
or die('error '.mysqli_error($db).' with query '.$query);

$website = [];

while($row = mysqli_fetch_assoc($result))
{
    $website [] = $row;
}
mysqli_close($db);

?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
<ul>
    <?php
    foreach ($website as $website) { ?>

        <li><?= $website['id'] ?> <?= $website['date'] ?> <?= $website['message']?></li>

    <?php } ?>
</ul>
<a href="logout.php">logout</a>
</body>
</html>
