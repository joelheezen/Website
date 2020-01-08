<?php
$date = htmlspecialchars($_POST['date']);
$time  = htmlspecialchars($_POST['time']);
$id = htmlspecialchars($_POST['id']);

//maak een connectie met de database
$db = mysqli_connect(
'localhost',
'root',
'',
'db_website'
);

$sql = "UPDATE website
SET date = '$date $time'
WHERE id = '$id'";

if (mysqli_query($db, $sql)) {
echo "De afspraak is upgedate!";
} else {
echo "Helaas, dit tijdsvak is al bezet.";
}

mysqli_close($db);

?>
