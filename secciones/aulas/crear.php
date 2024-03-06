<?php include("../../bd.php");
$error = null;
$flash = null;
$stmtAsignaturas = $conn->query("SELECT id_asignatura, asignatura FROM asignaturas");
$asignaturas = $stmtAsignaturas->fetchAll(PDO::FETCH_ASSOC);
    if($_POST){
        if(empty($_POST["asignatura"])||empty($_POST["aula"])||empty($_POST["horario"])){
            $error = "Por favor rellene todos los campos.";
        } else {
            $asignaturaSelecionada = $_POST["asignatura"];
            $stmt = $conn->prepare("SELECT id_asignatura FROM asignaturas WHERE asignatura = :asignatura");
            $stmt->execute([":asignatura" => $asignaturaSelecionada]);
            $resultado = $stmt->fetch(PDO::FETCH_ASSOC);
            if (!$resultado) {
                $error = "Error al obtener el ID de la asignatura.";
            } else {
                $sentencia = $conn->prepare("INSERT INTO clases (id_asignatura, aula, horario)
                                        VALUES(:id_asignatura, :aula, :horario)");
                $result = $sentencia->execute([":id_asignatura" => $resultado["id_asignatura"],
                                            ":aula" => $_POST["aula"],
                                            ":horario" => $_POST["horario"]]);
                    if ($result){
                    $flash = "Aulas y Horarios creados correctamente.";
                    } else {
                    $error = "Error al aasignar Aulas y Horarios.";
                    }
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
                <label for="asignatura" class="form-label">Nombre de la Asignatura</label>
                <select class="form-select form-select-md" name="asignatura" id="asignatura">
                    <?php foreach ($asignaturas as $asignatura): ?>
                        <option value="<?= $asignatura['asignatura'] ?>"><?= $asignatura['asignatura'] ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
            <div class="mb-3">
                <label for="aula" class="form-label">Aula</label>
                <input
                    type="text"
                    class="form-control"
                    name="aula"
                    id="aula"
                    placeholder=""/>
            </div>
            <div class="mb-3">
                <label for="horario" class="form-label">Horario</label>
                <input
                    type="text"
                    class="form-control"
                    name="horario"
                    id="horario"
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