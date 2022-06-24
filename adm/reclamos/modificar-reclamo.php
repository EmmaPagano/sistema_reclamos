<?php 
session_start();
$title = 'panel';

if(!isset($_SESSION['idUser'])){
    header('location:../login-adm.php');
}

include('../../include/conexion.php');

if(isset($_GET['id'])){
    $idReclamo = $_GET['id'];
    $cmd = $conexion->prepare('SELECT * FROM reclamos INNER JOIN subcategorias ON subcategorias.idSubcategoria = reclamos.idSubcategoria INNER JOIN categorias ON categorias.idCategoria = subcategorias.idCategoriaPadre INNER JOIN estados ON estados.idEstado = reclamos.idEstado WHERE idReclamo = :id ORDER BY reclamos.idEstado, reclamos.fechaReclamo;');
    $cmd->execute(array(':id'=>$idReclamo));
    $reclamo = $cmd->fetch();
    $idSubcategoria = $reclamo['idSubcategoria'];
    $fechaReclamo = $reclamo['fechaReclamo'];
    $nombreVecino = $reclamo['nombreVecino'];
    $dni = $reclamo['dni'];
    $direccionReclamo = $reclamo['direccionReclamo'];
    $telefonoVecino = $reclamo['telefonoVecino'];
    $correoVecino = $reclamo['correoVecino'];
    $idEstado = $reclamo['idEstado'];
    $comentario = $reclamo['comentario'];
    $idCategoria = $reclamo['idCategoria'];

}

if ($_SERVER['REQUEST_METHOD'] == 'POST'){
    $idCategoria = $_POST['idCategoria'];
    $categoriaNombre = $_POST["categoria"];
    $descripcion = $_POST["descripcion-categoria"];
    $imgPost = $_FILES['img-categoria']['tmp_name'];
    $imgName = $_FILES['img-categoria']['name'];
    $imgActual = $_POST['img-actual'] ;


    if (empty($categoriaNombre) || empty($descripcion)){
        $notificacion = "Error: No pueden haber campos vacíos";
    }else{
        if(empty($imgName)){
            $imgName = $imgActual;
        }else{
            $archivo_destino='../../img/'.$_FILES['img-categoria']['name'];
            move_uploaded_file($imgPost,$archivo_destino);
        }
    
        $cmd = $conexion->prepare('UPDATE categorias SET categoria=:categoria,descripcion=:descripcion,imgCategoria=:imgCategoria WHERE idCategoria = :id ');
        $resultado = $cmd->execute(array(':categoria' => $categoriaNombre,':descripcion' => $descripcion, ':imgCategoria' => $imgName, ':id' => $idCategoria));
        
        if($resultado){
            header("location:listar-categoria.php");
        }else{
            $notificacion = "Ha ocurrido un error al dar de alta la categoría";
        }
    
    }

}



?>

<?php include('../../include/header-adm.php'); ?>

<section class="seccion-alta py-5">
    <div class="container">
        <h2 class="titulo-seccion text-center">Modificar categoría</h2>
        <div class="row">
            <?php
            if(isset($notificacion)){
                echo '<p class="bg-dark text-white text-center py-3">'.$notificacion.'</p>';
            }
            ?>
            <form action="modificar-reclamo.php" method="POST" class="mx-auto row" enctype="multipart/form-data">
                <div class="col-md-6">
                    <div class="mb-3">
                        <label for="inputidReclamo" class="form-label">Nombre del vecino</label>
                        <input type="text" class="form-control" id="inputidReclamo" name="idReclamo"  value="<?php echo $idReclamo;?>">
                    </div>
                    <div class="mb-3">
                        <label for="inputidReclamo" class="form-label">DNI</label>
                        <input type="text" class="form-control" id="inputidReclamo" name="idReclamo"  value="<?php echo $idReclamo;?>">
                    </div>
                    <div class="mb-3">
                        <label for="inputidReclamo" class="form-label">Teléfono</label>
                        <input type="text" class="form-control" id="inputidReclamo" name="idReclamo"  value="<?php echo $idReclamo;?>">
                    </div>
                    <div class="mb-3">
                        <label for="inputidReclamo" class="form-label">Correo electrónico</label>
                        <input type="text" class="form-control" id="inputidReclamo" name="idReclamo"  value="<?php echo $idReclamo;?>">
                    </div>             
                </div>
                <div class="col-md-6">
                <div class="mb-3">
                        <label for="inputidReclamo" class="form-label">N° reclamo</label>
                        <input type="text" class="form-control" id="inputidReclamo" name="idReclamo"  value="<?php echo $idReclamo;?>">
                    </div>
                    <div class="mb-3">
                        <label for="inputidReclamo" class="form-label">Categoría</label>
                        <input type="text" class="form-control" id="inputidReclamo" name="idReclamo"  value="<?php echo $idReclamo;?>">
                    </div>
                    <div class="mb-3">
                        <label for="inputidReclamo" class="form-label">Motivo</label>
                        <input type="text" class="form-control" id="inputidReclamo" name="idReclamo"  value="<?php echo $idReclamo;?>">
                    </div>
                    <div class="mb-3">
                        <label for="inputidReclamo" class="form-label">Dirección reclamo</label>
                        <input type="text" class="form-control" id="inputidReclamo" name="idReclamo"  value="<?php echo $idReclamo;?>">
                    </div>             
                    <div class="mb-3">
                        <label for="inputidReclamo" class="form-label">Comentario</label>
                        <input type="text" class="form-control" id="inputidReclamo" name="idReclamo"  value="<?php echo $idReclamo;?>">
                    </div>       
                    <div class="mb-3">
                        <label for="inputidReclamo" class="form-label">Estado</label>
                        <input type="text" class="form-control" id="inputidReclamo" name="idReclamo"  value="<?php echo $idReclamo;?>">
                    </div>       
                </div>

                <input type="hidden" name="idReclamo" value="<?php echo $idReclamo;?>">
                <div class="mb-3">
                    <label for="inputCategoria" class="form-label">Nombre de la nueva categoría</label>
                    <input type="text" class="form-control" id="inputCategoria" name="categoria" placeholder="Ej: Deportes" value="<?php echo $categoriaNombre;?>">
                </div>
                <div class="mb-3">
                    <label for="inputDescripcion" class="form-label">Descripción</label>
                    <textarea name="descripcion-categoria" id="descripcionCategoria" class="form-control"><?php echo $descripcion;?></textarea>
                </div>
                <div class="mb-3">
                    <label for="">Imagen actual: </label>
                    <img src="../../img/<?php echo $imgActual;?>" alt="" class="d-block my-2" style="max-width:150px">
                    <label for="imgCategoria" class="form-label">Adjunte imagen de la categoría</label>
                    <input class="form-control" type="file" id="imgCategoria" name="img-categoria">
                    <input class="form-control" type="hidden" id="imgCategoria" name="img-actual" value="<?php echo $imgActual;?>" >
                </div>
                <button type="submit" class="btn btn-success">
                    Modificar
                </button>  
            </form>
        </div>
    </div>
    
</section>



<?php include('../../include/footer-adm.php'); ?>