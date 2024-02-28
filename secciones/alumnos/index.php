<?php include("../../bd.php");
if(isset($_GET["txtID"])){
    $txtID = $_GET["txtID"];
    $sentencia = $conn->prepare("DELETE FROM usuarios WHERE id_usuario = :id_usuario");
    $sentencia->execute([":id_usuario" => $txtID]);
}
    $sentencia = $conn->prepare("select * from usuarios");
    $sentencia->execute();
    $lista_usuarios = $sentencia->fetchAll(PDO::FETCH_ASSOC);
?>

<?php include("../../parciales/header.php");?>

<div class="card mt-5 mb-5">
    <div class="card-header">
        <a name="" id="" class="btn btn-primary" href="crear.php" role="button">
            Matricular Alumno
        </a>
    </div>
    <div class="card-body">
        <div class="table-responsive-sm">
            <table class="table" id="tabla">
                <thead>
                    <tr>
                        <th scope="col">ID</th>
                        <th scope="col">Nombre</th>
                        <th scope="col">Apellidos</th>
                        <th scope="col">Ciclo</th>
                        <th scope="col">Curso</th>
                        <th scope="col">Correo</th>
                        <th scope="col">Acciones</th>
                    </tr>
                </thead>
                <tbody>
                <?php foreach($lista_usuarios as $registro){?>
                    <tr class="">
                        <td scope="row"><?= $registro['id_usuario']?></td>
                        <td><?= $registro['nombre']?></td>
                        <td><?= $registro['apellido']?></td>
                        <td><?= $registro['ciclo']?></td>
                        <td><?= $registro['curso']?></td>
                        <td><?= $registro['email']?></td>
                        <td><a name="" id="" class="btn btn-info" href="editar.php?txtID=<?= $registro['id_usuario']?>" role="button">
                                Editar
                            </a>
                            <a name="" id="" class="btn btn-danger" href="index.php?txtID=<?= $registro['id_usuario']?>" role="button">
                                Eliminar
                            </a>
                        </td>
                    </tr>
                <?php }?>
                </tbody>
            </table>
        </div>
    </div>
</div>


<?php include("../../parciales/footer.php");?>