<?php 
session_start();
$title = 'panel';

if(!isset($_SESSION['idUser'])){
    header('location:../login-adm.php');
}
include("../../include/conexion.php");
$cmd = $conexion->prepare('SELECT * FROM categorias ORDER BY categoria');
$cmd->execute();
$categorias = $cmd->fetchAll();
?>

<?php include('../../include/header-adm.php'); ?>

<section class="listado-abm py-5">
    <div class="container">
        <h2 class="titulo-seccion text-center">Listado de categorías</h2>
        <div class="table-responsive">
            <table class="table table-striped">
                <thead>
                    <tr>
                    <th scope="col">Imagen</th>
                    <th scope="col">Categoria</th>
                    <th scope="col">Descripción</th>
                    <th scope="col">Acción</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    foreach ($categorias as $fila) {
                        echo '                    
                        <tr>
                        <td><img src="../../img/'.$fila["imgCategoria"].'" alt=""></td>
                        <td>'.$fila["categoria"].'</td>
                        <td>'.$fila["descripcion"].'</td>
                        <td>
                            <a href="baja-categoria.php?id='.$fila["idCategoria"].'" class="btn btn-danger">Eliminar</a>
                            <a href="" class="btn btn-secondary">Modificar</a>
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