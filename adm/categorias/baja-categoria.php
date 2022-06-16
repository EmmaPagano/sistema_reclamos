<?php 
session_start();
$title = 'panel';

if(!isset($_SESSION['idUser'])){
    header('location:../login-adm.php');
}
include("../../include/conexion.php");
if(isset($_GET['id'])){
    $idCategoria = $_GET['id'];
    $cmd = $conexion->prepare('SELECT * FROM categorias WHERE idCategoria = :id');
    $cmd->execute(array(':id'=>$idCategoria));
    $categoria = $cmd->fetchAll();

}

if ($_SERVER['REQUEST_METHOD'] == 'POST'){
    $idCategoria = $_POST['idCategoria'];
    if(empty($idCategoria)){
        $notificacion = "Error: el ID no puede estar vacío";
    }  else{
        $cmd = $conexion->prepare('DELETE FROM categorias WHERE idCategoria = :id');
        $resultado = $cmd->execute(array(':id'=>$idCategoria));
        if($resultado){
            header("location: listar-categoria.php");
        } else {
            $notificacion = "Error: No se ha podido eliminar la categoría seleccionada";
        }
    }

}
?>

<?php include('../../include/header-adm.php'); ?>

<section class="bajas py-5">
    <div class="container">
    <h2 class="titulo-seccion text-center">Dar de baja categoría</h2>
    <div class="row">
            <?php
            if(isset($notificacion)){
                echo '<p class="bg-dark text-white text-center py-3">'.$notificacion.'</p>';
            }
            ?>
        <form action="baja-categoria.php" method="POST" class="col-md-6 mx-auto text-center p-4 mt-4 bg-light">
            <input type="hidden" name="idCategoria" value="<?php echo $idCategoria ?>">
            <p>¿Está seguro de que desea eliminar la categoría:<b> <?php echo $categoria[0]['categoria']; ?> </b> ?</p>
            <button type="submit" class="btn btn-danger">Eliminar</button>

        </form>
    </div>
    </div>

</section>

<?php include('../../include/footer-adm.php'); ?>