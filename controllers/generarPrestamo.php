<?php
session_start();
require __DIR__ .'\..\includes\db.php';
date_default_timezone_set('America/Mexico_City');
$sql = $conn->prepare('SELECT cuenta.numCta, clientes.nom, clientes.apellidoP, clientes.apellidoM, clientes.rfc, cuenta.saldo FROM clientes INNER JOIN cuenta ON clientes.id_cliente = cuenta.id_cliente WHERE cuenta.id_cliente = :id_cliente');
$sql->bindParam(':id_cliente', $_SESSION['id_cliente']);
$sql->execute();
$infocl = $sql->fetch(PDO::FETCH_ASSOC);
$numcta = $infocl['numCta'];
$saldoOld = $infocl['saldo'];
$monto=$_POST['monto'];
$plazo=$_POST['plazo'];
//DETERMINAR INTERES
if($plazo == 6){
    $interes=3.00;
}
else if($plazo == 9)
{
    $interes=5.00;
}
else if($plazo == 12)
{
    $interes=7.00;
}
//OBTENER FECHA ACTUAL
$fechaActual = date('y-m-d');
//DETERMINAR FECHA DE TERMINO
$partesIni = explode('-', $fechaActual);
$y=$partesIni[0];
$m=$partesIni[1]+1;
if ($m<10){
    $m='0'.$m;
}
else{
    $m;
}
$d=$partesIni[2];
for($i=0; $i< $plazo; $i++){
    $m=$m+1;
    if($m >12){
        $m='1';
        $y=$y+1;
    }
    if ($m<10 and $m>0){
        $m = '0'.$m;
    }
    $fechaTermino= $y.'-'.$m.'-'.$d;
}
//INSERTAR PRESTAMO
$insert = $conn->prepare('INSERT INTO prestamos(numCta, monto, restante, interes, fechaInicial, fechaTermino) VALUES (:numCta, :monto, :restante,:interes, :fechaInicial, :fechaTermino)');
$insert->bindParam(':numCta', $numcta);
$insert->bindParam(':monto', $monto);
$insert->bindParam(':restante', $monto);
$insert->bindParam(':interes', $interes);
$insert->bindParam(':fechaInicial', $fechaActual);
$insert->bindParam(':fechaTermino', $fechaTermino);
$insert->execute();
if($insert->rowCount() > 0){
    $saldo_new = $saldoOld + $monto;
    $insertsaldo = $conn->prepare('UPDATE cuenta SET saldo = :saldo WHERE numCta = :numCta');
    $insertsaldo->bindParam(':saldo', $saldo_new);
    $insertsaldo->bindParam(':numCta', $numcta);
    $insertsaldo->execute();
    if($insertsaldo->rowCount() > 0){
        echo json_encode('ok_generado');
    }else{
        echo json_encode('error');
    }
}   
else{
    echo json_encode('error');
}
?>