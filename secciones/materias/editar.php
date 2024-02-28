<?php include("../../bd.php");
$error = null;
$flash = null;
$stmtProfesores = $conn->query("SELECT id_profesor, nombre FROM profesor");
$profesores = $stmtProfesores->fetchAll(PDO::FETCH_ASSOC);
if(isset($_GET["txtID"])){
    $txtID = $_GET["txtID"];
    $sentencia = $conn->prepare("SELECT * FROM asignaturas WHERE id_asignatura = :id_asignatura");
    $sentencia->execute([":id_asignatura" => $txtID]);
    $registro = $sentencia->fetch(PDO::FETCH_LAZY);
    $asignatura = $registro["asignatura"];
    $id_profesor = $registro["id_profesor"];
}
if($_POST){
    $txtID = $_POST["txtID"];
    if(empty($_POST["asignatura"])||empty($_POST["profesor"])){
        $error = "Por favor rellene todos los campos.";
    } else {
        $sentencia = $conn->prepare("UPDATE asignaturas SET id_profesor = :id_profesor, asignatura = :asignatura
                                    WHERE id_asignatura = :txtID");
        $result = $sentencia->execute([":id_profesor" => $_POST["profesor"],
                                        ":asignatura" => $_POST["asignatura"],
                                        ":txtID" => $_POST["txtID"]]);
            if ($result){
                $flash = "Asignatura actualizada correctamente.";
            } else {
                $error = "Error al actualizar Asignatura.";
            }
    }
    
}
?>

<?php include("../../parciales/header.php");?>

<div class="card mt-5">
    <div class="card-header">
        <h3>Actualice la Asignatura</h3>
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
                <input
                    type="text"
                    value="<?= $asignatura?>"
                    class="form-control"
                    name="asignatura"
                    id="asignatura"
                    placeholder=""/>
            </div>
            <div class="mb-3">
                <label for="profesor" class="form-label">Profesor</label>
                <select class="form-select form-select-md" name="profesor" id="profesor">
                <?php foreach ($profesores as $profesor): ?>
                        <option value="<?= $profesor['id_profesor'] ?>" <?= ($profesor['id_profesor'] == $id_profesor) ? 'selected' : '' ?>>
                            <?= $profesor['nombre'] ?>
                        </option>
                    <?php endforeach; ?>
                </select>
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