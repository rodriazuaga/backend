<?php 
session_start();
$url_base = "http://localhost/administracion/";
if(!isset($_SESSION["login_usuario"])){
    header("Location:".$url_base."login.php");
}
?>
<!DOCTYPE html>
<html lang="es">
    <head>
        <title>Sistema de Adminintración</title>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no"/>
        <!-- Bootstrap CSS v5.2.1 -->
        <link
            href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css"
            rel="stylesheet"
            integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN"
            crossorigin="anonymous"/>
        <link 
            rel="stylesheet" 
            href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
        <script src="https://code.jquery.com/jquery-3.7.1.min.js" 
                integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" 
                crossorigin="anonymous">
        </script>
        <link rel="stylesheet" href="https://cdn.datatables.net/2.0.1/css/dataTables.dataTables.css" />
        <script src="https://cdn.datatables.net/2.0.1/js/dataTables.js"></script>
        <style> body {
                background-image: url('/administracion/img/patron.png'); 
                background-position: center;
                background-repeat: repeat;
                }
        </style>
    </head>
    <body class="d-flex flex-column min-vh-100">
        <nav class="navbar navbar-expand navbar-light bg-light d-flex justify-content-between">
            <ul class="nav navbar-nav">
                <li class="nav-item">
                    <a class="nav-link active text-primary" href="<?= $url_base?>index.php" aria-current="page">
                        <i class="bi bi-house-door-fill"></i> 
                            XRV
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="<?= $url_base?>secciones/alumnos/">Alumnos</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="<?= $url_base?>secciones/profesores/">Profesores</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="<?= $url_base?>secciones/materias/">Asignaturas</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="<?= $url_base?>secciones/aulas/">Aulas</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="<?= $url_base?>secciones/notas/">Notas</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="<?= $url_base?>secciones/matricula/">Matricula</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-danger" href="<?= $url_base?>logout.php"><i class="bi bi-box-arrow-right"></i>
                        Logout
                    </a>
                </li>
            </ul>
            <div class="ml-auto text-success">
                Usuario: <?= $_SESSION["login_usuario"]?>
            </div>
        </nav>

<main class="container">