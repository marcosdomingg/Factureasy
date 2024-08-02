<?php
session_start();
require 'db_connect.php'; // Archivo donde conectas a la base de datos


// Verifica si las variables POST están definidas
if (isset($_POST["nombre"], $_POST["comentarios"], $_POST["total"], $_POST["articulos"])) {
    $nombre = htmlspecialchars($_POST["nombre"]);
    $comentarios = htmlspecialchars($_POST["comentarios"]);
    $total = htmlspecialchars($_POST["total"]);
    
    // Recoge los IDs de los artículos seleccionados
    $articulos = $_POST["articulos"];
    $articulos_ids = array_map('intval', $articulos);  // Asegúrate de que todos los valores sean enteros

    // Inserta el cliente en la tabla clientes
    $sql_cliente = "INSERT INTO clientes (nombre, comentarios, total) VALUES ('$nombre', '$comentarios', '$total')";

    if ($mysqli->query($sql_cliente) === TRUE) {
        $cliente_id = $mysqli->insert_id;

        // Inserta los artículos seleccionados en la tabla cliente_articulos
        foreach ($articulos_ids as $articulo_id) {
            $sql_articulos = "INSERT INTO cliente_articulos (cliente_id, articulo_id) VALUES ($cliente_id, $articulo_id)";
            if (!$mysqli->query($sql_articulos)) {
                echo "Error: " . $mysqli->error;
                exit;
            }
        }
        
        header("Location: recibos.php");
        exit;
    } else {
        echo "Error: " . $mysqli->error;
    }
} else {
    echo "Error: Datos del formulario no completos.";
}

$mysqli->close();

?>
