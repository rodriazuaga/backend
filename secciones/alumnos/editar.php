<?php include("../../bd.php");
$error = null;
$flash = null;
if(isset($_GET["txtID"])){
    $txtID = $_GET["txtID"];
    $sentencia = $conn->prepare("SELECT * FROM usuarios WHERE id_usuario = :id_usuario");
    $sentencia->execute([":id_usuario" => $txtID]);
    $registro = $sentencia->fetch(PDO::FETCH_LAZY);
    $nombre = $registro["nombre"];
    $apellidos = $registro["apellido"];
    $ciclo = $registro["ciclo"];
    $curso = $registro["curso"];
    $correo = $registro["email"];
    $password = $registro["contrasena"];
}
if($_POST){
    $txtID = $_POST["txtID"];
    if(empty($_POST["nombre"])||empty($_POST["apellidos"])||empty($_POST["ciclo"])
            ||empty($_POST["curso"])||empty($_POST["correo"])||empty($_POST["password"])){
            $error = "Por favor rellene todos los campos.";
        } else {
        $sentencia = $conn->prepare("UPDATE usuarios SET nombre = :nombre, 
                                                        apellido = :apellido,
                                                        ciclo = :ciclo, 
                                                        curso = :curso, 
                                                        email = :email, 
                                                        contrasena = :contrasena
                                    WHERE id_usuario = :txtID");
        $result = $sentencia->execute([":nombre" => $_POST["nombre"],
                                        ":apellido" => $_POST["apellidos"],
                                        ":ciclo" => $_POST["ciclo"],
                                        ":curso" => $_POST["curso"],
                                        ":email" => $_POST["correo"],
                                        ":contrasena" => password_hash($_POST["password"], PASSWORD_BCRYPT),
                                        ":txtID" => $_POST["txtID"],
                                    ]);
            if ($result){
                $flash = "Alumno actualizado correctamente.";
            } else {
                $error = "Error al actualizar Alumno.";
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
                <label for="txtID" class="form-label">ID</label>
                <input
                    type="text"
                    value="<?= $txtID?>"
                    class="form-control"
                    readonly
                    name="txtID"
                    id="txtID"
                    placeholder=""/>
            </div>
            <div class="mb-3">
                <label for="nombre" class="form-label">Nombre</label>
                <input
                    type="text"
                    value="<?= $nombre?>"
                    class="form-control"
                    name="nombre"
                    id="nombre"
                    placeholder=""/>
            </div>
            <div class="mb-3">
                <label for="apellidos" class="form-label">Apellidos</label>
                <input
                    type="text"
                    value="<?= $apellidos?>"
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
                    value="<?= $correo?>"
                    class="form-control"
                    name="correo"
                    id="correo"
                    placeholder=""/>
            </div>
            <div class="mb-3">
                <label for="password" class="form-label">Contraseña</label>
                <input
                    type="password"
                    value="<?= $password?>"
                    class="form-control"
                    name="password"
                    id="password"
                    placeholder=""/>
            </div>
            <button type="submit" class="btn btn-success">
                Actualizar
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