<?php
session_start();
//include __DIR__ .'\..\error-log.php';
//error_log($_SESSION['id_ejecutivo']);

if(isset($_SESSION['id_ejecutivo'])){
    $id=$_POST['id'];    
    $idPrestamo=$_POST['idPrestamo'];
    require_once __DIR__ .'\..\includes\db.php';
    $consulta2 = $conn->prepare('SELECT prestamos.id_prestamo, prestamos.numCta, prestamos.monto, prestamos.interes, prestamos.fechaInicial, prestamos.fechaTermino FROM prestamos INNER JOIN cuenta ON prestamos.numCta = cuenta.numCta WHERE cuenta.id_cliente = :id_cliente AND prestamos.id_prestamo= :id_prestamos');
    $consulta2->bindParam(':id_cliente', $id);
    $consulta2->bindParam(':id_prestamos', $idPrestamo);
    $consulta2->execute();
    $prestamos = $consulta2->fetch(PDO::FETCH_ASSOC);

    $consulta1 = $conn->prepare('SELECT nom, apellidoP, apellidoM, telefono FROM clientes WHERE id_cliente = :id_cliente');
    $consulta1->bindParam(':id_cliente', $id);
    $consulta1->execute();  
    $res=$consulta1->fetch(PDO::FETCH_ASSOC);

    
    //MESES
    $conMonts=$conn->prepare('SELECT TIMESTAMPDIFF(MONTH, fechaInicial, fechaTermino) AS total from prestamos where id_prestamo= :id_prestamo');
    $conMonts->bindParam(':id_prestamo', $idPrestamo);
    $conMonts->execute();
    $totalMonths=$conMonts->fetch(PDO::FETCH_ASSOC);

    //CUOTAS
    $cuota = $prestamos['monto'] / $totalMonths['total'];


require '../public/FPDF/fpdf.php';
$pdf = new FPDF();
$pdf->AddPage();
$pdf->SetFont('Helvetica','B',20,);
$pdf->setXY(60,20);
$pdf->Cell(100,8,'DETALLES DEL PRESTAMO',0,0,'C',0);
$pdf->Image('../public/img/logo_transparent-white.png',20,15,20,20);
$pdf->setXY(30,60);
$pdf->SetY(50); 
$pdf->SetFont('Helvetica','B',10);
$pdf->SetDrawColor(68,114,196);
$pdf->SetTextColor(68,114,196);
$pdf->Cell(140,8,'DATOS DEL CLIENTE','B',0,'C',0);
$pdf->SetY(60); 
$pdf->setX(10);
$pdf->SetDrawColor(89,89,89);
$pdf->SetTextColor(89,89,89);
$pdf->Cell(140,8,'Nombre: '.' '.$res['nom'].' '.$res['apellidoP'].' '.$res['apellidoM'],'B',0,'L',0);
$pdf->SetY(70); 
$pdf->setX(10);
$pdf->Cell(140,8,'Numero de cuenta: '.$prestamos['numCta'],'B',0,'L',0);
$pdf->SetY(80); 
$pdf->setX(10);
$pdf->Cell(140,8,'Telefono: '.$res['telefono'],'B',0,'L',0);
$pdf->SetFillColor(233,229,235);
$pdf->SetDrawColor(181,14,246);

$pdf->SetY(100); 
$pdf->SetFont('Helvetica','B',10);
$pdf->SetDrawColor(68,114,196);
$pdf->SetTextColor(68,114,196);
$pdf->Cell(140,8,'DATOS DEL PRESTAMO','B',0,'C',0);
$pdf->SetY(110); 
$pdf->setX(10);
$pdf->SetDrawColor(89,89,89);
$pdf->SetTextColor(89,89,89);
$pdf->Cell(140,8,'Fecha de inicio: '.$prestamos['fechaInicial'],'B',0,'L',0);
$pdf->SetY(120); 
$pdf->setX(10);
$pdf->Cell(140,8,'Fecha de termino: '.$prestamos['fechaTermino'],'B',0,'L',0);
$pdf->SetY(130); 
$pdf->setX(10);
$pdf->Cell(140,8,'Interes: '.$prestamos['interes'].'%','B',0,'L',0);
$pdf->SetY(140); 
$pdf->setX(10);
$pdf->Cell(140,8,'Plazo: '.$totalMonths['total'].' meses','B',0,'L',0);
$pdf->SetY(150); 
$pdf->setX(10);
$pdf->Cell(140,8,'Capital: '.$prestamos['monto'],'B',0,'L',0);
$pdf->SetDrawColor(68,114,196);
$pdf->SetTextColor(68,114,196);
$pdf->Ln(7.8);
$pdf->SetY(180); 
$pdf->Cell(190,10,'TABLA DE AMORTIZACION','B',0,'C',0);
$pdf->SetDrawColor(89,89,89);
$pdf->SetTextColor(89,89,89);
$pdf->SetY(190); 
$pdf->setX(10);
$pdf->Cell(31,10,'Fecha','B',0,'C',0);
$pdf->Cell(31,10,'Saldo incial','B',0,'C',0);
$pdf->Cell(31,10,'Cuota','B',0,'C',0);
$pdf->Cell(31,10,'Interes','B',0,'C',0);
$pdf->Cell(31,10,'Pago total','B',0,'C',0);
$pdf->Cell(31,10,'Saldo restante','B',0,'C',0);
$pdf->SetY(200);
$restante=$prestamos['monto']-$cuota;
$monto=$prestamos['monto'];
$iniFe=$prestamos['fechaInicial'];
$finFe=$prestamos['fechaTermino'];
$partesIni = explode('-', $iniFe);
$y=$partesIni[0];
$m=$partesIni[1]+1;
$m='0'.$m;
$d=$partesIni[2];
for($i=0; $i< $totalMonths['total']; $i++){
    $interes=$monto*0.04;
    $total=$interes+$cuota;
    $pdf->Cell(31,10,$y.'-'.$m.'-'.$d,'B',0,'C',0);
    $m=$m+1;
    if($m >12){
        $m='1';
        $y=$y+1;
    }
    if ($m<10 and $m>0){
        $m = '0'.$m;
    }

    $pdf->Cell(31,10,'$'.number_format($monto,2),'B',0,'C',0);
    $pdf->Cell(31,10,'$'.number_format($cuota,2),'B',0,'C',0);
    $pdf->Cell(31,10,'$'.number_format($interes,2),'B',0,'C',0);
    $pdf->Cell(31,10,'$'.number_format($total,2),'B',0,'C',0);
    $pdf->Cell(31,10,'$'.number_format($restante,2),'B',0,'C',0);
    $monto=$restante;
    $restante=$restante-$cuota;
    if($restante > 1){
        $restante;
    }
    else{
        $restante=0;
    }
    $pdf->Ln();
}
$pdf->Output();
?>
<?php
}else{
    header('Location:../login.php');
}