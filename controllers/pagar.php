<?php
require __DIR__ .'\..\includes\db.php';
session_start();
$cta=$_POST['numCta'];
$monto=$_POST['mensualidad'];
$id_prestamo=$_POST['id'];
$records = $conn->prepare('SELECT saldo FROM cuenta WHERE numCta = :numCta');
$records->bindParam(':numCta', $cta);
$records->execute();
if($records->rowCount() > 0){
    $saldo = $records->fetch(PDO::FETCH_ASSOC);
    if($monto > $saldo['saldo']){
        echo json_encode('not_money');
    }else{
        $res = $conn->prepare('SELECT restante FROM prestamos WHERE id_prestamo= :id_prestamo');
        $res->bindParam(':id_prestamo', $id_prestamo);
        $res->execute();
        $restante = $res->fetch(PDO::FETCH_ASSOC);
        $new_restante = $restante['restante'] - $monto;
        $new_saldo = $saldo['saldo'] - $monto;
        if($new_restante > 1){
            $new_restante;
            $res = $conn->prepare('UPDATE prestamos SET restante = :restante WHERE id_prestamo= :id_prestamo');
            $res->bindParam(':restante', $new_restante);
            $res->bindParam(':id_prestamo', $id_prestamo);
            $res->execute();
            if($res->rowCount() > 0){
                $upd = $conn->prepare('UPDATE cuenta SET saldo = :saldo WHERE numCta= :numCta');
                $upd->bindParam(':saldo', $new_saldo);
                $upd->bindParam(':numCta', $cta);
                $upd->execute();
                if($upd->rowCount() > 0){
                    echo json_encode('ok');
                }else{
                    echo json_encode('error');
                }
            }   
            else{
                echo json_encode('error');
            }
        }else{
            $new_restante=0;
            $status=2;
            $res = $conn->prepare('UPDATE prestamos SET restante =:restante, status = :status WHERE id_prestamo= :id_prestamo');
            $res->bindParam(':restante', $new_restante);
            $res->bindParam(':status', $status);
            $res->bindParam(':id_prestamo', $id_prestamo);
            $res->execute();
            if($res->rowCount() > 0){
                $new_saldo = $saldo['saldo'] - $monto;
                $upd = $conn->prepare('UPDATE cuenta SET saldo = :saldo WHERE numCta= :numCta');
                $upd->bindParam(':saldo', $new_saldo);
                $upd->bindParam(':numCta', $cta);
                $upd->execute();
                if($upd->rowCount() > 0){
                    echo json_encode('ok');
                }else{
                    echo json_encode('error');
                }
            }   
            else{
                echo json_encode('error');
            }
        }
    }
}


            
