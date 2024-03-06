<?php include("../../bd.php");
$error = null;
$flash = null;
$stmtAsignaturas = $conn->query("SELECT * FROM asignaturas");
$asignaturas = $stmtAsignaturas->fetchAll(PDO::FETCH_ASSOC);
if(isset($_GET["txtID"])){
    $txtID = $_GET["txtID"];
    $sentencia = $conn->prepare("SELECT * FROM clases WHERE id_clases = :id_clases");
    $sentencia->execute([":id_clases" => $txtID]);
    $registro = $sentencia->fetch(PDO::FETCH_LAZY);
    $id_asignatura = $registro["id_asignatura"];
    $aula = $registro["aula"];
    $horario = $registro["horario"];
}
    if($_POST){
        $txtID = $_POST["txtID"];
        if(empty($_POST["asignatura"])||empty($_POST["aula"])||empty($_POST["horario"])){
            $error = "Por favor rellene todos los campos.";
        } else {
                $sentencia = $conn->prepare("UPDATE clases SET id_asignatura = :id_asignatura, 
                                                                aula = :aula, 
                                                                horario = :horario
                                            WHERE id_clases = :txtID");
                $result = $sentencia->execute([":id_asignatura" => $_POST["asignatura"],
                                            ":aula" => $_POST["aula"],
                                            ":horario" => $_POST["horario"],
                                            ":txtID" => $_POST["txtID"]]);
                    if ($result){
                    $flash = "Aulas y Horarios actualizados correctamente.";
                    } else {
                    $error = "Error al actualizar Aulas y Horarios.";
                    }
            }
        }
        
    
?>

<?php include("../../parciales/header.php");?>

<div class="card mt-5">
    <div class="card-header">
        <h3>Asigne las Aulas y los Horarios</h3>
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
                <label for="asignatura" class="form-label">Nombre de la Asignatura</label>
                <select class="form-select form-select-md" name="asignatura" id="asignatura">
                    <?php foreach ($asignaturas as $asignatura): ?>
                        <option value="<?= $asignatura['id_asignatura'] ?>" <?= ($asignatura['id_asignatura'] == $id_asignatura) ? 'selected' : '' ?>>
                        <?= $asignatura['asignatura'] ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>
            <div class="mb-3">
                <label for="aula" class="form-label">Aula</label>
                <input
                    type="text"
                    value="<?= $aula?>"
                    class="form-control"
                    name="aula"
                    id="aula"
                    placeholder=""/>
            </div>
            <div class="mb-3">
                <label for="horario" class="form-label">Horario</label>
                <input
                    type="text"
                    value="<?= $horario?>"
                    class="form-control"
                    name="horario"
                    id="horario"
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