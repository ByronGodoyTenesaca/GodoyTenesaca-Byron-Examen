<?php
 //incluir conexión a la base de datos
    include "../../config/conexionBD.php";
    $comida = $_GET['entrada'];
 //echo "Hola " . $cedula;

    $sql = "SELECT ped_fecha, com_nombre, com_precio_unitario, tar_numero, ped_cliente FROM pedido,tarjeta,comida,comida_pedido WHERE comida.com_nombre='$comida' and pedido.ped_codigo=comida_pedido.ped_codigo and comida.com_codigo=comida_pedido.com_codigo and tarjeta.tar_codigo=pedido.tar_codigo";
//cambiar la consulta para puede buscar por ocurrencias de letras
    $result = $conn->query($sql);
    echo "<h2>listado por comida o platos</h2>";
    echo " <table style='width:100%'>
    <tbody>
    <tr>
        <td>numero tarjeta</td>
        <td>fecha</td>
        <td>Plato</td>
        <td>Cliente</td>
        <td>Precio Unitario</td>
    </tr>";
    if ($result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {

        echo "<tr>";
        echo " <td>" . $row['tar_numero'] . "</td>";
        echo " <td>" . $row['ped_fecha'] . "</td>";
        echo " <td>" . $row['com_nombre'] . "</td>";
        echo " <td>" . $row['ped_cliente'] . "</td>";
        echo " <td>" . $row['com_precio_unitario'] ."</td>";
        echo "</tr>";
        }

        // echo "<tr>";
        // echo " <td colspan="2"> Total</td>";
        // echo " <td>" . $row['ped_total'] ."</td>";
        // echo "</tr>";
    } else {
        echo "<tr>";
        echo " <td colspan='5'> No existen pedidos registrados en el sistema</td>";
        echo "</tr>";
    }
    echo "</table>";
    $conn->close();

?>