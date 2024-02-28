<?php include("../../bd.php");

if(isset($_GET["txtID"])){
    $txtID = $_GET["txtID"];
    $sentencia = $conn->prepare("DELETE FROM profesor WHERE id_profesor = :id_profesor");
    $sentencia->execute([":id_profesor" => $txtID]);
}
    $sentencia = $conn->prepare("select * from profesor");
    $sentencia->execute();
    $lista_profes = $sentencia->fetchAll(PDO::FETCH_ASSOC);
?>

<?php include("../../parciales/header.php");?>

<div class="card mt-5">
    <div class="card-header">
        <a name="" id="" class="btn btn-primary" href="crear.php" role="button">
            Asignar Profesor
        </a>
    </div>
    <div class="card-body">
        <div class="table-responsive-sm">
            <table class="table">
                <thead>
                    <tr>
                        <th scope="col">ID</th>
                        <th scope="col">Nombre Completo</th>
                        <th scope="col">Correo</th>
                        <th scope="col">Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach($lista_profes as $registro){?>
                    <tr class="">
                        <td scope="row"><?= $registro['id_profesor']?></td>
                        <td><?= $registro['nombre']?></td>
                        <td><?= $registro['email']?></td>
                        <td><a name="" id="" class="btn btn-info" href="editar.php?txtID=<?= $registro['id_profesor']?>" role="button">
                                Editar
                            </a>
                            <a name="" id="" class="btn btn-danger" href="index.php?txtID=<?= $registro['id_profesor']?>" role="button">
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