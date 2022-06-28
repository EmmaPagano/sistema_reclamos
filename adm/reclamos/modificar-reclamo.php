<?php 
session_start();
$title = 'panel';

if(!isset($_SESSION['idUser'])){
    header('location:../login-adm.php');
}

include('../../include/conexion.php');

//Carga de categorías base de datos
$cmd = $conexion->prepare('SELECT * FROM categorias ORDER BY categoria');
$cmd->execute();
$categorias = $cmd->fetchAll();

//Carga de subcategorías base de datos
$cmd = $conexion->prepare('SELECT * FROM subcategorias ORDER BY subcategoria');
$cmd->execute();
$subcategorias = $cmd->fetchAll();

//Carga de estados base de datos
$cmd = $conexion->prepare('SELECT * FROM estados ORDER BY idEstado');
$cmd->execute();
$estados = $cmd->fetchAll();

if(isset($_GET['id'])){
    $idReclamo = $_GET['id'];
    $cmd = $conexion->prepare('SELECT * FROM reclamos INNER JOIN subcategorias ON subcategorias.idSubcategoria = reclamos.idSubcategoria INNER JOIN categorias ON categorias.idCategoria = subcategorias.idCategoriaPadre INNER JOIN estados ON estados.idEstado = reclamos.idEstado WHERE idReclamo = :id ORDER BY reclamos.idEstado, reclamos.fechaReclamo;');
    $cmd->execute(array(':id'=>$idReclamo));
    $reclamo = $cmd->fetch();
    $idSubcategoria = $reclamo['idSubcategoria'];
    $fechaReclamo = $reclamo['fechaReclamo'];
    $nombreVecino = $reclamo['nombreVecino'];
    $dni = $reclamo['dni'];
    $direccionReclamo = $reclamo['direccionReclamo'];
    $telefonoVecino = $reclamo['telefonoVecino'];
    $correoVecino = $reclamo['correoVecino'];
    $idEstado = $reclamo['idEstado'];
    $estado = $reclamo['estado'];
    $comentario = $reclamo['comentario'];
    $idCategoria = $reclamo['idCategoria'];

    $cmd = $conexion->prepare('SELECT * FROM fotos_reclamos WHERE idReclamo = :id');
    $cmd->execute(array(':id'=>$idReclamo));
    $fotos = $cmd->fetchAll();

}

if ($_SERVER['REQUEST_METHOD'] == 'POST'){
    $idSubcategoria = $_POST['idSubcategoria'];
    $idEstado = $_POST['idEstado'];
    $idReclamo = $_POST['idReclamo'];
    $nombreVecino = $_POST['nombreVecino'];
    $dni = $_POST['dni'];
    $telefonoVecino = $_POST['telefono'];
    $correoVecino = $_POST['correo'];
    $comentario = $_POST['comentario'];
    $direccionReclamo = $_POST['direccion'];



    if (empty($idSubcategoria) || empty($idEstado) || empty($idReclamo) || empty($nombreVecino) || empty($dni) || empty($telefonoVecino) || empty($correoVecino) || empty($comentario) || empty($direccionReclamo)){
        $notificacion = "Error: No pueden haber campos vacíos";
    }else{
        if(empty($imgName)){
            $imgName = $imgActual;
        }else{
            $archivo_destino='../../img/'.$_FILES['img-categoria']['name'];
            move_uploaded_file($imgPost,$archivo_destino);
        }
    
        $cmd = $conexion->prepare('UPDATE categorias SET categoria=:categoria,descripcion=:descripcion,imgCategoria=:imgCategoria WHERE idCategoria = :id ');
        $resultado = $cmd->execute(array(':categoria' => $categoriaNombre,':descripcion' => $descripcion, ':imgCategoria' => $imgName, ':id' => $idCategoria));
        
        if($resultado){
            header("location:listar-categoria.php");
        }else{
            $notificacion = "Ha ocurrido un error al dar de alta la categoría";
        }
    
    }

}



?>

<?php include('../../include/header-adm.php'); ?>

