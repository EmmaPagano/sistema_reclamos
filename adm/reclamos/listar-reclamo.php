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
    $cmd = $conexion->prepare('SELECT * FROM reclamos INNER JOIN subcategorias ON subcategorias.idSubcategoria = reclamos.idSubcategoria INNER JOIN categorias ON categorias.idCategoria = subcategorias.idCategoriaPadre INNER JOIN estados ON estados.idEstado = reclamos.idEstado ORDER BY reclamos.idEstado, reclamos.fechaReclamo');
    $cmd->execute();
    $reclamos = $cmd->fetchAll();
}
    
?>

<?php include('../../include/header-adm.php'); ?>

<section class="listado-abm py-5">
    <div class="container">
        <h2 class="titulo-seccion text-center">Listado de reclamos</h2>
        <div>
            <form action="listar-reclamo.php" method="GET" class="mt-3">
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
                    <th scope="col">N° Reclamo</th>
                    <th scope="col">Fecha</th>
                    <th scope="col">Vecino</th>
                    <th scope="col">Teléfono</th>
                    <th scope="col">Dirección</th>
                    <th scope="col">Categoría</th>
                    <th scope="col">Motivo</th>
                    <th scope="col">Estado</th>
                    <th scope="col">Acción</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    foreach ($reclamos as $fila) {
                        echo '                    
                        <tr>
                        <td>'.$fila["idReclamo"].'</td>
                        <td>'.$fila["fechaReclamo"].'</td>
                        <td>'.$fila["nombreVecino"].'</td>
                        <td>'.$fila["telefonoVecino"].'</td>
                        <td>'.$fila["direccionReclamo"].'</td>
                        <td>'.$fila["categoria"].'</td>
                        <td>'.$fila["subcategoria"].'</td>
                        <td>'.$fila["estado"].'</td>


                        <td>
                            <a href="modificar-reclamo.php?id='.$fila["idReclamo"].'" class="btn btn-success">Ver detalle</a>
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