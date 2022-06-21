<?php 
session_start();
$title = 'panel';

if(!isset($_SESSION['idUser'])){
    header('location:../login-adm.php');
}
include("../../include/conexion.php");
if(isset($_GET['id'])){
    $idSubcategoria = $_GET['id'];
    $cmd = $conexion->prepare('SELECT * FROM subcategorias WHERE idSubcategoria = :id');
    $cmd->execute(array(':id'=>$idSubcategoria));
    $subcategoria = $cmd->fetchAll();

}

if ($_SERVER['REQUEST_METHOD'] == 'POST'){
    $idSubcategoria = $_POST['idSubcategoria'];
    if(empty($idSubcategoria)){
        $notificacion = "Error: el ID no puede estar vacío";
    }  else{
        $cmd = $conexion->prepare('DELETE FROM subcategorias WHERE idSubcategoria = :id');
        $resultado = $cmd->execute(array(':id'=>$idSubcategoria));
        if($resultado){
            header("location: listar-subcategoria.php");
        } else {
            $notificacion = "Error: No se ha podido eliminar la subcategoría seleccionada";
        }
    }

}
?>

<?php include('../../include/header-adm.php'); ?>

<section class="bajas py-5">
    <div class="container">
    <h2 class="titulo-seccion text-center">Dar de baja subcategoría</h2>
    <div class="row">
            <?php
            if(isset($notificacion)){
                echo '<p class="bg-dark text-white text-center py-3">'.$notificacion.'</p>';
            }
            ?>
        <form action="baja-subcategoria.php" method="POST" class="col-md-6 mx-auto text-center p-4 mt-4 bg-light">
            <input type="hidden" name="idSubcategoria" value="<?php echo $idSubcategoria ?>">
            <p>¿Está seguro de que desea eliminar la subcategoría:<b> <?php echo $subcategoria[0]['subcategoria']; ?> </b> ?</p>
            <button type="submit" class="btn btn-danger">Eliminar</button>

        </form>
    </div>
    </div>

</section>

<?php include('../../include/footer-adm.php'); ?>