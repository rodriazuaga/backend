<?php include("../../bd.php");
if(isset($_GET["txtID"])){
    $txtID = $_GET["txtID"];
    $sentencia = $conn->prepare("DELETE FROM notas WHERE id_notas = :id_notas");
    $sentencia->execute([":id_notas" => $txtID]);
}
    $sentencia = $conn->prepare("SELECT matricula.id_matricula, usuarios.nombre AS nombre_alumno, asignaturas.asignatura
                                FROM matricula
                                JOIN usuarios ON matricula.id_usuario = usuarios.id_usuario
                                JOIN asignaturas ON matricula.id_asignatura = asignaturas.id_asignatura");
    $sentencia->execute();
    $matriculas = $sentencia->fetchAll(PDO::FETCH_ASSOC);
?>

<?php include("../../parciales/header.php");?>

<div class="card mt-5 mb-5">
    <div class="card-header">
        <a name="" id="" class="btn btn-primary" href="crear.php" role="button">
            Matricula
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
                        <th scope="col">Acciones</th>
                    </tr>
                </thead>
                <tbody>
                <?php foreach($matriculas as $registro){?>
                    <tr class="">
                        <td scope="row"><?= $registro['id_matricula']?></td>
                        <td><?= $registro['nombre_alumno']?></td>
                        <td><?= $registro['asignatura']?></td>
                        <td><a name="" id="" class="btn btn-danger" href="index.php?txtID=<?= $registro['id_matricula']?>" role="button">
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