<?php

use Classes\UI;

?>

<main class="<?php echo $login_form ?? '' ?>">
    <h1>Login</h1>

    <form action="" method="POST">
        <fieldset>
            <legend>Complete todos los campos</legend>

            <?php if (!empty($validacion)) {
                UI::mostrarEror($validacion);
            } ?>

            <div>
                <label class="label" for="correo">Email</label>
                <input class="input" type="email" name="correo" id="correo" placeholder="Tu email">
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