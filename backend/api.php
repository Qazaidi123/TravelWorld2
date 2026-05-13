<?php

$host = getenv('DB_HOST');
$dbname = getenv('DB_NAME');
$user = getenv('DB_USER');
$pass = getenv('DB_PASS');

$connected = false;

for ($i = 0; $i < 10; $i++) {

    $conn = @new mysqli($host, $user, $pass, $dbname);

    if (!$conn->connect_error) {
        $connected = true;
        break;
    }

    sleep(2);
}

if (!$connected) {
    die("Database connection failed");
}

echo "Connected to MySQL successfully!";
?>
