<?php
/**
 * Loaded as the home page of the site, or when no PATH is present.
 *
 * This page does not need to manage managerial contents, and is thus seperate
 * from the remainder of the site.
 */

// Information for contacts.
$contactForm = new Form( array(
    'action' => '',
    'fields' => array(
        new TextField( array(
            'name'        => 'name',
            'placeholder' => 'John Doe',
        ) ),
        new TextField( array(
            'name'        => 'email',
            'placeholder' => 'example@email.com',
        ) ),
        new TextAreaField( array(
            'name'        => 'message',
            'placeholder' => 'Your message here.',
        ) ),
        new SubmitField( array(
            'name'  => 'submit',
            'value' => 'Send',
        ) ),
    )
), false);

// Establish infomraiton about the network chart.
$networkChartData = NetworkData::getInstance();

include __DIR__ . '/../components/header.php';

// Add the neccessary javascript.
loadJSFile('network');
loadJSFile('navigation');

?>
    <nav id="primary-navigation">



        <a href="#about">About</a>

        <a href="#product-groups">Products</a>

        <a href="#network">Netwok</a>

        <a href="#contact">Contact</a>

    </nav> <!-- #primary-navigation -->


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

    </div> <!-- #about -->

    <div id="product-groups" class="page-section">

        <?php $productInfo = PageDescription::getFromName( 'product-groups' ); ?>

        <section class="content">

            <h1><?php print $productInfo->title; ?></h1>

            <p><?php print $productInfo->description; ?></p>

        </section> <!-- .content -->

        <section class="group-container content-extra-large">

            <?php
            // Get all of the descriptions for the fields.
            $groups = ProductGroup::getAllInstances();

            foreach ( $groups as $group ) : ?>

                <article class="group">

                    <div class="front">
                        <div class="icon-container">
                            <span class="fa fa-<?php print $group->icon; ?>"></span>
                        </div>

                        <div class="name">
                            <p><?php print $group->title; ?></p>
                        </div>
                    </div> <!-- .front -->

                    <div class="back">
                        <div class="description">
                            <p><?php print $group->blurb; ?></p>
                        </div>

                        <a class="doc-link" href="">Documentation</a>
                    </div> <!-- .back -->
                </article> <!-- .group -->

            <?php endforeach; ?>
        </section> <!-- .group-container -->

    </div> <!-- #about -->

    <div id="network" class="page-section">

        <section class="content-extra-large">

            <section class="graph-container col">

                <div id="network-graph" chart-data='<?php print $networkChartData; ?>'></div>

            </section>

            <?php $networkInfo = PageDescription::getFromName( 'network' ); ?>

            <section class="network-info col">

                <h1><?php print $networkInfo->title; ?></h1>

                <p><?php print $networkInfo->description; ?></p>

                <a class="doc-link" href="">Documentation</a>

            <seciton> <!-- .network-info -->

        </section> <!-- .content-extra-large -->

    </div> <!-- #network -->

    <div id="outreach" class="page-section">

        <?php $outreachInfo = PageDescription::getFromName( 'outreach' ); ?>

        <div class="content">

            <h1><?php print $outreachInfo->title; ?></h1>

            <p><?php print $outreachInfo->description; ?></p>

        </div>

        <div class="content">

            <div class="outreach-list">

                <?php
                $outreachSites = OutreachElement::getAllInstances();


                foreach ( $outreachSites as $site ) : ?>

                    <a href="<?php print $site->url; ?>"><?php print __( $site->name ); ?></a>

                <?php endforeach; ?>

            </div>

        </div> <!-- .content -->

    </div> <!-- .page-section -->

    <div id="staff" class="page-section">

        <?php $staffInfo = PageDescription::getFromName('staff'); ?>

        <div class="content">

            <h1><?php print $staffInfo->title; ?></h1>

            <p><?php print __( $staffInfo->description ); ?></p>

        </div>

        <div class="content-extra-large">

            <?php foreach ( AboutPerson::getAllInstances() as $person ) : ?>

                <article class="person card">

                    <div class="front" style="background-image: url(<?php print Image::get_path( $person->imagePath ); ?>)"></div>

                    <div class="back">
                        <h3 class="name">
                            <?php print $person->name; ?>
                        </h3>

                        <p class="description">
                            <?php print __( $person->description ); ?>
                        </p>
                    </div>

                </article>

            <?php endforeach; ?>

        </div> <!-- .content-extra-large -->

    </div> <!-- #staff -->

    <div id="contact" class="page-section">

        <?php $contactInfo = PageDescription::getFromName( 'contact' ); ?>

        <section class="content">

            <h1><?php print $contactInfo->title; ?></h1>

            <?php echo $contactForm; ?>

        </section>

    </div> <!-- #contact -->

<?php include __DIR__ . '/../components/footer.php'; ?>
