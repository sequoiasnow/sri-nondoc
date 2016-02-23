<div id="staff" class="page-section">

    <?php $staffInfo = PageDescription::getFromName('staff'); ?>

    <div class="content">

        <h1><?php print __($staffInfo->title); ?></h1>

        <p><?php print __( $staffInfo->description ); ?></p>

    </div>

    <div class="content-extra-large group-container">

        <?php foreach ( AboutPerson::getAllInstances() as $person ) : ?>

            <article class="person card">

                <div class="card-content">

                    <div class="front" style="background-image: url(<?php print Image::get_path( $person->imagePath ); ?>)"></div>

                    <div class="back">
                        <h3 class="name">
                            <?php print $person->name; ?>
                        </h3>

                        <p class="description">
                            <?php print __( $person->description ); ?>
                        </p>

                        <?php if ( isset( $person->link ) && $person->link ) : ?>
                            <a class="doc-link" href="<?php print $person->link; ?>">More Info</a>
                        <?php endif; ?>
                    </div>

                </div>

            </article>

        <?php endforeach; ?>

    </div> <!-- .content-extra-large -->

</div> <!-- #staff -->
