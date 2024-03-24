<?php

namespace Classes;

class UI
{
    public static function mostrarEror($array)
    {
        foreach ($array as $error) {
?>
            <div class="error">
                <p><?php echo $error ?></p>
            </div>
            <?php
        }
    }

    public static function mostrarCitas($array)
    {
        $id = null;
        foreach ($array as $cita) {
            if ($id !== $cita->id) {
            ?>
                <div class="cards-citas">
                    <div class="info-cita">
                        <div class="info-fecha-hora">
                            <p><?php echo $cita->fecha ?></p>
                            <p><?php echo $cita->hora ?></p>
                        </div>
                        <ul>
                            <?php
                            $id = $cita->id;
                            foreach ($array as $servicios) {
                                if ($id === $servicios->id) {
                            ?>
                                    <li class="info-li">
                                        <span><?php echo $servicios->precio ?></span>
                                        <span>|</span>
                                        <p><?php echo $servicios->servicio ?></p>
                                    </li>
                                <?php } ?>
                            <?php } ?>
                        </ul>
                    </div>
                    <form action="/mis-citas" method="POST" class="button-cita">
                        <input type="hidden" name="servicio" value="<?php echo $cita->id ?>">
                        <input type="submit" value="Eliminar">
                    </form>
                </div>
<?php
            };
        };
    }
}
