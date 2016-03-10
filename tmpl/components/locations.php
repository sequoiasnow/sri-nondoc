<section id="locations" class="page-section">

    <?php $locations = Locations::getAllInstances(); ?>

    <?php $locationsInfo = PageDescription::getFromName( 'locations' ); ?>

    <section class="content">

        <h1><?php echo __( $locationsInfo->title ); ?></h1>

        <p><?php echo __( $locationsInfo->description ); ?></p>

    </section>

    <section class="group-container content-extra-large">

        <?php foreach ( $locations as $location ) : ?>

            <article class="card">
                <div class="card-content">

                    <div class="front">
                        <div class="name">
                            <span><?php print __($location->name); ?></span>
                        </div>

                        <div class="location">
                            <span><?php $location->location; ?></span>
                        </div>
                    </div> <!-- .front -->

                    <div class="back">
                        <p class="description">
                            <?php print __($location->blurb); ?>
                        </p>

                        <a class="doc-link" href="<?php print $location->link; ?>"><?php print __('More'); ?></a>
                    </div> <!-- .back -->

                </div> <!-- .card-content -->

            </article> <!-- .card -->

        <?php endforeach; ?>

    </section> <!-- .content-extra-large -->

</section> <!-- .locations -->
