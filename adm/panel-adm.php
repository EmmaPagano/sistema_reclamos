<?php 
session_start();
$title = 'panel';

if(!isset($_SESSION['idUser'])){
    header('location:../index.php');
}
?>

<?php include('../include/header-adm.php'); ?>

<section class="seccion-panel py-4">
    <h2 class="text-center mb-5 text-white mt-5 pt-5">Panel administrativo</h2>
    <div class="container">
        <div class="row">
            <div class="col-md-4 text-center">
                <h3 class="mb-3 text-white">Categorías</h3>
                <div class="botonera d-flex justify-content-center">
                    <a class="btn btn-outline-secondary me-3" href="categorias/alta-categoria.php">Nuevo</a>
                    <a class="btn btn-outline-secondary ms-3" href="categorias/listar-categoria.php">Listar</a>
                </div>
            </div>
            <div class="col-md-4 text-center">
                <h3 class="mb-3 text-white">Subcategorías</h3>
                <div class="botonera d-flex justify-content-center">
                    <a class="btn btn-outline-secondary me-3" href="subcategorias/alta-subcategoria.php">Nuevo</a>
                    <a class="btn btn-outline-secondary ms-3" href="subcategorias/listar-subcategoria.php">Listar</a>
                </div>
            </div>
            <div class="col-md-4 text-center">
                <h3 class="mb-3 text-white">Reclamos</h3>
                <div class="botonera d-flex justify-content-center">
                    <a class="btn btn-outline-secondary me-3" href="">Nuevo</a>
                    <a class="btn btn-outline-secondary ms-3" href="reclamos/listar-reclamo.php">Listar</a>
                </div>
            </div>
        </div>
    </div>
</section>

<?php include('../include/footer-adm.php'); ?>