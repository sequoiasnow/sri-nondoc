
<div id="contact" class="page-section">

    <?php
    $pageDescription = PageDescription::getFromName( 'contact' );
    $contactInfo     = ContactInfo::getInstance();
    ?>

    <section class="content">

        <h1><?php print __( $pageDescription->title ); ?></h1>

        <ul>

            <li>
                <div class="icon">
                    <i class="fa fa-phone"></i>
                </div>

                <span><?php print __($contactInfo->phone); ?></span>
            </li>

            <li>
                <div class="icon">
                    <i class="fa fa-envelope-o"></i>
                </div>

                <span><?php print __($contactInfo->email); ?></span>
            </li>

            <li>
                <div class="icon">
                    <i class="fa fa-map-marker"></i>
                </div>

                <span><?php print __($contactInfo->location); ?></span>
            </li>

        </ul>

    </section>

</div> <!-- #contact -->
