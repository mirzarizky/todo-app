<?php

$host = "eskopi.database.windows.net";
$user = "admin123";
$pass = "nSh2Ho4O2z^X";
$db = "dicoding_db";
try {
    $conn = new PDO("sqlsrv:server = $host; Database = $db", $user, $pass);
    $conn->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );
} catch(Exception $e) {
    echo "Failed: " . $e;
}