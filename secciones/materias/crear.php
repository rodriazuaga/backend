<?php include("../../bd.php");
$error = null;
$flash = null;
$stmtProfesores = $conn->query("SELECT id_profesor, nombre FROM profesor");
$profesores = $stmtProfesores->fetchAll(PDO::FETCH_ASSOC);
    if($_POST){
        if(empty($_POST["asignatura"])||empty($_POST["profesor"])){
            $error = "Por favor rellene todos los campos.";
        } else {
            $profesorSeleccionado = $_POST["profesor"];
            $stmt = $conn->prepare("SELECT id_profesor FROM profesor WHERE nombre = :nombre");
            $stmt->execute([":nombre" => $profesorSeleccionado]);
            $resultado = $stmt->fetch(PDO::FETCH_ASSOC);
            if (!$resultado) {
                $error = "Error al obtener el ID del profesor.";
            } else {
                $sentencia = $conn->prepare("INSERT INTO asignaturas (id_profesor, asignatura)
                                        VALUES(:id_profesor, :asignatura)");
                $result = $sentencia->execute([":id_profesor" => $resultado["id_profesor"],
                                            ":asignatura" => $_POST["asignatura"]]);
                    if ($result){
                    $flash = "Asignatura creada correctamente.";
                    } else {
                    $error = "Error al crear asignatura.";
                    }
            }
        }
        
    }
?>

<?php include("../../parciales/header.php");?>

<div class="card mt-5">
    <div class="card-header">
        <h3>Ingrese los datos de la Asignatura</h3>
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
                <input
                    type="text"
                    class="form-control"
                    name="asignatura"
                    id="asignatura"
                    placeholder=""/>
            </div>
            <div class="mb-3">
                <label for="profesor" class="form-label">Profesor</label>
                <select class="form-select form-select-md" name="profesor" id="profesor">
                    <?php foreach ($profesores as $profesor): ?>
                        <option value="<?= $profesor['nombre'] ?>"><?= $profesor['nombre'] ?></option>
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