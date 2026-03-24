<?php
// =========================
// ENVIRONMENT SWITCH
// =========================
// change this to "local" or "live"
$env = "local";

// =========================
// LOCALHOST SETTINGS
// =========================
if ($env == "local") {
    $host = "localhost";
    $dbname = "lgu3productexport_db";
    $username = "root";
    $password = "";
}

// =========================
// INFINITYFREE SETTINGS
// =========================
else {
    $host = "sql308.infinityfree.com"; // <-- palitan mo from InfinityFree
    $dbname = "if0_41465468_lgu3productexport_db"; // <-- from InfinityFree
    $username = "if0_41465468"; // <-- from InfinityFree
    $password = "PjEP6W7CHxGq5S"; // <-- from InfinityFree
}

try {
    $pdo = new PDO(
        "mysql:host=$host;dbname=$dbname;charset=utf8",
        $username,
        $password
    );

    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

} catch (PDOException $e) {
    die("Database connection failed: " . $e->getMessage());
}
?>