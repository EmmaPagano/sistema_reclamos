<?php 
session_start();
$title = 'panel';

if(!isset($_SESSION['idUser'])){
    header('location:../login-adm.php');
}
include("../../include/conexion.php");
$cmd = $conexion->prepare('SELECT * FROM subcategorias INNER JOIN categorias ON categorias.idCategoria = subcategorias.idCategoriaPadre ORDER BY subcategoria');
$cmd->execute();
$subCategorias = $cmd->fetchAll();
?>

<?php include('../../include/header-adm.php'); ?>

<section class="listado-abm py-5">
    <div class="container">
        <h2 class="titulo-seccion text-center">Listado de subcategorías</h2>
        <div class="table-responsive">
            <table class="table table-striped">
                <thead>
                    <tr>
                    <th scope="col">Subcategoría</th>
                    <th scope="col">Descripción</th>
                    <th scope="col">Categoría Padre</th>
                    <th scope="col">Acción</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    foreach ($subCategorias as $fila) {
                        echo '                    
                        <tr>
                        <td>'.$fila["subcategoria"].'</td>
                        <td>'.$fila["descripcion"].'</td>
                        <td>'.$fila["categoria"].'</td>
                        <td>
                            <a href="baja-subcategoria.php?id='.$fila["idSubcategoria"].'" class="btn btn-danger">Eliminar</a>
                            <a href="modificar-subcategoria.php?id='.$fila["idSubcategoria"].'" class="btn btn-secondary">Modificar</a>
                        </td>
                        </tr>
                        ';
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </div>
</section>


<?php include('../../include/footer-adm.php'); ?>