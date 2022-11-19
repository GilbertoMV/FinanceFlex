<?php
session_start();
//include __DIR__ .'\..\error-log.php';
//error_log($_SESSION['id_ejecutivo']);

if(isset($_SESSION['id_cliente'])){
    date_default_timezone_set('America/Mexico_City');    
    $idCliente=$_SESSION['id_cliente'];
    $monto = $_POST['monto'];
    $totalMonths = $_POST['tiempo'];
    //INTERES
    if($totalMonths = 6)
    {
        $interes = 0.03;
    }
    else if($totalMonths = 9){
        $interes = 0.05;
    }
    else{
        $interes = 0.07;
    }
    //DATOS PERSONALES
    require_once __DIR__ .'\..\includes\db.php';
    $consulta1 = $conn->prepare('SELECT nom, apellidoP, apellidoM, telefono FROM clientes WHERE id_cliente = :id_cliente');
    $consulta1->bindParam(':id_cliente', $idCliente);
    $consulta1->execute();  
    $res=$consulta1->fetch(PDO::FETCH_ASSOC);

    //numCta
    $consulta1 = $conn->prepare('SELECT numCta FROM cuenta WHERE id_cliente = :id_cliente');
    $consulta1->bindParam(':id_cliente', $idCliente);
    $consulta1->execute();  
    $numcta=$consulta1->fetch(PDO::FETCH_ASSOC);
        
    //CUOTAS
    $cuota = $monto / $totalMonths;

    //MESES
    $fechaActual = date('y-m-d');
    $restante=$monto-$cuota;
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
    for($i=0; $i< $totalMonths; $i++){
        $total=$interes+$cuota;
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
$pdf->Cell(140,8,'Numero de cuenta: '.$numcta['numCta'],'B',0,'L',0);
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

$pdf->Cell(140,8,'Fecha de inicio: '.$fechaActual,'B',0,'L',0);
$pdf->SetY(120); 
$pdf->setX(10);
$pdf->Cell(140,8,'Fecha de termino: '.$fechaTermino,'B',0,'L',0);
$pdf->SetY(130); 
$pdf->setX(10);
$pdf->Cell(140,8,'Interes: '.$interes.'%','B',0,'L',0);
$pdf->SetY(140); 
$pdf->setX(10);
$pdf->Cell(140,8,'Plazo: '.$totalMonths.' meses','B',0,'L',0);
$pdf->SetY(150); 
$pdf->setX(10);
$pdf->Cell(140,8,'Capital: $'.$monto,'B',0,'L',0);
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

for($i=0; $i< $totalMonths; $i++){
    $interes_cal=$monto*$interes;
    $total=$interes_cal+$cuota;
    $pdf->Cell(31,10,$year.'-'.$month.'-'.$day,'B',0,'C',0);
    $month=$month+1;
    if($month >12){
        $month='1';
        $year=$year+1;
    }
    if ($month<10 and $month>0){
        $month = '0'.$month;
    }

    $pdf->Cell(31,10,'$'.number_format($monto,2),'B',0,'C',0);
    $pdf->Cell(31,10,'$'.number_format($cuota,2),'B',0,'C',0);
    $pdf->Cell(31,10,'$'.number_format($interes_cal,2),'B',0,'C',0);
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