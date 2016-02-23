<?php
// Load the neccessary javascript from google and local sources.
loadJSFIle('locations');
loadJSFIle('https://maps.googleapis.com/maps/api/js?key=AIzaSyA6xp13NtMvh2XviWDVj8uWfmhZVuaLw_U&callback=initMap');
?>


<section id="locations" class="page-section">

    <?php $locations = Locations::getAllInstances(); ?>

    <div id="locations-list" style="display-none">

        <?php foreach ( $locations as $location ) : ?>

            <?php
            // Establish the coordinates.
            $cordinates = array(
                'lat' => floatval($location->latitude),
                'lng' => floatval($location->longitude),
            );
            ?>


            <div class="location"
                 data-lat="<?php print floatval($location->latitude); ?>"
                 data-lng="<?php print floatval($location->longitude); ?>">
                <a class="location-name" href="<?php print $location->link; ?>"><?php print __($location->name); ?></a>
            </div>

        <?php endforeach; ?>

    </div>

    <div id="locations-map">

    </div>

</section> <!-- .locations -->
