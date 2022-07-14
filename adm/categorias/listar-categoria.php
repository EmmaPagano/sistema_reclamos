<?php 
session_start();
$title = 'panel';

if(!isset($_SESSION['idUser'])){
    header('location:../login-adm.php');
}
include("../../include/conexion.php");

if($_SERVER['REQUEST_METHOD'] == 'GET' && !empty($_GET['busqueda'])){
    $busqueda = $_GET['busqueda'];
    $cmd = $conexion->prepare('SELECT * FROM categorias WHERE categoria LIKE :busqueda ORDER BY categoria;');
    $cmd->execute(array(':busqueda'=>'%'.$busqueda.'%'));
    $categorias = $cmd->fetchAll();
}else{
    $cmd = $conexion->prepare('SELECT * FROM categorias ORDER BY categoria');
    $cmd->execute();
    $categorias = $cmd->fetchAll();
}
    
?>

<?php include('../../include/header-adm.php'); ?>

<section class="listado-abm py-5">
    <div class="container">
        <h2 class="titulo-seccion text-center">Listado de categorías</h2>
        <div>
            <form action="listar-categoria.php" method="GET" class="mt-3">
                <div class="mb-3 text-center">
                    <input type="text" name="busqueda" placeholder='Ingrese su búsqueda' class="p-1" value="<?php echo (isset($busqueda)) ? $busqueda : '' ?>">
                    <button type="submit" class="btn btn-primary">Buscar</button>
                </div>
            </form>
        </div>
        <div class="table-responsive">
            <table class="table table-striped">
                <thead>
                    <tr>
                    <th scope="col" class="d-none d-md-block text-center">Imagen</th>
                    <th class="text-center" scope="col">Categoria</th>
                    <th class="text-center" scope="col">Descripción</th>
                    <th class="text-center" scope="col">Acción</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    foreach ($categorias as $fila) {
                        echo '                    
                        <tr>
                        <td class="d-none d-md-block"><img src="../../img/'.$fila["imgCategoria"].'" alt=""></td>
                        <td class="text-center"><img src="../../img/'.$fila["imgCategoria"].'" style="max-width: 30px; display:block; margin:auto" class="d-md-none">'.$fila["categoria"].'</td>
                        <td class="text-center">'.$fila["descripcion"].'</td>
                        <td class="text-center">
                            <a href="baja-categoria.php?id='.$fila["idCategoria"].'" class="btn btn-danger">Eliminar</a>
                            <a href="modificar-categoria.php?id='.$fila["idCategoria"].'" class="btn btn-secondary">Modificar</a>
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