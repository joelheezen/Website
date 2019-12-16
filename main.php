<?php
$date_now = date("Y-m-d");
$date_then = (date("Y")+1).date("-m-d");
$time_now = date("H:i");
?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Anja's administratiekantoor</title>
    <link rel="stylesheet" href="styling.css">
</head>
<body>
<h1>test form</h1>
<form action="/PRG02/website/handle-form.php" method="post">
        <div>
            <label for="date">Datum</label>
            <input type="date" id="date" name="date"
            value= "<?= $date_now; ?>"
            min= "<?= $date_now; ?>" max= "<?= $date_then; ?>">
        </div>
        <div>
            <label for="time">tijdstip</label>
            <input type="time" id="time" name="time"
            value= "<?= $time_now; ?>"
            min="08:00" max="20:00" step="900">
        </div>
        <div>
            <label for="message">Bericht</label>
            <textarea id="message" name="msg">Vul hier eventueel een bericht toe.</textarea>
        </div>
        <div class="button">
            <button type="submit">Verstuur je aanvraag</button>
</form>
</body>
</html>