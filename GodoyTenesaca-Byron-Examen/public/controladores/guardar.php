<?php
    session_start();
    include '../../config/conexionBD.php';

    $nombre=$_POST['nombre'];
    $tarjeta=$_POST['tarjeta'];
    $observacion=$_POST['observacion'];
    date_default_timezone_set("America/Guayaquil");
    $fecha= date('Y-m-d H:i:s',time());
    $total=$_POST['total'];
    $sql1="SELECT tar_codigo FROM tarjeta WHERE tar_numero='$tarjeta'";
    $result=$conn->query($sql1);
    while($row = $result->fetch_assoc()) {
    $res=$row['tar_codigo'];
    }

    $sql2="INSERT INTO pedido VALUES(0,'$fecha','$nombre',$total,'$observacion',$res)";

    if($conn->query($sql2) == TRUE){
        $cuenta=0;
        $sql3="select max(ped_codigo) from pedido";
        $result=$conn->query($sql3);
        while($row = $result->fetch_assoc()) {
            $cuenta=$row['max(ped_codigo)'];
        }
        
        if(isset($_SESSION['carrito'])){
            $arreglo=$_SESSION['carrito'];
        }else{
            echo 'no vale';
        }

        for($i=0;$i<count($arreglo);$i++){
            $num=$arreglo[$i]['Id'];

            $sql4="INSERT INTO comida_pedido VALUES($num,$cuenta)";
            if($conn->query($sql4) == FALSE){
                echo "<p> Error: ".$sql4."</p>";
                break;
            }
        }
        session_destroy();
        header("location: ../vista/index.php");
    }else{
        echo "<p> Error: ".$sql1." /////".$sql2." nombre: ".$nombre." 
        tarjeta ". $tarjeta."</p>";
    }

    $conn->close();

    // include '../../config/conexionBD.php';

	// if ($_SERVER["REQUEST_METHOD"] == "POST") {
		
    //     $nombre=$_POST['nombre'];
    //     $tarjeta=$_POST['tarjeta'];
    //     $observacion=$_POST['observacion'];
    //     date_default_timezone_set("America/Guayaquil");
    //     $fecha= date('Y-m-d H:i:s',time());
	// 	echo "<p> Error: ///// nombre: ".$nombre." 
    //     tarjeta ". $tarjeta." total </p>";
	// }else{
	// 	echo 'Ha ocurrido un error';
	// }

?>