<div id="product-groups" class="page-section">

    <?php $productInfo = PageDescription::getFromName( 'product-groups' ); ?>

    <section class="content">

        <h1><?php print __($productInfo->title); ?></h1>

        <p><?php print __($productInfo->description); ?></p>

    </section> <!-- .content -->

    <section class="group-container content-extra-large">

        <?php
        // Get all of the descriptions for the fields.
        $groups = ProductGroup::getAllInstances();

        foreach ( $groups as $group ) : ?>

            <article class="card">
                <div class="card-content">

                    <div class="front">
                        <div class="icon-container">
                            <span class="fa fa-<?php print $group->icon; ?>"></span>
                        </div>

                        <div class="name">
                            <p><?php print __($group->title); ?></p>
                        </div>
                    </div> <!-- .front -->

                    <div class="back">
                        <div class="description">
                            <p><?php print __($group->blurb); ?></p>
                        </div>

                        <?php if ( isset( $group->doclink ) && $group->doclink ) : ?>
                            <a class="doc-link" href="<?php print $group->doclink; ?>">Documentation</a>
                        <?php endif; ?>
                    </div> <!-- .back -->
                </div> <!-- .card-content -->
            </article> <!-- .group -->

        <?php endforeach; ?>
    </section> <!-- .group-container -->

</div> <!-- #about -->
