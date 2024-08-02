
<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $host = $_POST['host'];
    $dbname = $_POST['dbname'];
    $username = $_POST['username'];
    $password = $_POST['password'];
    
    $configContent = "<?php\n";
    $configContent .= "define('DB_HOST', '$host');\n";
    $configContent .= "define('DB_NAME', '$dbname');\n";
    $configContent .= "define('DB_USER', '$username');\n";
    $configContent .= "define('DB_PASSWORD', '$password');\n";
    
    file_put_contents('config.php', $configContent);
    
    echo "Configuración guardada correctamente. Ahora puedes conectar a la base de datos usando los datos proporcionados.";
    header("Location: index.html");
}
?>
