<?php
session_start();
if($_POST){

    if ( ($_POST['usuario']=="taller2") && ( $_POST['contrasenia']=="taller2") ){

        $_SESSION['usuario']="taller2";
        
        header("location:index.php");

    }else{

        echo "<script> alert('Te equivocaste'); </script> ";

    }
}
 
?>


<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Iniciar Sesión</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <link rel="stylesheet" href="css/styles.css" />

    <style>
        .form-control {
            position: relative;
        }
        .form-control .fa {
            position: absolute;
            left: 10px;
            top: 10px;
        }
        .btn-success {
            transition: transform 0.3s;
        }
        .btn-success:hover {
            transform: scale(1.1);
        }
        .fade-in {
            animation: fadeIn 1s;
        }
        @keyframes fadeIn {
            0% {opacity: 0;}
            100% {opacity: 1;}
        }

        .card {
        border: 1px solid #00BDFF;
        box-shadow: 0 0 10px #00BDFF, 0 0 20px #00BDFF, 0 0 30px #00BDFF, 0 0 40px #00BDFF;
    }
    </style>
</head>
<body>
    <div class="container">

        <div class="row justify-content-center align-items-center g-2" style="height: 100vh;">
            <div class="col-4"></div>
            <div class="col-4">
                <br>

                <div class="card shadow-lg fade-in">
                    <div class="card-header bg-primary text-white text-center">
                        <h3>Iniciar Sesion</h3>
                    </div>
                    <div class="card-body">
                        <form action="login.php" method="post" id="loginForm">
                            <div class="form-group">
                                <label for="usuario" class="text-primary">Usuario</label>
                                <i class="fa fa-user"></i>
                                <input class="form-control" type="text" name="usuario" id="usuario" required>
                            </div>
                            <br>
                            <div class="form-group">
                                <label for="contrasenia" class="text-primary">Contraseña</label>
                                <i class="fa fa-lock"></i>
                                <input class="form-control" type="password" name="contrasenia" id="contrasenia" required>
                            </div>
                            <br>
                            <button class="btn btn-success btn-block" type="submit">Entrar al portafolio</button>
                        </form> 
                    </div>
                </div>

            </div>
            <div class="col-4"></div>
        </div>

    </div>

    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
    <script>
        document.getElementById('loginForm').addEventListener('submit', function(event) {
            event.preventDefault();
            // Aquí puedes agregar funcionalidades adicionales antes de enviar el formulario
            console.log('Formulario enviado');
            this.submit();
        });
    </script>
</body>
</html>
