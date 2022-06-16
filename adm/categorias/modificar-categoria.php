<?php 
session_start();
$title = 'panel';

if(!isset($_SESSION['idUser'])){
    header('location:../login-adm.php');
}

include('../../include/conexion.php');

if(isset($_GET['id'])){
    $idCategoria = $_GET['id'];
    $cmd = $conexion->prepare('SELECT * FROM categorias WHERE idCategoria = :id');
    $cmd->execute(array(':id'=>$idCategoria));
    $categoria = $cmd->fetch();
    $categoriaNombre = $categoria['categoria'];
    $descripcion = $categoria['descripcion'];
    $imgActual = $categoria['imgCategoria'];
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
            <form action="modificar-categoria.php" method="POST" class="col-md-6 mx-auto" enctype="multipart/form-data">
                <input type="hidden" name="idCategoria" value="<?php echo $idCategoria;?>">
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