<section class="seccion-alta py-5">
    <div class="container">
        <h2 class="titulo-seccion text-center">Detalles del reclamo</h2>
        <div class="row">
            <?php
            if(isset($notificacion)){
                echo '<p class="bg-dark text-white text-center py-3">'.$notificacion.'</p>';
            }
            ?>
            <form action="modificar-reclamo.php" method="POST" class="mx-auto row mt-4" enctype="multipart/form-data">
                <p class="text-center ">
                    N° de reclamo: <b><?php echo $idReclamo ?></b> - Estado: <b><?php echo $estado ?></b>
                </p>
                <input type="hidden" class="form-control" id="inputidReclamo" name="idReclamo"  value="<?php echo $idReclamo;?>">
                <div class="col-md-6">
                    <div class="mb-3">
                        <label for="inputNombreVecino" class="form-label">Nombre del vecino</label>
                        <input type="text" class="form-control" id="inputNombreVecino" name="nombreVecino"  value="<?php echo $nombreVecino;?>">
                    </div>
                    <div class="mb-3">
                        <label for="inputDni" class="form-label">DNI</label>
                        <input type="text" class="form-control" id="inputDni" name="dni"  value="<?php echo $dni;?>">
                    </div>
                    <div class="mb-3">
                        <label for="inputTelefono" class="form-label">Teléfono</label>
                        <input type="text" class="form-control" id="inputTelefono" name="telefono"  value="<?php echo $telefonoVecino;?>">
                    </div>
                    <div class="mb-3">
                        <label for="inputCorreo" class="form-label">Correo electrónico</label>
                        <input type="text" class="form-control" id="inputCorreo" name="correo"  value="<?php echo $correoVecino;?>">
                    </div>
                    <div class="mb-3">
                        <label for="inputComentario" class="form-label">Comentario</label>
                        <textarea name="comentario" id="inputComentario" rows="10" class="form-control"><?php echo $comentario;?></textarea>
                    </div>              
                </div>
                <div class="col-md-6">
                <div class="mb-3">
                    <label for="categoriaPadre" class="form-label" >Categoría</label>
                    <select name="idCategoria" id="categoriaPadre" class="form-select">
                        <?php 
                            foreach ($categorias as $fila) {
                                if($fila['idCategoria']==$idCategoria){
                                    echo '
                                    <option value="'.$fila['idCategoria'].'" selected>'.$fila['categoria'].' </option>
                                    ';
                                }else{
                                    echo '
                                    <option value="'.$fila['idCategoria'].'">'.$fila['categoria'].' </option>
                                    ';
                                }

                            }

                        ?>
                    </select>
                </div>
                <div class="mb-3">
                    <label for="inputMotivo" class="form-label" >Motivo</label>
                    <select name="idSubcategoria" id="inputMotivo" class="form-select">
                        <?php 
                            foreach ($subcategorias as $fila) {
                                if($fila['idSubcategoria']==$idSubcategoria){
                                    echo '
                                    <option value="'.$fila['idSubcategoria'].'" selected>'.$fila['subcategoria'].' </option>
                                    ';
                                }else{
                                    echo '
                                    <option value="'.$fila['idSubcategoria'].'">'.$fila['subcategoria'].' </option>
                                    ';
                                }

                            }

                        ?>
                    </select>
                </div>
                    <div class="mb-3">
                        <label for="inputDireccion" class="form-label" class="form-label">Dirección reclamo</label>
                        <input type="text" class="form-control" id="inputDireccion" name="direccion"  value="<?php echo $direccionReclamo;?>">
                    </div>
                    <div class="mb-3">
                    <label for="inputEstado" class="form-label" >Estado</label>
                    <select name="idEstado" id="inputEstado" class="form-select">
                        <?php 
                            foreach ($estados as $fila) {
                                if($fila['idEstado']==$idEstado){
                                    echo '
                                    <option value="'.$fila['idEstado'].'" selected>'.$fila['estado'].' </option>
                                    ';
                                }else{
                                    echo '
                                    <option value="'.$fila['idEstado'].'">'.$fila['estado'].' </option>
                                    ';
                                }

                            }

                        ?>
                    </select>
                </div>
                    <div class="mb-3 row">
                        <p>Fotos del reclamo:</p>
                    <?php 
                    if(!empty($fotos)){
                        foreach ($fotos as $foto) {
                            echo ' 
                            <div class="col-md-4">
                            <a class="" href="../../img/fotos_reclamos/'.$foto['urlFoto'].'" data-lightbox="galeria"><img class="img-fluid" src="../../img/fotos_reclamos/'.$foto['urlFoto'].'" alt=""></a>
                            </div>

                            ';
                        }
                    }
                    ?>

                    </div>                          
                </div>

            
                <button type="submit" class="btn btn-success mx-auto" style="max-width:160px ;">
                    Modificar
                </button>  
            </form>
        </div>
    </div>
    
</section>



<?php include('../../include/footer-adm.php'); ?>