<?php

// Configurazione del database
$host = 'localhost';
$username = 'root';
$password = '';
$database = 'ciné-critique';

try {
    // Connessione al database
    $conn = new PDO("mysql:host=$host;dbname=$database", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch(PDOException $e) {
    // Gestione degli errori di connessione
    die("Database connection failed: " . $e->getMessage());
}

?>
