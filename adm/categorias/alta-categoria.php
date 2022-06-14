<?php 
session_start();
$title = 'panel';

if(!isset($_SESSION['idUser'])){
    header('location:../login-adm.php');
}

if ($_SERVER['REQUEST_METHOD'] == 'POST'){
    $categoria = $_POST["categoria"];
    $descripcion = $_POST["descripcion-categoria"];
    $imgPost = $_FILES['img-categoria']['tmp_name'];
    $imgName = $_FILES['img-categoria']['name'];

    if (empty($categoria) || empty($descripcion) || empty($imgPost)){
        $notificacion = "Error: No pueden haber campos vacíos";
    }else{
        include('../../include/conexion.php');
    
        $cmd = $conexion->prepare('INSERT INTO categorias( categoria, descripcion, imgCategoria) VALUES (:categoria, :descripcion, :imgCategoria)');
        $resultado = $cmd->execute(array(':categoria' => $categoria,':descripcion' => $descripcion, ':imgCategoria' => $imgName));
        
        if($resultado){
            $archivo_destino='../../img/'.$_FILES['img-categoria']['name'];
            move_uploaded_file($imgPost,$archivo_destino);
            $notificacion = "La categoría ha sido dada de alta con éxito";
        }else{
            $notificacion = "Ha ocurrido un error al dar de alta la categoría";
        }
    
    }

}



?>

<?php include('../../include/header-adm.php'); ?>

<section class="seccion-alta py-5">
    <div class="container">
        <h2 class="titulo-seccion text-center">Alta de categoría</h2>
        <div class="row">
            <?php
            if(isset($notificacion)){
                echo '<p class="bg-dark text-white text-center py-3">'.$notificacion.'</p>';
            }
            ?>
            <form action="alta-categoria.php" method="POST" class="col-md-6 mx-auto" enctype="multipart/form-data">
                <div class="mb-3">
                    <label for="inputCategoria" class="form-label">Nombre de la nueva categoría</label>
                    <input type="text" class="form-control" id="inputCategoria" name="categoria" placeholder="Ej: Deportes">
                </div>
                <div class="mb-3">
                    <label for="inputDescripcion" class="form-label">Descripción</label>
                    <textarea name="descripcion-categoria" id="descripcionCategoria" class="form-control"></textarea>
                </div>
                <div class="mb-3">
                    <label for="imgCategoria" class="form-label">Adjunte imagen de la categoría</label>
                    <input class="form-control" type="file" id="imgCategoria" name="img-categoria">
                </div>
                <button type="submit" class="btn btn-success">
                    Enviar
                </button>  
            </form>
        </div>
    </div>
    
</section>



<?php include('../../include/footer-adm.php'); ?>