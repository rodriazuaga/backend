<?php include("../../bd.php");
$error = null;
$flash = null;
$stmtUsuarios = $conn->query("SELECT id_usuario, nombre FROM usuarios");
$usuarios = $stmtUsuarios->fetchAll(PDO::FETCH_ASSOC);

$stmtAsignaturas = $conn->query("SELECT id_asignatura, asignatura FROM asignaturas");
$asignaturas = $stmtAsignaturas->fetchAll(PDO::FETCH_ASSOC);

if(isset($_GET["txtID"])){
    $txtID = $_GET["txtID"];
    $sentencia = $conn->prepare("SELECT * FROM notas WHERE id_notas = :id_notas");
    $sentencia->execute([":id_notas" => $txtID]);
    $registro = $sentencia->fetch(PDO::FETCH_LAZY);
    $id_usuario = $registro["id_usuario"];
    $id_asignatura = $registro["id_asignatura"];
    $nota = $registro["nota"];

    $stmtUsuario = $conn->prepare("SELECT nombre FROM usuarios WHERE id_usuario = :id_usuario");
    $stmtUsuario->execute([":id_usuario" => $id_usuario]);
    $alumno = $stmtUsuario->fetchColumn();
    
    $stmtAsignatura = $conn->prepare("SELECT asignatura FROM asignaturas WHERE id_asignatura = :id_asignatura");
    $stmtAsignatura->execute([":id_asignatura" => $id_asignatura]);
    $asignatura = $stmtAsignatura->fetchColumn();
}
    if($_POST){
        if(empty($_POST["nota"])){
            $error = "Por favor rellene el campo de la Nota.";
        } else {
            $sentencia = $conn->prepare("UPDATE notas SET nota = :nota WHERE id_notas = :txtID");
            $result = $sentencia->execute([":nota" => $_POST["nota"],
                                            ":txtID" => $_POST["txtID"]]);
                if ($result){
                    $flash = "Calificación actualizada correctamente.";
                } else {
                    $error = "Error al actualizar calificación.";
                }
        }
    }
?>

<?php include("../../parciales/header.php");?>

<div class="card mt-5">
    <div class="card-header">
        <h3>Ingrese los datos de las Calificaciones</h3>
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
                <label for="alumno" class="form-label">Alumno</label>
                <input
                    type="text"
                    value="<?= $alumno?>"
                    class="form-control"
                    readonly
                    name="alumno"
                    id="alumno"
                    placeholder=""/>
            </div>
            <div class="mb-3">
                <label for="asignatura" class="form-label">Asignatura</label>
                <input
                    type="text"
                    value="<?= $asignatura?>"
                    class="form-control"
                    readonly
                    name="asignatura"
                    id="asignatura"
                    placeholder=""/>
            </div>
            <div class="mb-3">
                <label for="nota" class="form-label">Nota</label>
                <input
                    type="text"
                    class="form-control"
                    name="nota"
                    id="nota"
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
                }, 2000); 
            </script>
        <?php endif ?>
    </div>
</div>

<?php include("../../parciales/footer.php");?>