<?php
include 'db_connect.php'; 


if (isset($_POST['client_id'])) {
    $client_id = intval($_POST['client_id']);

    $query = "SELECT id, nombre FROM clientes WHERE id = $client_id";
    $result = $mysqli->query($query);

    if ($result->num_rows > 0) {
        $cliente = $result->fetch_assoc();
        echo json_encode($cliente);
    } else {
        echo json_encode(['error' => 'Cliente no encontrado']);
    }
}

$mysqli->close();

?>
