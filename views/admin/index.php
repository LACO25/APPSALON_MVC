<h1 class="nombre-pagina">Panel de administración</h1>

<?php include_once __DIR__ . '/../templates/barra.php'; ?>

<h2> Buscar citas</h2>
<div class="busqueda">
    <form class="formulario">
        <div class="campo">
            <label for="fecha">Fecha</label>
            <input type="date" id="fecha" name="fecha" value="<?php echo $fecha; ?>" />
        </div>
    </form>
</div>

<?php
if (count($citas) === 0) {
    echo "<h2>¡Ups!</h2>";
}
?>


<div id="citas-admin">
    <ul class="citas">
        <?php
        $idCita = '';

        if (empty($citas)) { ?>
            <p class="alerta exito"> No cuenta con citas en este día, puede consultar otra fecha </p>
            <?php }

        foreach ($citas as $key => $cita) {

            if ($idCita != $cita->id) {
                $total = 0;
            ?>
                <li>
                    <p>ID: <span><?php echo $cita->id; ?></span></p>
                    <p>Hora: <span><?php echo $cita->hora; ?></span></p>
                    <p>Cliente: <span><?php echo $cita->cliente; ?></span></p>
                    <p>Email: <span><?php echo $cita->email; ?></span></p>
                    <p>Telefono: <span><?php echo $cita->telefono; ?></span></p>

                    <h3>SERVICIOS</h3>

                <?php $idCita = $cita->id;
            } //fin de if
            $total += $cita->precio;

                ?>
                <p class="servicio"><?php echo $cita->servicio . " " . $cita->precio; ?></p>

                <?php
                $actual = $cita->id;
                $proximo = $citas[$key + 1]->id ?? 0;

                if (esUltimo($actual, $proximo)) {
                    //echo "Si es ultimo"; 
                ?>
                    <p class="total">Total: <span>$ <?php echo $total; ?></p>

                    <form action="/api/eliminar" method="POST">
                        <input type="hidden" name="id" value=" <?php echo $cita->id; ?>">
                        <input type="submit" class="boton-eliminar" value="Eliminar">
                    </form>
                <?php
                }

                ?>
            <?php } // Fin de foreach 
            ?>
    </ul>
</div>

<?php $script = "
    <script src='build/js/buscador.js'></script> 
"; //cargo solo un script para esta pagina
?>