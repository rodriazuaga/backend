<?php include("../../bd.php");
if(isset($_GET["txtID"])){
    $txtID = $_GET["txtID"];
    $sentencia = $conn->prepare("DELETE FROM asignaturas WHERE id_asignatura = :id_asignatura");
    $sentencia->execute([":id_asignatura" => $txtID]);
}
    $sentencia = $conn->prepare("SELECT asignaturas.id_asignatura, asignaturas.asignatura, profesor.nombre AS nombre_profesor
                                FROM asignaturas
                                JOIN profesor ON asignaturas.id_profesor = profesor.id_profesor");
    $sentencia->execute();
    $lista_asignaturas = $sentencia->fetchAll(PDO::FETCH_ASSOC);
?>

<?php include("../../parciales/header.php");?>

<div class="card mt-5 mb-5">
    <div class="card-header">
        <a name="" id="" class="btn btn-primary" href="crear.php" role="button">
            Agregar Asignatura
        </a>
    </div>
    <div class="card-body">
        <div class="table-responsive-sm">
            <table class="table" id="tabla">
                <thead>
                    <tr>
                        <th scope="col">ID</th>
                        <th scope="col">Asignatura</th>
                        <th scope="col">Profesor</th>
                        <th scope="col">Acciones</th>
                    </tr>
                </thead>
                <tbody>
                <?php foreach($lista_asignaturas as $registro){?>
                    <tr class="">
                        <td scope="row"><?= $registro['id_asignatura']?></td>
                        <td><?= $registro['asignatura']?></td>
                        <td><?= $registro['nombre_profesor']?></td>
                        <td><a name="" id="" class="btn btn-info" href="editar.php?txtID=<?= $registro['id_asignatura']?>" role="button">
                                Editar
                            </a>
                            <a
                            name="" id="" class="btn btn-danger" href="index.php?txtID=<?= $registro['id_asignatura']?>" role="button">
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