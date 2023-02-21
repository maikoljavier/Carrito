<?php 
  session_start();
  include "../php/conexion.php";
  if (!isset($_SESSION['datos_login'])) {
    header("location: ../index.php");
  }

  $arregloUsuario =$_SESSION['datos_login'];
  if($arregloUsuario["nivel"]!=='admin'){
    header("location: ../index.php");
  }
  $resultado = $conexion ->query("
  select productos.*, categorias.nombre as catego from 
  productos 
  inner join categorias on productos.id_categoria = categorias.id
  order by id DESC")or die($conexion->error);
?> 

<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>AdminLTE 3 | Dashboard</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="./Dashboar/plugins/fontawesome-free/css/all.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  <!-- Tempusdominus Bbootstrap 4 -->
  <link rel="stylesheet" href="./Dashboar/plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css">
  <!-- iCheck -->
  <link rel="stylesheet" href="./Dashboar/plugins/icheck-bootstrap/icheck-bootstrap.min.css">
  <!-- JQVMap -->
  <link rel="stylesheet" href="./Dashboar/plugins/jqvmap/jqvmap.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="./Dashboar/dist/css/adminlte.min.css">
  <!-- overlayScrollbars -->
  <link rel="stylesheet" href="./Dashboar/plugins/overlayScrollbars/css/OverlayScrollbars.min.css">
  <!-- Daterange picker -->
  <link rel="stylesheet" href="./Dashboar/plugins/daterangepicker/daterangepicker.css">
  <!-- summernote -->
  <link rel="stylesheet" href="./Dashboar/plugins/summernote/summernote-bs4.css">
  <!-- Google Font: Source Sans Pro -->
  <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
</head>
<body class="hold-transition sidebar-mini layout-fixed">
<div class="wrapper">

<?php 
  include('./layoust/header.php')

?>
  

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">Productos</h1>
          </div><!-- /.col -->
          <div class="col-sm-6 text-right">
            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal"><i class="fa fa-plus"></i> insertar producto</button>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <table class="table">
            <thead>
                <tr>
                <th>ID</th>
                <th>Nombre</th>
                <th>Descripcion</th>
                <th>Precio</th>
                <th>inventario</th>
                <th>Categoria</th>
                <th>Talla</th>
                <th>Color</th>
                <th></th>
                </tr>
            </thead>
            <tbody>
            
            <?php 
                while($f = mysqli_fetch_array($resultado)){

                
            
            ?>
            <tr>
                <td><?php echo $f['id'];?></td>
                <td>
                    <img src="../images/<?php echo $f['imagen'];?>"  width="20px" height="20px" alt="">
                    <?php echo $f['nombre'];?>
                </td>
                <td><?php echo $f['descripcion'];?></td>
                <td><?php echo $f['precio'];?>$</td>
                <td><?php echo $f['inventario'];?></td>
                <td><?php echo $f['catego'];?></td>
                <td><?php echo $f['talla'];?></td>
                <td><?php echo $f['color'];?></td>
                <td>
                <button type="button" class="btn btn-info btn-small btnEditar" 
                    data-id="<?php echo $f['id'];?>"
                    data-nombre="<?php echo $f['nombre'];?>"
                    data-descripcion="<?php echo $f['descripcion'];?>"
                    data-inventario="<?php echo $f['inventario'];?>"
                    data-precio="<?php echo $f['precio'];?>"
                    data-categoria="<?php echo $f['id_categoria'];?>"
                    data-talla="<?php echo $f['talla'];?>"
                    data-color="<?php echo $f['color'];?>"
                    data-toggle="modal" data-target="#modalEditar">
                        <li class="fa fa-edit"></li>
                    </button>
                    <button type="button" class="btn btn-danger btn-small btnEliminar" 
                    data-id="<?php echo $f['id'];?>"
                    data-toggle="modal" data-target="#modalEliminar">
                        <li class="fa fa-trash"></li>
                    </button>

                </td>
                </tr>
                <?php 
                

                }
            
            ?>
            </tbody>
        </table>
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>
  <div class="modal fade" id="modalEditar" tabindex="-1" role="dialog" aria-labelledby="modalEditarLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
        <form action="../php/editarproducto.php" method="POST" enctype="multipart/form-data">
      <div class="modal-header">
        <h5 class="modal-title" id="modalEditarLabel">Editar producto</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <input type="hidden" id="idEdit" name="id">
        
        <div class="form-group">
            <label for="nombreEdit">Nombre</label>
            <input type="text" name="nombre" id="nombreEdit" placeholder="nombre" class="form-control"required>
        </div>
        <div class="form-group">
            <label for="descripcionEdit">Descripcion</label>
            <input type="text" name="descripcion" id="descripcionEdit" placeholder="descripcion" class="form-control"required>
        </div>
        <div class="form-group">
            <label for="imagenEdit">Imagen</label>
            <input type="file" name="imagen" id="imagenEdit" class="form-control">
        </div>
        <div class="form-group">
            <label for="precioEdit">Precio</label>
            <input type="number" min="0" name="precio" id="precioEdit" placeholder="precio" class="form-control"required>
        </div>
        <div class="form-group">
            <label for="inventarioEdit">inventario</label>
            <input type="number" min="0" name="inventario" id="inventarioEdit" placeholder="inventario" class="form-control"required>
        </div>
        <div class="form-group">
            <label for="categoriaEdit">Categoria</label>
            <select name="categoria" id="categoriaEdit" class="form-control"required>
                <?php 
                    $res=$conexion->query("select * from categorias");
                    while ($f=mysqli_fetch_array($res)) {
                        echo '<option value="'.$f['id'].'">'.$f['nombre'].'</option>';
                    }
                ?>
            </select>
        </div> 
        <div class="form-group">
            <label for="tallaEdit">Talla</label>
            <input type="text" name="talla" id="tallaEdit" placeholder="talla" class="form-control"required>
        </div>
        <div class="form-group">
            <label for="colorEdit">Color</label>
            <input type="text" name="color" id="colorEdit" placeholder="color" class="form-control" required>
        </div>
      </div>
      <div class="modal-footer">
        
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary editar">Guardar</button>
      </div>
      </form>
    </div>
  </div>
</div>

<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
        <form action="../php/insertarproducto.php" method="POST" enctype="multipart/form-data">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">insertar producto</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="form-group">
            <label for="nombre">Nombre</label>
            <input type="text" name="nombre" id="nombre" placeholder="nombre" class="form-control"required>
        </div>
        <div class="form-group">
            <label for="descripcion">Descripcion</label>
            <input type="text" name="descripcion" id="descripcion" placeholder="descripcion" class="form-control"required>
        </div>
        <div class="form-group">
            <label for="imagen">Imagen</label>
            <input type="file" name="imagen" id="imagen" class="form-control"required>
        </div>
        <div class="form-group">
            <label for="precio">Precio</label>
            <input type="number" min="0" name="precio" id="precio" placeholder="precio" class="form-control"required>
        </div>
        <div class="form-group">
            <label for="inventario">inventario</label>
            <input type="number" min="0" name="inventario" id="inventario" placeholder="inventario" class="form-control"required>
        </div>
        <div class="form-group">
            <label for="categoria">Categoria</label>
            <select name="categoria" id="categoria" class="form-control"required>
                <?php 
                    $res=$conexion->query("select * from categorias");
                    while ($f=mysqli_fetch_array($res)) {
                        echo '<option value="'.$f['id'].'">'.$f['nombre'].'</option>';
                    }
                ?>
            </select>
        </div> 
        <div class="form-group">
            <label for="talla">Talla</label>
            <input type="text" name="talla" id="talla" placeholder="talla" class="form-control"required>
        </div>
        <div class="form-group">
            <label for="color">Color</label>
            <input type="text" name="color" id="color" placeholder="color" class="form-control" required>
        </div>
      </div>
      <div class="modal-footer">
        
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary">Guardar</button>
      </div>
      </form>
    </div>
  </div>
</div>






<div class="modal fade" id="modalEliminar" tabindex="-1" role="dialog" aria-labelledby="modalEliminarLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="modalEliminarLabel">Eliminar producto</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        ¿Desea eliminar?
      <div class="modal-footer">
        
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-danger eliminar" data-dismiss="modal">Eliminar</button>
      </div>

    </div>
  </div>




  <?php 

  include "./layoust/footer.php"
  
  
  ?>
</div>
<!-- ./wrapper -->

<!-- jQuery -->
<script src="./Dashboar/plugins/jquery/jquery.min.js"></script>
<!-- jQuery UI 1.11.4 -->
<script src="./Dashboar/plugins/jquery-ui/jquery-ui.min.js"></script>
<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
<script>
  $.widget.bridge('uibutton', $.ui.button)
</script>
<!-- Bootstrap 4 -->
<script src="./Dashboar/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- ChartJS -->
<script src="./Dashboar/plugins/chart.js/Chart.min.js"></script>
<!-- Sparkline -->
<script src="./Dashboar/plugins/sparklines/sparkline.js"></script>
<!-- JQVMap -->
<script src="./Dashboar/plugins/jqvmap/jquery.vmap.min.js"></script>
<script src="./Dashboar/plugins/jqvmap/maps/jquery.vmap.usa.js"></script>
<!-- jQuery Knob Chart -->
<script src="./Dashboar/plugins/jquery-knob/jquery.knob.min.js"></script>
<!-- daterangepicker -->
<script src="./Dashboar/plugins/moment/moment.min.js"></script>
<script src="./Dashboar/plugins/daterangepicker/daterangepicker.js"></script>
<!-- Tempusdominus Bootstrap 4 -->
<script src="./Dashboar/plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js"></script>
<!-- Summernote -->
<script src="./Dashboar/plugins/summernote/summernote-bs4.min.js"></script>
<!-- overlayScrollbars -->
<script src="./Dashboar/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js"></script>
<!-- AdminLTE App -->
<script src="./Dashboar/dist/js/adminlte.js"></script>
<!-- AdminLTE dashboard demo (This is only for demo purposes) -->
<script src="./Dashboar/dist/js/pages/dashboard.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="./Dashboar/dist/js/demo.js"></script>

<script>
    $(document).ready(function(){
        var idEliminar =-1;
        var idEditar=-1;
        var fila;
        $(".btnEliminar").click(function(){
            idEliminar=($(this).data('id'));
            fila=$(this).parent('td').parent('tr');
        });
        $(".eliminar").click(function(){
            $.ajax({
                url: '../php/eliminarproducto.php',
                method:'POST',
                data:{
                    id:idEliminar
                }
            }).done(function(res){
                $(fila).fadeOut(1000);
            });
           
        });
        $(".btnEditar").click(function(){
          idEditar=$(this).data('id');
          var nombre=$(this).data('nombre');
          var descripcion=$(this).data('descripcion');
          var inventario=$(this).data('inventario');
          var categoria=$(this).data('categoria');
          var talla =$(this).data('talla');
          var color=$(this).data('color');
          var precio=$(this).data('precio');
          $("#nombreEdit").val(nombre); 
          $("#descripcionEdit").val(descripcion); 
          $("#inventarioEdit").val(inventario); 
          $("#categoriaEdit").val(categoria); 
          $("#tallaEdit").val(talla); 
          $("#colorEdit").val(color); 
          $("#precioEdit").val(precio);
          $("#idEdit").val(idEditar);
          
          
        });
    });
</script>
</body>
</html>
