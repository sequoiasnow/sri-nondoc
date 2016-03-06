<?php
/**
 * Loaded as the home page of the site, or when no PATH is present.
 *
 * This page does not need to manage managerial contents, and is thus seperate
 * from the remainder of the site.
 */

loadComponetTempalte( 'header' ); ?>

    <?php loadComponetTempalte( 'navigation' ); ?>

    <div id="page">

        <?php loadComponetTempalte( 'title-overlay' ); ?>

        <?php loadComponetTempalte( 'about' ); ?>

        <?php loadComponetTempalte( 'product-groups' ); ?>

        <?php loadComponetTempalte( 'network' ); ?>

        <?php loadComponetTempalte( 'work-with' ); ?>

        <?php loadComponetTempalte( 'staff' ); ?>

        <?php loadComponetTempalte( 'locations' ); ?>

        <?php // loadComponetTempalte( 'contact' ); ?>

    </div>

<?php loadComponetTempalte( 'footer' ); ?>
