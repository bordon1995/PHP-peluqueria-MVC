<?php

use Classes\UI;

?>

<header class="nav">
    <a href="/admin">Crear cita</a>
    <a href="/logoaut">Cerrar Secion</a>
</header>

<main>
    <section id="editar">
        <h1><?php echo $validacion['cita'] ?? 'Tus citas' ?></h1>
        <div class="contenedor-citas">
            <?php if (!empty($citas)) {
                UI::mostrarCitas($citas);
            } ?>
        </div>
    </section>
</main>