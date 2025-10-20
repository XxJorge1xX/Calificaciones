<?php
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nombre = htmlspecialchars($_POST["nombre"]);
    $cedula = htmlspecialchars($_POST["cedula"]);
    $materias = $_POST["materia"];
    $codigos = $_POST["codigo"];
    $notas = $_POST["nota"];

    $notas_float = array_map('floatval', $notas);
    $suma = array_sum($notas_float);
    $cantidad = count($notas_float);
    $promedio = $cantidad > 0 ? round($suma / $cantidad, 2) : 0;

    if ($promedio >= 91) {
        $letra = 'A';
    } elseif ($promedio >= 81) {
        $letra = 'B';
    } elseif ($promedio >= 71) {
        $letra = 'C';
    } elseif ($promedio > 61) {
        $letra = 'D';
    } else {
        $letra = 'F';
    }

    $mensaje = ($promedio >= 71) ? "El estudiante Aprobó el Semestre." : "El estudiante No Aprobó el Semestre.";
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Impresión de Calificaciones</title>
    <link rel="stylesheet" href="base.css">
    <link rel="stylesheet" href="estilos.css">
</head>
<body>
    <h1>Universidad de Panamá</h1>
    <h1>Facultad de Informática, Electrónica y Comunicación</h1>
    <h1>Licenciatura en Gerencia en Comercio Electrónico</h1>
    <h1>Lista Extraoficial de Calificaciones Asignatura INF-320A</h1>

    <video class="background-video" muted autoplay loop>
        <source src="hola.mp4" type="video/mp4">
    </video>
    <div class="capa"></div>

    <div class="resultado">
        <div class="info-estudiante">
            <div><strong>Nombre del estudiante:</strong> <?= $nombre ?></div>
            <div><strong>Cédula:</strong> <?= $cedula ?></div>
        </div>

        <div class="sub_title">
            <div class="asignatura"><h6>Asignatura</h6></div>
            <div><h6>Abreviatura</h6></div>
            <div><h6>Notas</h6></div>
        </div>

        <?php for ($i = 0; $i < count($materias); $i++): ?>
            <div class="materia-item">
                <div><?= htmlspecialchars($materias[$i]) ?></div>
                <div><?= htmlspecialchars($codigos[$i]) ?></div>
                <div><?= htmlspecialchars($notas[$i]) ?></div>
            </div>
        <?php endfor; ?>

        <div class="materia-item">
            <div>El promedio es: <?= $promedio ?></div>
            <div>Su nota final es: <?= $letra ?></div>
        </div>

        <div class="materia-item"> 
            <div class="mensaje-final <?= $promedio >= 71 ? 'aprobado' : 'reprobado' ?>">
                <?= $mensaje ?>
            </div>
        </div>

        <div class="materia-item">
            <div class="calculado-por">
                Calculado por: <?= htmlspecialchars($_SESSION["usuario"] ?? "Invitado") ?>.
                Fecha: <?= date("d") ?> de <?= strftime("%B", time()) ?> de <?= date("Y") ?>.
            </div>
        </div>

        <div class="volver">
            <a href="index.php">Inicio</a>
        </div>
    </div>
</body>
</html>
