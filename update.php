<?php


/**
 * Database connnectie het beste in een aparte file doen en deze includen in de files waar je die nodig hebt.
 * (of werken met autoloading via composer)
 *
 * include database.php
 */

// init vars
$websites = [];
$databaseConnection = null;

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
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['submit']) && isset($_POST['email'])) {
        $stmt = $databaseConnection->prepare("SELECT * FROM website WHERE email = :email");
        $stmt->execute(['email' => $_POST['email']]);
        $websites = $stmt->fetchAll(); // dit doet onderwater een fetch assoc maar zorgt ook voor query escaping
    }
}

// controle of er een delete actie is
if (isset($_GET['action']) && $_GET['action'] == 'delete' && isset($_GET['website'])) {
    $databaseConnection->query("DELETE FROM website WHERE id = " . (int) $_GET['website']);
}

?>
<!doctype html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <title>Uw afspraken</title>
        <link rel="stylesheet" href="styling.css">
    </head>
<body>
    <div class="container">
        <h1>Voer uw email in</h1>

        <?php if (isset($error)): ?>
        <p><?php echo $error; ?></p>
        <?php endif; ?>

        <?php
        // request uri uit de action gehaald omdat deze te manipuleren is en daardoor hackable.
        ?>
        <form method="post" action="">
            <div>
                <label for="email">E-mail</label>
                <input id="email" type="email" name="email"/>
            </div>
            <div class="button">
                <input type="submit" name="submit" value="Search" />
            </div>
        </form>

        <div class="list">
            <ul>
                <?php foreach ($websites as $website): ?>
                <li>
                    <span><?php echo $website['date'] ?> <?php echo $website['message']?> <?php echo $website['name']?> <?php echo $website['email']?> <?php echo $website['phone'] ?></span>
                    <a href="?action=delete&website=<?php echo $website['id']; ?>" onclick="return confirm('Weet je zeker dat je deze afspraak wilt verwijderen? Dit kan niet meer ongedaan worden gemaakt!')">verwijderen</a>
                </li>
                <?php endforeach; ?>
            </ul>
        </div>
    </div>
<a href="main.php">homepage</a>
</body>
</html>