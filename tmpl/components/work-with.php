<div id="work-with" class="page-section">

    <?php $wwInfo = PageDescription::getFromName( 'work-with' ); ?>

    <div class="content">

        <h1><?php print __($wwInfo->title); ?></h1>

        <p><?php print __($wwInfo->description); ?></p>

    </div>

    <?php
    // Get all the icons for the work-with list.
    $workWith = WorkWith::getAllInstances();
    ?>

    <section class="group-container content-extra-large">

        <?php foreach ( $workWith as $group ) : ?>

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

        <?php endforeach; ?>

    </section> <!-- .group-container -->

</div> <!-- .page-section -->
