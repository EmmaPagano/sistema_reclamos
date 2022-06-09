<?php 
session_start();

$title = 'login';


if(!empty($_SESSION['idUser'])){
    header('location:panel-adm.php');
}

$notificacion = "";
$error = "";
if($_SERVER['REQUEST_METHOD'] == "POST"){

    $correo = strtolower($_POST['correo']);
    $password = $_POST['password'];

    if(empty($correo) || empty($password)){
        $notificacion = "Por favor rellene todos los campos";
        $error = true;
    }else{
        include('../include/conexion.php');
        /* SELECCIONO EL USUARIO SEGUN EL USERNAME QUE INGRESO EL CLIENTE */
        $cmd = $conexion->prepare('SELECT * FROM usuarios WHERE correo = :correo');
        $cmd->execute(array(':correo'=>$correo));
        $resultado = $cmd->fetch();
        if(!$resultado){
            $notificacion = "El usuario ingresado es incorrecto";
            $error = true;
        }else{
            $cmd = $conexion->prepare('SELECT * FROM usuarios WHERE correo = :correo AND password = :pass');
            $cmd->execute(array(':correo'=>$correo,':pass'=>$password));
            $resultado = $cmd->fetch();
            if($resultado){
                $_SESSION['idUser'] = $resultado['idUsuario'];
                header('Location:panel-adm.php');
            }else{
                $notificacion = "La contraseña ingresada es incorrecta.";
                $error = true;
            }
        }
    }

}
?>

<?php include('../include/header-adm.php'); ?>

<section class="login-container py-4">
    <div class="container">

    <?php if(!empty($notificacion)):?>
        <?php if($error):?>
            <p class="notificacion-error"> <?php echo $notificacion; ?> </p>  
        <?php else: ?>
            <p class="notificacion"> <?php echo $notificacion; ?> </p>
        <?php endif; ?>
    <?php endif; ?>

        <div class="row">
            <div class="col-12 col-md-4 mx-auto">
                <h2 class="text-center">Login</h2>

                <form action="login-adm.php" method="POST">
                    <div class="mb-3">
                        <label for="formUser">Correo: </label>
                        <input type="text" class="form-control" id="formUser" name="correo">
                    </div>
                    <div class="mb-3">
                        <label for="formPassword">Contraseña: </label>
                        <input type="password" class="form-control" id="formPassword" name="password">
                    </div>
                    <button class="btn btn-primary" type="submit">Iniciar Sesión</button>
                </form>

            </div>
        </div>
    </div>
</section>

<?php include('../include/footer-adm.php'); ?>