<?php
$id = htmlspecialchars($_POST['delete']);
echo $id;
//maak een connectie met de database
$db = mysqli_connect(
    'localhost',
    'root',
    '',
    'db_website'
);

if (mysqli_query($db, $sql)) {
    echo "Uw afspraak is ingeplanned!";
} else {
    echo "Helaas, dit tijdsvak is al bezet.";
}

mysqli_close($db);

?>
