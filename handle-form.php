<?php
$date = htmlspecialchars($_POST['date']);
$time  = htmlspecialchars($_POST['time']);
$msg = htmlspecialchars($_POST['msg']);

//maak een connectie met de database
$db = mysqli_connect(
    'localhost',
    'root',
    '',
    'db_website'
);

$sql = "INSERT INTO website (id, date, message)
    VALUES(
        ' ',
        '$date $time',
        '$msg'
    )";

if (mysqli_query($db, $sql)) {
    echo "Uw afspraak is ingeplanned!";
} else {
    echo "Helaas, dit tijdsvak is al bezet.";
}

mysqli_close($db);

?>


