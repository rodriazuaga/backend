<?php include("../../bd.php");
$error = null;
$flash = null;
$stmtUsuarios = $conn->query("SELECT id_usuario, nombre FROM usuarios");
$usuarios = $stmtUsuarios->fetchAll(PDO::FETCH_ASSOC);
$stmtAsignaturas = $conn->query("SELECT id_asignatura, asignatura FROM asignaturas");
$asignaturas = $stmtAsignaturas->fetchAll(PDO::FETCH_ASSOC);
    if($_POST){
        if(empty($_POST["alumno"])||empty($_POST["asignatura"])){
            $error = "Por favor rellene todos los campos.";
        } else {
            $alumnoSeleccionado = $_POST["alumno"];
            $asignaturaSeleccionada = $_POST["asignatura"];
            $stmtUsuario = $conn->prepare("SELECT id_usuario FROM usuarios WHERE nombre = :nombre");
            $stmtUsuario->execute([":nombre" => $alumnoSeleccionado]);
            $resultadoUsuario = $stmtUsuario->fetch(PDO::FETCH_ASSOC);
            $stmtAsignatura = $conn->prepare("SELECT id_asignatura FROM asignaturas WHERE asignatura = :asignatura");
            $stmtAsignatura->execute([":asignatura" => $asignaturaSeleccionada]);
            $resultadoAsignatura = $stmtAsignatura->fetch(PDO::FETCH_ASSOC);
            $sentencia = $conn->prepare("INSERT INTO matricula (id_usuario, id_asignatura)
                                        VALUES(:id_usuario, :id_asignatura)");
            $result = $sentencia->execute([":id_usuario" => $resultadoUsuario["id_usuario"],
                                            ":id_asignatura" => $resultadoAsignatura["id_asignatura"]]);
                if ($result){
                    $flash = "Alumno matriculado correctamente.";
                } else {
                    $error = "Error al matricular Alumno.";
                }
        }
    }
?>

<?php include("../../parciales/header.php");?>

<div class="card mt-5">
    <div class="card-header">
        <h3>Ingrese los datos de la Matricula</h3>
    </div>
    <div class="card-body">
        <?php if ($error): ?>
            <div class="alert alert-danger mt-2">
                <?= $error ?> 
            </div>
        <?php endif ?>
        <form action="" method="post">
            <div class="mb-3">
                <label for="alumno" class="form-label">Alumno</label>
                <select class="form-select form-select-md" name="alumno" id="alumno">
                    <?php foreach ($usuarios as $usuario): ?>
                        <option value="<?= $usuario['nombre'] ?>">
                            <?= $usuario['nombre'] ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>
            <div class="mb-3">
                <label for="asignatura" class="form-label">Asignatura</label>
                <select class="form-select form-select-md" name="asignatura" id="asignatura">
                    <?php foreach ($asignaturas as $asignatura): ?>
                        <option value="<?= $asignatura['asignatura'] ?>">
                            <?= $asignatura['asignatura'] ?>
                        </option>
                    <?php endforeach; ?>
                </select>
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