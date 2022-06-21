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
    if($filtro == 'subcategoria'){
        $cmd = $conexion->prepare('SELECT * FROM subcategorias INNER JOIN categorias ON categorias.idCategoria = subcategorias.idCategoriaPadre WHERE subcategoria LIKE :busqueda ORDER BY subcategoria');
        $cmd->execute(array(':busqueda'=> '%'.$busqueda.'%'));
        $subCategorias = $cmd->fetchAll();
    }else if($filtro == 'categoria'){
        $cmd = $conexion->prepare('SELECT * FROM subcategorias INNER JOIN categorias ON categorias.idCategoria = subcategorias.idCategoriaPadre WHERE categoria LIKE :busqueda ORDER BY subcategoria');
        $cmd->execute(array(':busqueda'=> '%'.$busqueda.'%'));
        $subCategorias = $cmd->fetchAll();
    }
}else{
    $cmd = $conexion->prepare('SELECT * FROM subcategorias INNER JOIN categorias ON categorias.idCategoria = subcategorias.idCategoriaPadre ORDER BY subcategoria');
    $cmd->execute();
    $subCategorias = $cmd->fetchAll();
}

?>

<?php include('../../include/header-adm.php'); ?>

<section class="listado-abm py-5">
    <div class="container">
        <h2 class="titulo-seccion text-center">Listado de subcategorías</h2>
        <div>
            <form action="listar-subcategoria.php" method="GET" class="mt-3 d-flex justify-content-center flex-wrap">
                <div class="mb-3 text-center w-100">
                    <input type="text" name="busqueda" placeholder='Ingrese su búsqueda' class="p-1" value="<?php echo (isset($busqueda)) ? $busqueda : '' ?>">
                    <button type="submit" class="btn btn-primary">Buscar</button>
                </div>
                <div class="form-check form-check-inline text-center">
                    <input class="form-check-input" type="radio" name="filtro" id="flexRadioDefault1" value="subcategoria" <?php echo (isset($filtro) && $filtro == 'subcategoria') ? 'checked' : '' ?>>
                    <label class="form-check-label" for="flexRadioDefault1">
                        Subcategoría
                    </label>
                </div>
                <div class="form-check form-check-inline text-center">
                    <input class="form-check-input" type="radio" name="filtro" id="flexRadioDefault2" value="categoria" <?php echo (isset($filtro) && $filtro == 'categoria') ? 'checked' : '' ?>>
                    <label class="form-check-label" for="flexRadioDefault2">
                        Categoría Padre
                    </label>
                </div>
            </form>
        </div>
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
                        <td>'.$fila["descripcionSub"].'</td>
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