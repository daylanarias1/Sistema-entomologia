<?php
include 'public/clienteHeader.php';
?>

<main>
    <div class="divTabla">
        <table class="tabla">
            <thead>
                <tr>
                    <th>Especimen</th>
                    <th>Ubicacion</th>
                    <th>Recolector</th>
                </tr>
            </thead>
            <tbody id="cuerpo">
                <?php
                foreach ($vars['lista'] as $parque) {
                ?>
                    <tr>
                    <td><img src="<?php echo $parque[1]; ?>" style="max-width: 100px; max-height: 100px;" alt="alt" /></td>
                        <td><?php echo $parque[3]; ?></td>
                        <td><?php echo $parque[2]; ?></td>
                    </tr>
                <?php
                } //foreach
                ?>

            </tbody>
        </table>
    </div>
</main>


<?php
include_once './public/footer.php';
?>