<?php
session_start();

error_reporting(E_ALL);
ini_set('display_errors', 1);

if (!isset($_SESSION['dbUser']) || !isset($_SESSION['dbPass']) || !isset($_SESSION['dbName'])) {
    die("Database connection details not found. Please set them through the login form.");
}

$host = $_SESSION['dbHost'];
$db = $_SESSION['dbName'];
$user = $_SESSION['dbUser'];
$pass = $_SESSION['dbPass'];

$mysqli = new mysqli($host, $user, $pass);

if ($mysqli->connect_error) {
    die('Connection failed: (' . $mysqli->connect_errno . ') ' . $mysqli->connect_error);
}

$sqlScript = "
    CREATE DATABASE IF NOT EXISTS $db;
    USE $db;

    CREATE TABLE IF NOT EXISTS articulos (
      id INT AUTO_INCREMENT PRIMARY KEY,
      nombre VARCHAR(100) NOT NULL,
      precio DECIMAL(10, 2) NOT NULL
    );

    CREATE TABLE IF NOT EXISTS clientes (
      id INT AUTO_INCREMENT PRIMARY KEY,
      nombre VARCHAR(100) NOT NULL,
      comentarios TEXT,
      total DECIMAL(10, 2) NOT NULL
    );

    CREATE TABLE IF NOT EXISTS cliente_articulos (
      id INT AUTO_INCREMENT PRIMARY KEY,
      cliente_id INT NOT NULL,
      articulo_id INT NOT NULL,
      FOREIGN KEY (cliente_id) REFERENCES clientes(id),
      FOREIGN KEY (articulo_id) REFERENCES articulos(id)
    );

    INSERT INTO articulos (nombre, precio) VALUES
    ('Manzana', 0.50),
    ('Banana', 0.30),
    ('Naranja', 0.60),
    ('Leche', 1.20),
    ('Pan', 1.00),
    ('Queso', 2.50),
    ('Cereal', 3.00),
    ('Huevos', 1.50),
    ('Yogur', 1.00),
    ('Pollo', 5.00),
    ('Carne', 7.00),
    ('Pescado', 6.50),
    ('Café', 4.00),
    ('Té', 3.50);

    CREATE TABLE IF NOT EXISTS users (
        id INT AUTO_INCREMENT PRIMARY KEY,
        username VARCHAR(50) NOT NULL UNIQUE,
        password VARCHAR(255) NOT NULL
    );
";

if ($mysqli->multi_query($sqlScript)) {
    do {
        if ($result = $mysqli->store_result()) {
            $result->free();
        }
    } while ($mysqli->more_results() && $mysqli->next_result());
} else {
    die("Error executing SQL script: " . $mysqli->error);
}

// Select the database
$mysqli->select_db($db);

// Check if the default user 'adamix' exists
$checkUser = $mysqli->prepare("SELECT id FROM users WHERE username = ?");
$defaultUsername = 'adamix';
$checkUser->bind_param("s", $defaultUsername);
$checkUser->execute();
$checkUser->store_result();

if ($checkUser->num_rows === 0) {
    // Insert default user 'adamix' with hashed password
    $defaultPassword = password_hash('pasemesolosilomeresco70', PASSWORD_DEFAULT);
    $insertUser = $mysqli->prepare("INSERT INTO users (username, password) VALUES (?, ?)");
    $insertUser->bind_param("ss", $defaultUsername, $defaultPassword);
    if ($insertUser->execute()) {
        header("Location: index.html");
    } else {
        echo "Error creating default user: " . $mysqli->error;
    }
    $insertUser->close();
} else {
    echo "Default user 'adamix' already exists.";
}

$checkUser->close();
$mysqli->close();

header("Location: index.html")
?>
