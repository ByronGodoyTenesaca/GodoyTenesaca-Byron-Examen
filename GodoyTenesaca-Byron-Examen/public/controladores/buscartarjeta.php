<?php
 //incluir conexión a la base de datos
    include "../../config/conexionBD.php";
    $tarjeta = $_GET['entrada'];
 //echo "Hola " . $cedula;

    $sql = "SELECT * FROM tarjeta WHERE tarjeta.tar_numero='$tarjeta' ";
//cambiar la consulta para puede buscar por ocurrencias de letras
    $result = $conn->query($sql);

    echo " <table style='width:90%'>
    <tbody>
    <tr>
        <td>Numero</td>
        <td>Nombre</td>
        <td>Fecha de Caducidad</td>
        <td>CVV</td>
    </tr>";
    if ($result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {

        echo "<tr>";
        echo " <td>" . $row['tar_numero'] . "</td>";
        echo " <td>" . $row['tar_nombre'] . "</td>";
        echo " <td>" . $row['tar_fecha_caducidad'] ."</td>";
        echo " <td>" . $row['cvv'] . "</td>";
        echo "</tr>";
        }

        // echo "<tr>";
        // echo " <td colspan="2"> Total</td>";
        // echo " <td>" . $row['ped_total'] ."</td>";
        // echo "</tr>";
    } else {
        echo "<tr>";
        echo " <td colspan='4'> No existen la tarjeta en el sistema".$sql."</td>";
        echo "</tr>";
    }
    echo "</table>";
    $conn->close();

?>