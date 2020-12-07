<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>index</title>
    <link rel="stylesheet" href="../css/index.css">
    <script src="../js/buscador.js" type="text/javascript"></script>
</head>
<body>
    <nav>
        <h1 id="titulo">Registro de Pedidos</h1>
        <form action="" class="buscar" onsubmit="return buscar()">
            <input id="buscador" type="text" name="buscador" placeholder="buscar" class="src" autocomplete="off">
        </form>
        <a href="../controladores/carrito.php">Carrito</a>
        <br>
        <h1></h1>
        <div id="informacion"></div>
        <h1></h1>
    </nav>
    
    <br>

        

    <section>

        <h1>Menú del dia </h1>
        <?php
        include '../../config/conexionBD.php';
        $platos='select * from comida';
        $resultado=$conn->query($platos);

        while($row = $resultado->fetch_assoc()) {
        ?>

        <div>
            <h2>plato</h2>
            <p><?php echo $row['com_nombre'];?></p>
            <h2>costo</h2>
            <p><?php echo $row['com_precio_unitario'];?>$ por unidad</p>
            <a href="../controladores/carrito.php?id=<?php echo $row['com_codigo'];?>">agregar al carrito</a>
        </div>
        <?php
        }
        //conn->close();
        ?>


        <!-- <div>
            <h1>plato</h1>
            <h2>coida tal</h2>
            <h1>costo</h1>
            <p>20$</p>
        </div>

        <div>
            <h1>plato</h1>
            <h2>coida tal</h2>
            <h1>costo</h1>
            <p>20$</p>
        </div>

        <div>
            <h1>plato</h1>
            <h2>coida tal</h2>
            <h1>costo</h1>
            <p>20$</p>
        </div> -->
    </section>


</body>
</html>