<?php
 //incluir conexión a la base de datos
    include "../../config/conexionBD.php";
    $tarjeta = $_GET['entrada'];
 //echo "Hola " . $cedula;

    $sql = "SELECT ped_fecha, ped_total, com_nombre, com_precio_unitario FROM pedido,tarjeta,comida,comida_pedido WHERE tarjeta.tar_numero='$tarjeta' and pedido.tar_codigo = tarjeta.tar_codigo and pedido.ped_codigo=comida_pedido.ped_codigo and comida.com_codigo=comida_pedido.com_codigo";
//cambiar la consulta para puede buscar por ocurrencias de letras
    $result = $conn->query($sql);

    echo " <table style='width:100%'>
    <tbody>
    <tr>
        <td>fecha</td>
        <td>Nombre</td>
        <td>Precio Unitario</td>
    </tr>";
    if ($result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {

        echo "<tr>";
        echo " <td>" . $row['ped_fecha'] . "</td>";
        echo " <td>" . $row['com_nombre'] . "</td>";
        echo " <td>" . $row['com_precio_unitario'] ."</td>";
        echo "</tr>";
        }

        // echo "<tr>";
        // echo " <td colspan="2"> Total</td>";
        // echo " <td>" . $row['ped_total'] ."</td>";
        // echo "</tr>";
    } else {
        echo "<tr>";
        echo " <td colspan='3'> No existen pedidos registrados en el sistema".$sql."</td>";
        echo "</tr>";
    }
    echo "</table>";
    $conn->close();

?>