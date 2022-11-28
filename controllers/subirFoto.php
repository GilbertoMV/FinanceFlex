<?php
require __DIR__ .'\..\includes\db.php';
session_start();
$upload_dir = '../uploads';
$post_img = $_FILES['foto']['name'];
$imgTmp = $_FILES['foto']['tmp_name'];
$imgSize = $_FILES['foto']['size'];
$longitud = 10;
$newName= substr( md5(microtime()), 1, $longitud);
$explode = explode('.', $post_img);
$ext = array_pop($explode);
$photo = $newName.'.'.$ext;
$ruta=$upload_dir.'/'.$photo;
$imgExt = strtolower(pathinfo($photo, PATHINFO_EXTENSION));
$allowExt = array('jpeg', 'jpg', 'png', 'gif', 'jfif');
if(in_array($imgExt, $allowExt)){
    if($imgSize < 5000000){
            move_uploaded_file($imgTmp,$upload_dir.'/'.$photo);
            $records = $conn->prepare("UPDATE clientes SET foto = :image WHERE id_cliente = :id_cliente");
            $records->bindParam(':image', $ruta);
            $records->bindParam(':id_cliente', $_SESSION['id_cliente']);
            $records->execute();
            if($records->rowCount() > 0){
                echo json_encode('ok');
            }else{
                echo json_encode ('error');
            }
        }else{
            echo json_encode ('larga');
        }
    }else{
        echo json_encode ('formato');
    }


?> 