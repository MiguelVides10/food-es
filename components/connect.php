<?php

$db_name = 'mysql:host=food-db.c128asm4a2gq.us-east-1.rds.amazonaws.com;dbname=food_db';
$user_name = 'usuario_remoto';
$user_password = 'admin';

try {
    $conn = new PDO($db_name, $user_name, $user_password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch(PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
}

?>