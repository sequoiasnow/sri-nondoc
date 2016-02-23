<div id="title-section" class="page-section">

    <?php $titleInfo = PageDescription::getFromName( 'title' ); ?>

    <section class="content">

        <h1><?php print __( $titleInfo->title ); ?></h1>

        <p class="slogan"><?php print $titleInfo->alternate; ?></p>

        <p class="description">
            <?php echo __( $titleInfo->description ); ?>
        </p>

    </section>

</div> <!-- #title-section -->

<div id="title-overlay" class="page-section"></div>
