<?php
loadJSFile('network');

// Establish infomraiton about the network chart.
$networkChartData = NetworkData::getInstance();
?>


<div id="network" class="page-section">

    <section class="content-extra-large">

        <section class="graph-container col">

            <div id="network-graph" chart-data='<?php print $networkChartData; ?>'></div>

        </section>

        <?php $networkInfo = PageDescription::getFromName( 'network' ); ?>

        <section class="network-info col">

            <h1><?php print __($networkInfo->title); ?></h1>

            <p><?php print __($networkInfo->description); ?></p>

            <?php if ( isset($networkInfo->alternate) && $networkInfo->alternate ) : ?>

                <a class="doc-link" href="<?php print $networkInfo->alternate; ?>">Documentation</a>

            <?php endif; ?>

        <seciton> <!-- .network-info -->

    </section> <!-- .content-extra-large -->

</div> <!-- #network -->
