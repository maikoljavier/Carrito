<?php 
include"./conexion.php";

$fila = $conexion->query('select nombre from usuario where id='.$_POST['id']);
$id = mysqli_fetch_row($fila);
if (file_exists('../users/'.$id[0])) {
    unlink('../users/'.$id[0]);

}

$conexion->query("delete from usuario where id= ".$_POST['id']);
echo 'Listo';

?>