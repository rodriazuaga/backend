<?php include("../../bd.php");
if(isset($_GET["txtID"])){
    $txtID = $_GET["txtID"];
    $sentencia = $conn->prepare("DELETE FROM notas WHERE id_notas = :id_notas");
    $sentencia->execute([":id_notas" => $txtID]);
}
    $sentencia = $conn->prepare("SELECT notas.id_notas, usuarios.nombre AS nombre_alumno, asignaturas.asignatura, notas.nota
                                FROM notas
                                JOIN usuarios ON notas.id_usuario = usuarios.id_usuario
                                JOIN asignaturas ON notas.id_asignatura = asignaturas.id_asignatura");
    $sentencia->execute();
    $lista_notas = $sentencia->fetchAll(PDO::FETCH_ASSOC);
?>

<?php include("../../parciales/header.php");?>

<div class="card mt-5 mb-5">
    <div class="card-header">
        <a name="" id="" class="btn btn-primary" href="crear.php" role="button">
            Ingresar Notas
        </a>
    </div>
    <div class="card-body">
        <div class="table-responsive-sm">
            <table class="table" id="tabla">
                <thead>
                    <tr>
                        <th scope="col">ID</th>
                        <th scope="col">Alumno</th>
                        <th scope="col">Asignatura</th>
                        <th scope="col">Nota</th>
                        <th scope="col">Acciones</th>
                    </tr>
                </thead>
                <tbody>
                <?php foreach($lista_notas as $registro){?>
                    <tr class="">
                        <td scope="row"><?= $registro['id_notas']?></td>
                        <td><?= $registro['nombre_alumno']?></td>
                        <td><?= $registro['asignatura']?></td>
                        <td><?= $registro['nota']?></td>
                        <td><a name="" id="" class="btn btn-info" href="editar.php?txtID=<?= $registro['id_notas']?>" role="button">
                                Editar
                            </a>
                            <a name="" id="" class="btn btn-danger" href="index.php?txtID=<?= $registro['id_notas']?>" role="button">
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