<?php 
session_start();
$title = 'panel';

if(!isset($_SESSION['idUser'])){
    header('location:../login-adm.php');
}
include('../../include/conexion.php');
$cmd = $conexion->prepare('SELECT * FROM categorias ORDER BY categoria');
$cmd->execute();
$categorias = $cmd->fetchAll();

if ($_SERVER['REQUEST_METHOD'] == 'POST'){
    $subcategoria = $_POST["subcategoria"];
    $descripcion = $_POST["descripcion-subcategoria"];
    $idCategoria = $_POST["id-categoria"];

    if (empty($subcategoria) || empty($descripcion) || empty($idCategoria)){
        $notificacion = "Error: No pueden haber campos vacíos";
    }else{
    
    
        $cmd = $conexion->prepare('INSERT INTO subcategorias( subcategoria, descripcionSub, idCategoriaPadre) VALUES (:subcategoria, :descripcion, :idCategoria)');
        $resultado = $cmd->execute(array(':subcategoria' => $subcategoria,':descripcion' => $descripcion, ':idCategoria' => $idCategoria));
        
        if($resultado){
            $notificacion = "La subcategoría ha sido dada de alta con éxito";
        }else{
            $notificacion = "Ha ocurrido un error al dar de alta la subcategoría";
        }
    
    }

}



?>

<?php include('../../include/header-adm.php'); ?>

<section class="seccion-alta py-5">
    <div class="container">
        <h2 class="titulo-seccion text-center">Alta de subcategoría</h2>
        <div class="row">
            <?php
            if(isset($notificacion)){
                echo '<p class="bg-dark text-white text-center py-3">'.$notificacion.'</p>';
            }
            ?>
            <form action="alta-subcategoria.php" method="POST" class="col-md-6 mx-auto" enctype="multipart/form-data">
                <div class="mb-3">
                    <label for="inputCategoria" class="form-label">Nombre de la nueva subcategoría</label>
                    <input type="text" class="form-control" id="inputCategoria" name="subcategoria" placeholder="Ej: Hospital Municipal">
                </div>
                <div class="mb-3">
                    <label for="inputDescripcion" class="form-label">Descripción</label>
                    <textarea name="descripcion-subcategoria" id="descripcionsubCategoria" class="form-control"></textarea>
                </div>
                <div class="mb-3">
                    <label for="categoriaPadre" >Categoría padre</label>
                    <select name="id-categoria" id="categoriaPadre" class="form-select">
                        <?php 
                            foreach ($categorias as $fila) {
                                echo '
                                <option value="'.$fila['idCategoria'].'">'.$fila['categoria'].' </option>
                                ';
                            }

                        ?>
                    </select>
                </div>
                <button type="submit" class="btn btn-success">
                    Enviar
                </button>  
            </form>
        </div>
    </div>
    
</section>



<?php include('../../include/footer-adm.php'); ?>