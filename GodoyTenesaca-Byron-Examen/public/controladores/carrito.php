<?php
    session_start();
    include '../../config/conexionBD.php';
    if(isset($_SESSION['carrito'])){
        if(isset($_GET['id'])){
            $arreglo=$_SESSION['carrito'];
            $encontro=false;
            $numero=0;
            for($i=0;$i<count($arreglo);$i++){
                if($arreglo[$i]['Id']==$_GET['id']){
                    $encontro=true;
                    $numero=$i;
                }
            }

            if($encontro==true){
                $arreglo[$numero]['Cantidad']=$arreglo[$numero]['Cantidad']+1;
                $_SESSION['carrito']=$arreglo;
            }else{
                $nombre="";
                $precio="";
                //si pongo imagen
                $sql="select * from comida where com_codigo=".$_GET['id'];
                //$re=mysql_query("select * from comida where id=".$_GET['id']);
                $resultado=$conn->query($sql);

                while($f = $resultado->fetch_assoc()){
                    $nombre=$f['com_nombre'];
                    $precio=$f['com_precio_unitario'];
                }
                $datosNuevos=array('Id'=>$_GET['id'],
                                'Nombre'=>$nombre,
                                'Precio'=>$precio,
                                'Cantidad'=>1);
                array_push($arreglo,$datosNuevos);
                $_SESSION['carrito']=$arreglo;
            }
        }
    }else{
        if(isset($_GET['id'])){
            $nombre="";
            $precio="";
            //si pongo imagen
            $sql="select * from comida where com_codigo=".$_GET['id'];
            //$re=mysql_query("select * from comida where id=".$_GET['id']);
            $resultado=$conn->query($sql);

            while($f = $resultado->fetch_assoc()){
                $nombre=$f['com_nombre'];
                $precio=$f['com_precio_unitario'];
            }
            $arreglo[]=array('Id'=>$_GET['id'],
                            'Nombre'=>$nombre,
                            'Precio'=>$precio,
                            'Cantidad'=>1);
            $_SESSION['carrito']=$arreglo;
        }
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Carritos de compras</title>
    <script src="https://code.jquery.com/jquery-3.5.1.min.js" type="text/javascript"></script>
    <script src="../js/ActualizacionCantidad.js" type="text/javascript"></script>
    <script src="../js/buscartarjeta.js" type="text/javascript"></script>
    <link rel="stylesheet" href="../css/carrito.css">
    
</head>
<body>
    <nav>
            <h1 id="titulo">Registro de Pedidos</h1>
            <a href="../vista/index.php">Regresar</a>
            <form action="" class="buscar" onsubmit="return buscartarjeta()">
                <input id="buscador" type="text" name="buscador" placeholder="verificar si existe la tarjeta" class="src" autocomplete="off">
            </form>
            <br>
            <div id="informacion"></div>
            <h1></h1>
    </nav>

    <section>
        <form action="guardar.php" class="cuerpo" id="formulario" method="POST">
            <h1>Formulario del Pedido</h1>
            <fieldset>
                <legend>Datos personales</legend>
                <label for="nombre">Nombre y Apellido</label>
                <input type="text" id="nombre" name="nombre" placeholder="ingrese su nombre y apellido"><br>
                <label for="tarjeta">Numero de la tarjeta</label>
                <input type="text" id="tarjeta" name="tarjeta" placeholder="ingrese el numero de su tarjeta"><br>
                <label for="observacion">Observacion</label>
                <input type="text" id="observacion" name="observacion" placeholder="ingrese su observacion">
            </fieldset>

            <fieldset>
                <legend>Productos</legend>
                <?php
                $total=0;
                if(isset($_SESSION['carrito'])){
                    $datos=$_SESSION['carrito'];
                    $total=0;
                    ?>
                    <table>
                        <tbody>
                            <tr>
                                <td>Nombre</td>
                                <td>Precio</td>
                                <td>Cantidad</td>
                                <td>Subtotal</td>
                            </tr>
                <?php
                    for($i=0;$i<count($datos);$i++){
                ?>
                    <div class='producto'>
                        <center>
                                    <tr>
                                        <td><?php echo $datos[$i]['Nombre'];?></td>
                                        <td><?php echo $datos[$i]['Precio'];?></td>
                                        <td><input type="text" readonly="readonly" value="<?php echo $datos[$i]['Cantidad'];?>" disable></td>
                                        <td><?php echo $datos[$i]['Cantidad']*$datos[$i]['Precio'];?></td>
                                    </tr>


                            <!-- <span>Nombre: <?php echo $datos[$i]['Nombre'];?></span><br>
                            <span>Precio: <?php echo $datos[$i]['Precio'];?></span> <br>
                            <span>Cantidad: <input type="text" value="<?php echo $datos[$i]['Cantidad'];?>"
                            data-precio="<?php echo $datos[$i]['Precio'];?>"
                            data-id="<?php echo $datos[$i]['Id'];?>"
                            class="cantidad">
                            </span><br>

                            <span class="subtotal">Subtotal: <?php echo $datos[$i]['Cantidad']*$datos[$i]['Precio'];?></span> -->

                        </center>
                    </div>
                
                <?php
                    $total=($datos[$i]['Cantidad']*$datos[$i]['Precio']+$total);
                
                    }
                    ?>

                    </tbody>
                    </table>
                <?php
                }else{
                    echo '<center><h2>El carrito esta vacia</h2></center>';
                }
                echo '<label id="pagar">Total a pagar</label>';
                echo '<center><input id="total" readonly="readonly" name="total" value='.$total.'></center>';

                ?>
                <input type="submit" value="Confirmar">
            </fieldset>
        </form>
    </section>
</body>
</html>