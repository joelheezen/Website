<?php
session_start();
if (isset($_SESSION['login']) && $_SESSION['login'] == true) {
    echo "Welcome to the member's area, " . $_SESSION['username'] . "!";
} else {
    echo "Please log in first to see this page.","<a href='/website/login.php'>Login</a>";
    exit;
}

/**
 * Database connnectie het beste in een aparte file doen en deze includen in de files waar je die nodig hebt.
 * (of werken met autoloading via composer)
 *
 * include database.php
 */

// init vars
$websites = [];
$databaseConnection = null;
$date_now = date("Y-m-d");
$date_then = (date("Y")+1).date("-m-d");
$time_now = date("H:i");
$hidden = 'display:none';

try {
    $databaseConnection = new PDO('mysql:host=localhost;dbname=db_website', 'root', '');
} catch (PDOException $e) {
    print 'Error!: ' . $e->getMessage();
    exit; // dit om de pagina te stoppen als je geen connectie hebt verkegen.
}

/**
 * Alle PHP code boven aan de pagina gezet zodat het beter leesbaar is.
 */

// controle of er een formulier gepost is
if (true) {
    if (true) {
        $stmt = $databaseConnection->prepare("SELECT * FROM website");
        $stmt->execute();
        $websites = $stmt->fetchAll(); // dit doet onderwater een fetch assoc maar zorgt ook voor query escaping
    }
}

// controle of er een delete actie is
if (isset($_GET['action']) && $_GET['action'] == 'delete' && isset($_GET['website'])) {
    $databaseConnection->query("DELETE FROM website WHERE id = " . (int) $_GET['website']);
    header("location: adminpage.php");
}
// controle of er een update actie is

if (isset($_GET['action']) && $_GET['action'] == 'update' && isset($_GET['website'])) {
    $check = $databaseConnection->query("SELECT * FROM website WHERE id = " . (int) $_GET['website']);
    $check->execute();
    $websites = $check->fetchAll();
    $hidden = '';
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Login</title>
    <link rel="stylesheet" href="styling.css">
</head>
<body>
<div class="container">

    <?php if (isset($error)): ?>
        <p><?php echo $error; ?></p>
    <?php endif; ?>

    <?php
    // request uri uit de action gehaald omdat deze te manipuleren is en daardoor hackable.
    ?>
    <div class="list">
        <ul>
            <?php foreach ($websites as $website): ?>
                <li>
                    <span><?php echo $website['date'] ?> <?php echo $website['message']?> <?php echo $website['name']?> <?php echo $website['email']?> <?php echo $website['phone'] ?></span>
                    <a href="?action=delete&website=<?php echo $website['id']; ?>" onclick="return confirm('Weet je zeker dat je deze afspraak wilt verwijderen? Dit kan niet meer ongedaan worden gemaakt!')">verwijderen</a>
                    <a href="?action=update&website=<?php echo $website['id']; ?>">update</a>
                        <form action="/website/updatehandler.php" style="<?=$hidden?>" method="post">
                            <div style="display:none">
                                <input type="number" id="id" name="id"
                                       value="<?php echo $website['id']; ?>">
                            </div>
                            <div>
                                <label for="date">Datum</label>
                                <input type="date" id="date" name="date"
                                       value= "<?= $date_now; ?>"
                                       min= "<?= $date_now; ?>" max= "<?= $date_then; ?>" required>
                            </div>
                            <div>
                                <label for="time">Tijdstip</label>
                                <input type="time" id="time" name="time"
                                       value= "<?= $time_now; ?>"
                                       min="00:00" max="23:00" step="900" required>
                            </div>
                            <div class= cbutton>
                                <button type="submit">Update</button>
                            </div>
                        </form>
                </li>
            <?php endforeach; ?>
        </ul>
        <a href="logout.php">logout</a> <a href="main.php">homepage</a>
    </div>
</div>
</body>
</html>