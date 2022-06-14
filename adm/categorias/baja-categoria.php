<?php 
session_start();
$title = 'panel';

if(!isset($_SESSION['idUser'])){
    header('location:../login-adm.php');
}

?>

<?php include('../../include/header-adm.php'); ?>

<section class="bajas py-5">
    <div class="container">
    <h2 class="titulo-seccion text-center">Dar de baja categoría</h2>
    <div class="row">
        <form action="baja-categoria.php" method="POST" class="col-md-6 mx-auto text-center p-4 mt-4 bg-light">
            <input type="hidden" name="idCategoria">
            <p>¿Está seguro de que desea eliminar la categoría?</p>
            <button type="submit" class="btn btn-danger">Eliminar</button>

        </form>
    </div>
    </div>

</section>

<?php include('../../include/footer-adm.php'); ?>