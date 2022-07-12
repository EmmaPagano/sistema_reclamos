<?php 
session_start();
$title = 'panel';

if(!isset($_SESSION['idUser'])){
    header('location:../login-adm.php');
}
include("../../include/conexion.php");

if($_SERVER['REQUEST_METHOD'] == 'GET' && !empty($_GET['busqueda'])){
    $busqueda = $_GET['busqueda'];
    $filtro = $_GET['filtro'];
    if($filtro == 'numReclamo'){
        $cmd = $conexion->prepare('SELECT * FROM reclamos INNER JOIN subcategorias ON subcategorias.idSubcategoria = reclamos.idSubcategoria INNER JOIN categorias ON categorias.idCategoria = subcategorias.idCategoriaPadre INNER JOIN estados ON estados.idEstado = reclamos.idEstado WHERE idReclamo = :numReclamo ORDER BY reclamos.idEstado, reclamos.fechaReclamo');
        $cmd->execute(array(':numReclamo'=>$busqueda));
        $reclamos = $cmd->fetchAll();
    } else if($filtro == 'nombre'){
        $cmd = $conexion->prepare('SELECT * FROM reclamos INNER JOIN subcategorias ON subcategorias.idSubcategoria = reclamos.idSubcategoria INNER JOIN categorias ON categorias.idCategoria = subcategorias.idCategoriaPadre INNER JOIN estados ON estados.idEstado = reclamos.idEstado WHERE nombreVecino LIKE :busqueda ORDER BY reclamos.idEstado, reclamos.fechaReclamo');
        $cmd->execute(array(':busqueda'=>'%'.$busqueda.'%'));
        $reclamos = $cmd->fetchAll();
    } else {
        $cmd = $conexion->prepare('SELECT * FROM reclamos INNER JOIN subcategorias ON subcategorias.idSubcategoria = reclamos.idSubcategoria INNER JOIN categorias ON categorias.idCategoria = subcategorias.idCategoriaPadre INNER JOIN estados ON estados.idEstado = reclamos.idEstado WHERE categoria LIKE :busqueda ORDER BY reclamos.idEstado, reclamos.fechaReclamo');
        $cmd->execute(array(':busqueda'=>'%'.$busqueda.'%'));
        $reclamos = $cmd->fetchAll();
    }

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
            <form action="listar-reclamo.php" method="GET" class="mt-3 d-flex justify-content-center flex-wrap">
                <div class="mb-3 text-center w-100">
                    <input type="text" name="busqueda" placeholder='Ingrese su búsqueda' class="p-1" value="<?php echo (isset($busqueda)) ? $busqueda : '' ?>">
                    <button type="submit" class="btn btn-primary">Buscar</button>
                </div>
                <div class="form-check form-check-inline text-center">
                    <input class="form-check-input" type="radio" name="filtro" id="flexRadioDefault1" value="numReclamo" <?php echo ((isset($filtro) && $filtro == 'numReclamo') || !isset($filtro)) ? 'checked' : '' ?>>
                    <label class="form-check-label" for="flexRadioDefault1">
                        N° de reclamo
                    </label>
                </div>
                <div class="form-check form-check-inline text-center">
                    <input class="form-check-input" type="radio" name="filtro" id="flexRadioDefault2" value="nombre" <?php echo (isset($filtro) && $filtro == 'nombre') ? 'checked' : '' ?>>
                    <label class="form-check-label" for="flexRadioDefault2">
                        Nombre del vecino
                    </label>
                </div>
                <div class="form-check form-check-inline text-center">
                    <input class="form-check-input" type="radio" name="filtro" id="flexRadioDefault1" value="categoria" <?php echo (isset($filtro) && $filtro == 'categoria') ? 'checked' : '' ?>>
                    <label class="form-check-label" for="flexRadioDefault1">
                        Categoría
                    </label>
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
                        <td>'. date("d/m/Y", strtotime($fila["fechaReclamo"])) .'</td>
                        <td>'.$fila["nombreVecino"].'</td>
                        <td>'.$fila["telefonoVecino"].'</td>
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