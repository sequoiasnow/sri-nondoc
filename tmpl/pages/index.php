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

?>
    <nav id="primary-navigation">

        <a href="contact">Contact</a>

        <a href="equipment">Equipment</a>

        <a href="network">Netwok</a>

        <a href="technology">Technology</a>

    </nav> <!-- #primary-navigation -->

    <div id="title-section" class="page-section">

        <section class="content">

            <h1>Site Title</h1>

            <p class="slogan">A very, very, brief site slogan</p>

            <p class="description">
                Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi
            </p>

        </section>

    </div> <!-- #title-section -->

    <div id="title-overlay" class="page-section"></div>

    <div id="about" class="page-section">

        <section class="content">

            <h1>Who are we?</h1>

            <p>
                Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum. Donec elementum ligula eu sapien consequat eleifend. Donec nec dolor erat, condimentum sagittis sem. Praesent porttitor porttitor risus, dapibus rutrum ipsum gravida et. Integer lectus nisi, facilisis sit amet eleifend nec, pharetra ut augue. Integer quam
            </p>

            <div class="tags">

                <div class="tag">Research</div>
                <div class="tag">Science</div>
                <div class="tag">Communication</div>
                <div class="tag">Arctic</div>

            </div>

        </section>

    </div> <!-- #about -->

    <div id="product-groups" class="page-section">

        <section class="content">

            <h1>What do we do?</h1>

            <p>
                We make technology. Phones, Trackers, Satelite Communications, Networks. <br> We work hard to ensure that safety and security is achieved for arctic research while creating research equipment.
            </p>

        </section> <!-- .content -->

        <section class="group-container content-extra-large">

            <article class="group">

                <div class="front">
                    <div class="icon-container">
                        <span class="fa fa-phone"></span>
                    </div>

                    <div class="name">
                        <p>Satelite Phones</p>
                    </div>
                </div> <!-- .front -->

                <div class="back">
                    <div class="description">
                        <p>The phones available to Arctic researchers provide global reliable voice using a variety of satellite-based services.</p>
                    </div>

                    <a class="doc-link" href="">Documentation</a>
                </div> <!-- .back -->
            </article> <!-- .group -->

            <article class="group">

                <div class="front">
                    <div class="icon-container">
                        <span class="fa fa-phone"></span>
                    </div>

                    <div class="name">
                        <p>Satelite Phones</p>
                    </div>
                </div> <!-- .front -->

                <div class="back">
                    <div class="description">
                        <p>The phones available to Arctic researchers provide global reliable voice using a variety of satellite-based services.</p>
                    </div>

                    <a class="doc-link" href="">Documentation</a>
                </div> <!-- .back -->
            </article> <!-- .group -->

            <article class="group">

                <div class="front">
                    <div class="icon-container">
                        <span class="fa fa-phone"></span>
                    </div>

                    <div class="name">
                        <p>Satelite Phones</p>
                    </div>
                </div> <!-- .front -->

                <div class="back">
                    <div class="description">
                        <p>The phones available to Arctic researchers provide global reliable voice using a variety of satellite-based services.</p>
                    </div>

                    <a class="doc-link" href="">Documentation</a>
                </div> <!-- .back -->
            </article> <!-- .group -->

            <article class="group">

                <div class="front">
                    <div class="icon-container">
                        <span class="fa fa-phone"></span>
                    </div>

                    <div class="name">
                        <p>Satelite Phones</p>
                    </div>
                </div> <!-- .front -->

                <div class="back">
                    <div class="description">
                        <p>The phones available to Arctic researchers provide global reliable voice using a variety of satellite-based services.</p>
                    </div>

                    <a class="doc-link" href="">Documentation</a>
                </div> <!-- .back -->
            </article> <!-- .group -->


        </section> <!-- .group-container -->

    </div> <!-- #about -->

    <div id="network" class="page-section">

        <section class="content-extra-large">

            <section class="graph-container col">

                <div id="network-graph" chart-data='<?php print $networkChartData; ?>'></div>

            </section>

            <section class="network-info col">

                <h1>Network.</h1>

                <p>
                    Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum. Donec elementum ligula
                </p>


                <a class="doc-link" href="">
                    Documentation
                </a>

            <seciton>


        </section>

    </div>

    <div id="outreach" class="page-section">

        <div class="content">

            <h1>Who do we work with?</h1>

            <p>
                Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur
            </p>

        </div>

        <div class="content">

            <div class="outreach-list">

                <a href="">Polar Power</a>
                <a href="">Polar Power</a>
                <a href="">Polar Power</a>
                <a href="">Polar Power</a>
                <a href="">Polar Power</a>

            </div>

        </div> <!-- .content -->

    </div> <!-- .page-section -->

    <div id="staff" class="page-section">

        <div class="content">

            <h1>Who are 'we'?</h1>

            <p>
                We employ... Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur.
            </p>

        </div>

        <div class="content-extra-large">

            <article class="person card">

                <div class="front" style="background-image: url(http://www.sequoiasnow.com/sri-custom/data/images/person-elin_klaseen.jpg)"></div>

                <div class="back">
                    <h3 class="name">
                        Elin Klassen
                    </h3>

                    <p class="description">
                        Lorem Ipsum Dolor Sit Amet Consectetur Adipisicing Elit Sed Do Eiusmod Tempor Incididunt Ut Labore Et
                    </p>
                </div>

            </article>

        </div> <!-- .content-extra-large -->

    </div> <!-- #staff -->

    <div id="contact" class="page-section">

        <section class="content">

            <h1>Contact Us</h1>

            <?php echo $contactForm; ?>

        </section>

    </div> <!-- #contact -->

<?php include __DIR__ . '/../components/footer.php'; ?>
