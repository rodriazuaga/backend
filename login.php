<?php include("bd.php");
session_start();
$error=null;
if($_POST){
    $sentencia = $conn->prepare("SELECT *, count(*) AS n 
                                FROM login 
                                WHERE login_usuario = :login_usuario
                                AND password = :password");
    $sentencia->execute([":login_usuario" => $_POST["login_usuario"],
                        ":password" => $_POST["password"]]);
    $admin = $sentencia->fetch(PDO::FETCH_LAZY);
    if($admin["n"]>0){
    $_SESSION["login_usuario"] = $admin["login_usuario"];
    header("Location:index.php");
    } else {
        $error = "Credenciales Incorrectas";
    }
}
?>
<!doctype html>
<html lang="es">
    <head>
        <title>Login</title>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no"/>
        <!-- Bootstrap CSS v5.2.1 -->
        <link
            href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css"
            rel="stylesheet"
            integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN"
            crossorigin="anonymous"/>
            <style> body {
                background-image: url('/administracion/img/patron.png'); 
                background-position: center;
                background-repeat: repeat;
                }
        </style>
    </head>
    <body>
        <header>
            
        </header>
        <main class="container">
            <div class="row">
                <div class="col-md-4">
                </div>
                <div class="col-md-4">
                    <div class="card mt-5">
                        <div class="card-header text-center">
                            <h4>Login</h4>
                        </div>
                        <div class="card-body">
                        <?php if ($error): ?>
                            <div class="alert alert-danger mt-2">
                                <?= $error ?> 
                            </div>
                        <?php endif ?>
                            <form action="" method="post">
                                <div class="mb-3">
                                    <label for="login_usuario" class="form-label">Usuario</label>
                                    <input
                                        type="text"
                                        class="form-control"
                                        name="login_usuario"
                                        id="login_usuario"
                                        placeholder="admin"/>
                                </div>
                                <div class="mb-3">
                                    <label for="password" class="form-label">Contraseña</label>
                                    <input
                                        type="password"
                                        class="form-control"
                                        name="password"
                                        id="password"
                                        placeholder="*****"/>
                                </div>
                                <button type="submit" class="btn btn-primary">
                                    Entrar
                                </button>
                                
                            </form>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                </div>
            </div>
        </main>
        <footer>
            <!-- place footer here -->
        </footer>
        <!-- Bootstrap JavaScript Libraries -->
        <script
            src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"
            integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r"
            crossorigin="anonymous"
        ></script>
        <script
            src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js"
            integrity="sha384-BBtl+eGJRgqQAUMxJ7pMwbEyER4l1g+O15P+16Ep7Q9Q+zqX6gSbd85u4mG4QzX+"
            crossorigin="anonymous"
        ></script>
    </body>
</html>
