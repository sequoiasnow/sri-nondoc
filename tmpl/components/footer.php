<?php
/**
 * @package AtomicAppointment
 *
 * Is included at the end of any template file and closes the opening container supplied in ./header.php
 */
?>
    <!-- Include scripts -->
    <?php foreach ( $GLOBALS['load_js_files'] as $file ) : ?>
        <script type="text/javascript" src="<?php echo $file; ?>"></script>
    <?php endforeach; ?>

</body>
</html>
