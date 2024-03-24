<header class="nav">
    <a href="/mis-citas">Mis Citas</a>
    <a href="/logoaut">Cerrar Secion</a>
</header>

<main>
    <section id="admin">
        <h1>Crea una nueva cita</h1>
        <h2 data-nombre="<?php echo $nombre ?? '' ?>" data-id="<?php echo $id ?? '' ?>">Bienvenido <?php echo $nombre ?? '' ?></h2>
        <nav class="tabs">
            <button id="1" class="button_actual" type="button" data-paso="1">Servicios</button>
            <button id="2" class="button" type="button" data-paso="2">Informacion Citas</button>
            <button id="3" class="button" type="button" data-paso="3">Resumen</button>
        </nav>

        <div id="app">

            <div class="mostrar" id="paso-1">
                <h2>Servicios</h2>
                <div id="servicios" class="servicios"></div>
            </div>

            <div class="ocultar" id="paso-2">
                <h2>Crea una cita</h2>
                <form action="">
                    <div class="div_admin">
                        <label class="label" for="date">Fecha</label>
                        <input class="input admin" type="date" id="date" min="<?php echo date('Y-m-d'); ?>">
                    </div>

                    <div class="div_admin">
                        <label class="label" for="time">Hora</label>
                        <input class="input admin" type="time" id="time">
                    </div>

                    <div class="div_buttom">
                        <button class="buttom button" type="button" data-paso="4">Crear Cita</button>
                    </div>
                </form>
            </div>

            <div class="ocultar" id="paso-3">
                <h2>Tu resumen</h2>
            </div>

        </div>
        <div class="paginacion">
            <button id="anterior" class="buttom button ocultarPaginador">&laquo; Anterior</button>
            <button id="siguiente" class="buttom button">Siguiente &raquo;</button>
        </div>
    </section>
</main>

<?php
$script = "<script src='/js/app.js' type='module'></script>";
?>