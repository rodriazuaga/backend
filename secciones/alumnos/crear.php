<?php include("../../bd.php");
$error = null;
$flash = null;
    if($_POST){
        if(empty($_POST["nombre"])||empty($_POST["apellidos"])||empty($_POST["ciclo"])
            ||empty($_POST["curso"])||empty($_POST["correo"])||empty($_POST["password"])){
            $error = "Por favor rellene todos los campos.";
        } else {
            $sentencia = $conn->prepare("INSERT INTO usuarios (nombre, apellido, ciclo, curso, email, contrasena)
                                        VALUES(:nombre, :apellido, :ciclo, :curso, :email, :contrasena)");
            $result = $sentencia->execute([":nombre" => $_POST["nombre"],
                                            ":apellido" => $_POST["apellidos"],
                                            ":ciclo" => $_POST["ciclo"],
                                            ":curso" => $_POST["curso"],
                                            ":email" => $_POST["correo"],
                                            ":contrasena" => password_hash($_POST["password"], PASSWORD_BCRYPT),
                                        ]);
                if ($result){
                    $flash = "Alumno añadido correctamente.";
                } else {
                    $error = "Error al añadir Alumno.";
                }
        }
    }
?>

<?php include("../../parciales/header.php");?>

<div class="card mt-5">
    <div class="card-header">
        <h3>Ingrese los datos del Alumno</h3>
    </div>
    <div class="card-body">
        <?php if ($error): ?>
            <div class="alert alert-danger mt-2">
                <?= $error ?> 
            </div>
        <?php endif ?>
        <form action="" method="post">
            <div class="mb-3">
                <label for="nombre" class="form-label">Nombre</label>
                <input
                    type="text"
                    class="form-control"
                    name="nombre"
                    id="nombre"
                    placeholder=""/>
            </div>
            <div class="mb-3">
                <label for="apellidos" class="form-label">Apellidos</label>
                <input
                    type="text"
                    class="form-control"
                    name="apellidos"
                    id="apellidos"
                    placeholder=""/>
            </div>
            <div class="mb-3">
                <label for="ciclo" class="form-label">Ciclo</label>
                <select class="form-select form-select-md" name="ciclo" id="ciclo">
                    <option value="Desarrollo de Aplicaciones Multiplataforma">Desarrollo de Aplicaciones Multiplataforma</option>
                    <option value="Desarrollo de Aplicaciones Web">Desarrollo de Aplicaciones Web</option>
                    <option value="Administración de Sistemas Informáticos en Red">Administración de Sistemas Informáticos en Red</option>
                </select>
            </div>
            
            <div class="mb-3">
                <label for="curso" class="form-label">Curso</label>
                <select class="form-select form-select-md" name="curso" id="curso">
                    <option value="1º">1º</option>
                    <option value="2º">2º</option>
                </select>
            </div>
            <div class="mb-3">
                <label for="correo" class="form-label">Correo</label>
                <input
                    type="email"
                    class="form-control"
                    name="correo"
                    id="correo"
                    placeholder=""/>
            </div>
            <div class="mb-3">
                <label for="password" class="form-label">Contraseña</label>
                <input
                    type="password"
                    class="form-control"
                    name="password"
                    id="password"
                    placeholder=""/>
            </div>
            <button type="submit" class="btn btn-success">
                Agregar
            </button>
            <a name="" id="" class="btn btn-primary" href="index.php" role="button">
                Cancelar
            </a>
        </form>
        <?php if ($flash): ?> 
            <div class="alert alert-success mt-2">
                <?= $flash ?> 
            </div>
            <script>
                setTimeout(function(){
                    window.location.href = "index.php";
                }, 3000); // 3000 milisegundos (3 segundos)
            </script>
        <?php endif ?>
    </div>
</div>


<?php include("../../parciales/footer.php");?>