<?php include("../../bd.php");
$error = null;
$flash = null;
if(isset($_GET["txtID"])){
    $txtID = $_GET["txtID"];
    $sentencia = $conn->prepare("SELECT * FROM profesor WHERE id_profesor = :id_profesor");
    $sentencia->execute([":id_profesor" => $txtID]);
    $registro = $sentencia->fetch(PDO::FETCH_LAZY);
    $nombre = $registro["nombre"];
    $correo = $registro["email"];
}
if($_POST){
    $txtID = $_POST["txtID"];
    if(empty($_POST["nombre"])||empty($_POST["correo"])){
        $error = "Por favor rellene todos los campos.";
    } else {
        $sentencia = $conn->prepare("UPDATE profesor SET nombre = :nombre, email = :email
                                    WHERE id_profesor = :txtID");
        $result = $sentencia->execute([":nombre" => $_POST["nombre"],
                                        ":email" => $_POST["correo"],
                                        ":txtID" => $_POST["txtID"]]);
            if ($result){
                $flash = "Profesor actualizado correctamente.";
            } else {
                $error = "Error al actualizar profesor.";
            }
            
    }
    
}
?>

<?php include("../../parciales/header.php");?>

<div class="card mt-5">
    <div class="card-header">
        <h3>Actualice los datos del Profesor</h3>
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
                <label for="nombre" class="form-label">Nombre Completo</label>
                <input
                    type="text"
                    value="<?= $nombre?>"
                    class="form-control"
                    name="nombre"
                    id="nombre"
                    placeholder=""/>
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