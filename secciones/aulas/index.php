<?php include("../../bd.php");

    $sentencia = $conn->prepare("SELECT clases.id_clases, asignaturas.asignatura, clases.aula, clases.horario
                                FROM clases
                                JOIN asignaturas ON clases.id_asignatura = asignaturas.id_asignatura");
    $sentencia->execute();
    $lista_clases = $sentencia->fetchAll(PDO::FETCH_ASSOC);
?>

<?php include("../../parciales/header.php");?>

<div class="card mt-5 mb-5">
    <div class="card-header">
        <h4>Horario y Ubicación de Aulas</h4>       
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
                    </tr>
                </thead>
                <tbody>
                <?php foreach($lista_clases as $registro){?>
                    <tr class="">
                        <td scope="row"><?= $registro['id_clases']?></td>
                        <td><?= $registro['asignatura']?></td>
                        <td><?= $registro['aula']?></td>
                        <td><?= $registro['horario']?></td>
                    </tr>
                <?php }?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<?php include("../../parciales/footer.php");?>