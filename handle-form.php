<?php
$date = htmlspecialchars($_POST['date']);
$time  = htmlspecialchars($_POST['time']);
$msg = htmlspecialchars($_POST['msg']);
$mail = htmlspecialchars($_POST['mail']);
$phone = htmlspecialchars($_POST['phone']);
$name = htmlspecialchars($_POST['name']);

//maak een connectie met de database
$db = mysqli_connect(
    'localhost',
    'root',
    '',
    'db_website'
);

$sql = "INSERT INTO website (id, date, message, name, email, phone)
    VALUES(
        ' ',
        '$date $time',
        '$msg',
        '$name',
        '$mail',
        '$phone'
    )";

if (mysqli_query($db, $sql)) {
    echo "Uw afspraak is ingeplanned! Je wordt automatisch teruggeleid.";
    header("Refresh:5; url=main.php");
} else {
    echo "Helaas, dit tijdsvak is al bezet.";
}

mysqli_close($db);

?>


