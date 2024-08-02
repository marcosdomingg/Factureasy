<?php

require 'db_connect.php'; // Archivo donde conectas a la base de datos

if ($mysqli->connect_error) {
    die('Error de conexión (' . $mysqli->connect_errno . ') ' . $mysqli->connect_error);
}

$query = "SELECT c.id, c.nombre, GROUP_CONCAT(a.nombre SEPARATOR ', ') AS articulos, c.comentarios, c.total
          FROM cliente_articulos ca
          JOIN clientes c ON ca.cliente_id = c.id
          JOIN articulos a ON ca.articulo_id = a.id
          GROUP BY c.id, c.nombre, c.comentarios, c.total";

$result = $mysqli->query($query);


$mysqli->close();

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/css/output.css">
    <link rel="shortcut icon" href="/public/assets/favicon.ico">

    <title>Factureasy</title>
</head>
<body class="font-main w-full h-full bg-gradient-to-b from-main to-secondary">
<header class="flex h-20 items-center px-20 border-b border-gray-500">
        <nav class="flex w-full justify-between">
          <div>
            <object
              data="/public/assets/Factureasy.svg"
              type="image/svg+xml"
              class="w-24"
            ></object>
          </div>

          <div class="flex mr-2">
            <object
              data="/public/assets/Facture_icon.svg"
              type="image/svg+xml"
              class="w-3 mr-1"
            ></object>
            <a href="/index.html" class="text-md text-purple">Registrarse</a>
          </div>
        </nav>
      </header>

        <div class="flex justify-center">
        <table class="w-full h-screen  flex flex-col text-white ">
            <?php if($result -> num_rows > 0): ?>
            <thead class=" w-auto py-3 border-b border-gray-500">
                <tr class="flex w-full items-center ">
                    <th class="w-1/5 text-center">ID</th>
                    <th class="w-1/5 text-center">Nombre</th>
                    <th class="w-1/5 text-center">Articulos</th>
                    <th class="w-1/5 text-center">Comentarios</th>
                    <th class="w-1/5 text-center">Total</th>
                </tr>
            </thead>
            <tbody>
                <?php while($row = $result->fetch_assoc()):?>    
                <tr class="flex w-full items-center my-3">
                   <td class="w-1/5 text-center text-xs"><?= $row['id'] ?></td>
                   <td class="w-1/5 text-center text-xs"><?= $row['nombre'] ?></td>
                   <td class="w-1/5 text-center text-xs"><?= $row['articulos'] ?></td>
                   <td class="w-1/5 text-center text-xs"><?= $row['comentarios'] ?></td>
                   <td class="w-1/5 text-center text-xs"><?= $row['total'] ?></td>
                </tr>
                <?php endwhile ?>
                <?php else: ?>

                    <h1 class="flex justify-center items-center ">No se encontraron registros</h1>
         
                <?php endif ?>
            </tbody>
        </table>
        </div>

        <footer class="h-14 flex justify-center items-center text-white border-t ">
      <span>Programación Web - Amadis Suarez</span>
    </footer

</body>
</html>