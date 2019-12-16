<?php
// The global $_POST variable allows you to access the data sent with the POST method by name
// To access the data sent with the GET method, you can use $_GET
$date = htmlspecialchars($_POST['date']);
$time  = htmlspecialchars($_POST['time']);
$msg = htmlspecialchars($_POST['msg']);
// okay en dan nu de andere kant op


echo  $date, ' ', $time, ' ',$msg;
?>


