<?php
session_start();

$conn = mysqli_connect(
    'localhost',
    'root',
    '',
    'db_website'
);
//Check if post isset
if (isset($_POST['submit'])) {
    $email = $_POST['email'];
    $password = $_POST['password'];

    $hashedpass = hash('sha3-512', $password);
    $getpass = mysqli_fetch_assoc(mysqli_query($conn, "SELECT password FROM pass WHERE username = '$email'"));
    $sqlpass= $getpass['password'];

    if ($email == "" || $password == "") {
        $error = "Vul beide gegevens in";
    } elseif ($hashedpass != $sqlpass) {
        $error = "Combinatie gebruikersnaam/wachtwoord onjuist";
    }
    if (!isset($error)) {
        $_SESSION['login'] = true;
        $_SESSION['username'] = $email;
    }
}
mysqli_close($conn);

//Am I logged in? Please go to secure page
if (isset($_SESSION['login'])) {
    header("Location: adminpage.php");
    exit;
}
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
        <label for="email">E-mail:</label>
        <input id="email" type="email" name="email"/>
    </div>
    <div>
        <label for="password">Wachtwoord:</label>
        <input id="password" type="password" name="password"/>
    </div>
    <div class = button>
        <input type="submit" name="submit" value="Login"/>
    </div>
</form>
<a href="main.php">terug</a>
</body>
</html>
