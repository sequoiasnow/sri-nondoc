<div id="about" class="page-section">

    <?php $aboutInfo = PageDescription::getFromName( 'about' ); ?>

    <section class="content">

        <h1><?php echo __( $aboutInfo->title ); ?></h1>

        <p><?php echo __( $aboutInfo->description ); ?></p>

        <div class="tags">

            <?php foreach ( explode( $aboutInfo->alternate, ' ' ) as $tag ) : ?>

                <div class="tag"><?php print $tag; ?></div>

            <?php endforeach; ?>

        </div>

    </section>

    <section class="group-container content-extra-large">

        <?php
        // Get all of the descriptions for the fields.
        $groups = AboutLink::getAllInstances();

        foreach ( $groups as $group ) : ?>

            <article class="card">
                <div class="card-content">

                    <div class="front">
                        <div class="image-container">
                            <img src="<?php print Image::get_path( $group->image ); ?>" />
                        </div>

                        <div class="name">
                            <p><?php print __($group->title); ?></p>
                        </div>
                    </div> <!-- .front -->

                    <div class="back">
                        <div class="description">
                            <p><?php print __($group->blurb); ?></p>
                        </div>

                        <a class="doc-link" href="<?php print $group->link; ?>"><?php print __('Go!'); ?></a>
                    </div> <!-- .back -->

                </div> <!-- .card-content -->
            </article> <!-- .group -->

        <?php endforeach; ?>
    </section> <!-- .group-container -->

</div> <!-- #about -->
