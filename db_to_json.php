<?php

require('./connection.php');

$sql = "SELECT * FROM productos WHERE id_product";

$result = $conn->query($sql);

$dbdata = array();

if (!$result) {
    die("Error al solicitar informacion");
} else {
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $dbdata[] = $row;
        }
    }
}

echo json_encode($dbdata);
