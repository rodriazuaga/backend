<?php include("../../bd.php");
$error = null;
$flash = null;
    if($_POST){
        if(empty($_POST["nombre"])||empty($_POST["correo"])){
            $error = "Por favor rellene todos los campos.";
        } else {
            $sentencia = $conn->prepare("INSERT INTO profesor (nombre, email)
                                        VALUES(:nombre, :email)");
            $result = $sentencia->execute([":nombre" => $_POST["nombre"],
                                                ":email" => $_POST["correo"]]);
                if ($result){
                    $flash = "Profesor añadido correctamente.";
                } else {
                    $error = "Error al añadir profesor.";
                }
        }
    }
?>

<?php include("../../parciales/header.php");?>

<div class="card mt-5">
    <div class="card-header">
        <h3>Ingrese los datos del Profesor</h3>
    </div>
    <div class="card-body">
        <?php if ($error): ?>
            <div class="alert alert-danger mt-2">
                <?= $error ?> 
            </div>
        <?php endif ?>
        <form action="" method="post">
            <div class="mb-3">
                <label for="nombre" class="form-label">Nombre Completo</label>
                <input type="text" class="form-control" name="nombre" id="nombre" placeholder=""/>
            </div>
            <div class="mb-3">
                <label for="correo" class="form-label">Correo</label>
                <input type="email" class="form-control" name="correo" id="correo" placeholder=""/>
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