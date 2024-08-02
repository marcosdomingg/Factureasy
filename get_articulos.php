<?php

include 'db_connect.php'; 

$query = "SELECT id, nombre, precio FROM articulos";
$result = $mysqli->query($query);

if ($result) {
    $articulos = array();
    while ($row = $result->fetch_assoc()) {
        $articulos[] = $row;
    }
    header('Content-Type: application/json');
    echo json_encode($articulos);
} else {
    echo "Error: " . $mysqli->error;
}

$mysqli->close();
?>
