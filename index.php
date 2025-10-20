<?php
session_start();

// Destruir la sesión si ya existe para pedir el usuario cada vez que se recargue
session_unset();
session_destroy();
session_start();

// Procesar nombre de usuario
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["usuario"])) {
    $_SESSION["usuario"] = htmlspecialchars($_POST["usuario"]);
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Formulario de Calificaciones</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Playpen+Sans+Deva:wght@100..800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="base.css">
    <link rel="stylesheet" href="pepe.css">
    <script defer src="index.js"></script>
</head>
<body>

    <h1>Universidad de Panamá</h1>
    <h1>Facultad de Informática, Electrónica y Comunicación</h1>
    <h1>Licenciatura en Gerencia en Comercio Electrónico</h1>
    <h1>Lista Extraoficial de Calificaciones Asignatura INF-320A</h1>

    <div class="container">
        <video class="background-video" muted autoplay loop>
            <source src="hola.mp4" type="video/mp4">
        </video>
    <div class="capa"></div>

        <?php if (!isset($_SESSION["usuario"])): ?>
            <form method="post" action="" id="usuario-form" class="form-usuario">
                <div class="user_name">
                    <label for="usuario" class="user_label">Usuario</label>
                    <input class="user_input1" type="text" id="usuario" name="usuario" placeholder="Ej. Pepito" required>
                    <button class="ingresar" type="submit">Ingresar</button>
                </div>
            </form>
        <?php else: ?>
            <div class="bienvenida">
                Bienvenido, <?= htmlspecialchars($_SESSION["usuario"]) ?>!
            </div>

            <form method="post" action="procesar.php" class="formulario">
                <div class="user">
                    <div class="user_name">
                        <label class="user_label" for="nombre">Nombre</label>
                        <input class="user_input" type="text" id="nombre" name="nombre" placeholder="Lucas" required>
                    </div>
                    <div class="user_cedula">
                        <label class="user_label" for="cedula">Cédula</label>
                        <input class="user_input" type="text" id="cedula" name="cedula" placeholder="8-123-4567" required>
                    </div>
                </div>

                <div class="sub_title">
                    <div class="asignatura"><h6>Asignatura</h6></div>
                    <div><h6>Abreviatura</h6></div>
                    <div><h6>Notas</h6></div>
                </div>

                <div class="contenedor-materias" id="contenedor-materias">
                    <div class="materias">
                        <div>
                            <input type="text" name="materia[]" placeholder="Ej. Matemática" required>
                        </div>
                        <div>
                            <input type="text" name="codigo[]" placeholder="Ej. MAT-101" required>
                        </div>
                        <div>
                            <input type="number" name="nota[]" min="0" max="100" placeholder="91" required>
                        </div>
                    </div>
                    <div class="add_materia">
                        <button class="btn" type="button" onclick="agregarMateria()">Agregar otra materia</button>
                    </div>
                </div>

                <div class="exit_page">
                    <div>
                        <input type="submit" value="Enviar">
                    </div>
                    <div>
                        <input type="reset" value="Limpiar" id="resetBtn">
                    </div>
                </div>
            </form>
        <?php endif; ?>
    </div>

</body>
</html>
