<?php 
    include "./conexion.php";

    if(isset($_POST['nombre'])&& isset($_POST['telefono']) 
    && isset($_POST['email']) && isset($_POST['password'])
    && isset($_POST['nivel'])){
        $carpeta="../users/";
        $nombre = $_FILES['imagen']['name'];
        $temp= explode('.',$nombre);
        $extension= end($temp);
        $nombreFinal = time().'.'.$extension;
        $password='';
        if(isset($_POST['password'])){
          if($_POST['password']!="")
          $password=$_POST['password'];
        }
        if($extension=='jpg' || $extension == 'png'){
            if(move_uploaded_file($_FILES['imagen']['tmp_name'],$carpeta.$nombreFinal)){
                $conexion->query("insert into usuario (nombre,telefono,email,password,img_perfil,nivel) values(

                    '".$_POST['nombre']."',
                    '".$_POST['telefono']."',
                    '".$_POST['email']."',
                    '".sha1($password)."',
                    '$nombreFinal',
                    '".$_POST['nivel']."'
                    
                )")or die($conexion->error);
                header("location: ../admin/usuarios.php");
            }else{
                header("location: ../admin/usuarios.php?error=Favor de subir una imagen valida");
            }
        }else{
            header("location: ../admin/usuarios.php?error=Favor de subir una imagen valida");
        }
    }else{
        header("location: ../admin/usuarios.php?error=Favor de llenar todos los campos");
    }
?>