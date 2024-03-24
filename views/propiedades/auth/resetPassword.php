<main class="<?php echo $login_form ?? '' ?>">
    <h1>Recuperar Password</h1>

    <form action="" method="POST">
        <fieldset>
            <legend>Complete todos los campos</legend>

            <div>
                <label class="label" for="correo">Email</label>
                <input class="input" type="email" name="correo" id="correo" placeholder="Tu email">
            </div>

            <div class="div_buttom">
                <input class="buttom" type="submit" value="Recuperar Password">
            </div>

        </fieldset>
    </form>
</main>