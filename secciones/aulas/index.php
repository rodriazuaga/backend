<?php include("../../bd.php");
if(isset($_GET["txtID"])){
    $txtID = $_GET["txtID"];
    $sentencia = $conn->prepare("DELETE FROM clases WHERE id_clases = :id_clases");
    $sentencia->execute([":id_clases" => $txtID]);
}
    $sentencia = $conn->prepare("SELECT clases.id_clases, asignaturas.asignatura, clases.aula, clases.horario
                                FROM clases
                                JOIN asignaturas ON clases.id_asignatura = asignaturas.id_asignatura");
    $sentencia->execute();
    $lista_clases = $sentencia->fetchAll(PDO::FETCH_ASSOC);
?>

<?php include("../../parciales/header.php");?>

<div class="card mt-5 mb-5">
    <div class="card-header">
    <a name="" id="" class="btn btn-primary" href="crear.php" role="button">
            Asignar Aula/Horario
        </a>      
    </div>
    <div class="card-body">
        <div class="table-responsive-sm">
            <table class="table">
                <thead>
                    <tr>
                    <th scope="col">ID</th>
                        <th scope="col">Asignatura</th>
                        <th scope="col">Aula</th>
                        <th scope="col">Horario</th>
                        <th scope="col">Acciones</th>
                    </tr>
                </thead>
                <tbody>
                <?php foreach($lista_clases as $registro){?>
                    <tr class="">
                        <td scope="row"><?= $registro['id_clases']?></td>
                        <td><?= $registro['asignatura']?></td>
                        <td><?= $registro['aula']?></td>
                        <td><?= $registro['horario']?></td>
                        <td><a name="" id="" class="btn btn-info" href="editar.php?txtID=<?= $registro['id_clases']?>" role="button">
                                Editar
                            </a>
                            <a name="" id="" class="btn btn-danger" href="index.php?txtID=<?= $registro['id_clases']?>" role="button">
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