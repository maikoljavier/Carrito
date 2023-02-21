<?php 
        include"./conexion.php";

    if(isset($_POST['nombre'])&& isset($_POST['telefono']) 
    && isset($_POST['email']) && isset($_POST['nivel'])&& isset($_POST['password'])){
        
            if($_FILES['imagen']['name']!=''){
                $carpeta="../users/";
                $nombre = $_FILES['imagen']['name'];
                $temp= explode('.',$nombre);
                $extension= end($temp);
                $nombreFinal = time().'.'.$extension;
                if($extension=='jpg' || $extension == 'png'){
                    if(move_uploaded_file($_FILES['imagen']['tmp_name'],$carpeta.$nombreFinal)){ 
                        $fila = $conexion->query('select imagen  from usuario where id='.$_POST['id']);
                        $id = mysqli_fetch_row($fila);
                        if (file_exists('../users/'.$id[0])) {
                            unlink('../users/'.$id[0]);

                        }
                        $conexion->query("update usuario set imagen ='".$nombreFinal."' where id=".$_POST['id']);
                    }
            }
        
        

    }
    $conexion->query("update usuario set 
    nombre ='".$_POST['nombre']."',
    telefono ='".$_POST['telefono']."',
    email ='".$_POST['email']."',
    password ='".$_POST['password']."',
    nivel ='".$_POST['nivel']."'
    where id=".$_POST['id']);
    header("location: ../admin/usuarios.php");

    }
?>