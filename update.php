<?php
$conn = mysqli_connect(
    'localhost',
    'root',
    '',
    'db_website'
);
//Check if post isset
if (isset($_POST['submit'])) {
    $email = $_POST['email'];

    $query = "SELECT * FROM website WHERE email = '$email'";

$result = mysqli_query($conn, $query)
or die('error ' . mysqli_error($conn) . ' with query ' . $query);

$website = [];

while ($row = mysqli_fetch_assoc($result)) {
    $website [] = $row;
}}
mysqli_close($conn);

?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Login</title>
    <link rel="stylesheet" href="styling.css">
</head>
<body>
<h1>Login</h1>

<?php if (isset($error)) { ?>
    <p><?= $error; ?></p>
<?php } ?>

<form method="post" action="<?= $_SERVER['REQUEST_URI']; ?>">
    <div>
        <label for="email">E-mail</label>
        <input id="email" type="email" name="email"/>
    </div>
    <div class = button>
        <input type="submit" name="submit" value="Search"/>
    </div>
</form>
<ul>
    <?php
    if (isset($_POST['submit'])){
        foreach ($website as $website) { ?>

            <li><?= $website['date'] ?> <?= $website['message']?> <?= $website['name']?> <?= $website['email']?> <?= $website['phone']?> <form class= "bform" action="/website/updatehandler.php" method="post"><button type="submit" name="delete">verwijderen</button></form></li>
            <?php
                if (isset($_POST['delete'])){
                    $conn = mysqli_connect(
                        'localhost',
                        'root',
                        '',
                        'db_website'
                    );
                    $delete = "DELETE * FROM website WHERE 'id' = '$website('id')'";
                    $final = mysqli_query($conn, $delete)
                    or die('error ' . mysqli_error($conn) . ' with query ' . $delete);
                    mysqli_close($conn);
                }
            ?>
    <?php }} ?>
</ul>
</body>
</html>
