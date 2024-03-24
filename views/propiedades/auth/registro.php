<?php

use Classes\UI;

$cliente;
$validacion;

?>

<main>
    <h1>Login</h1>

    <form action="" method="POST">
        <fieldset>
            <legend>Complete todos los campos</legend>

            <?php if (!empty($validacion)) {
                UI::mostrarEror($validacion);
            } ?>

            <div>
                <label class="label" for="nombre">Nombre</label>
                <input class="input" value="<?php echo sanitizarHTML($cliente->nombre) ?? ''; ?>" type="text" name="nombre" id="nombre" placeholder="Tu nombre">
            </div>

            <div>
                <label class="label" for="apellido">Apellido</label>
                <input class="input" value="<?php echo sanitizarHTML($cliente->apellido) ?? ''; ?>" type="text" name="apellido" id="apellido" placeholder="Tu apellido">
            </div>

            <div>
                <label class="label" for="telefono">Telefono</label>
                <input class="input" value="<?php echo sanitizarHTML($cliente->telefono) ?? ''; ?>" type="number" name="telefono" id="telefono" placeholder="Tu telefono">
            </div>

            <div>
                <label class="label" for="correo">Email</label>
                <input class="input" value="<?php echo sanitizarHTML($cliente->correo) ?? ''; ?>" type="email" name="correo" id="correo" placeholder="Tu email">
            </div>

            <div>
                <label class="label" for="password">Password</label>
                <input class="input" type="text" name="password" id="password" placeholder="Tu password">
            </div>

            <div class="div_buttom">
                <input class="buttom" type="submit" value="Crear Cuenta">
            </div>
        </fieldset>
    </form>
</main>