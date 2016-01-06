<?php
/**
 * Loaded as the home page of the site, or when no PATH is present.
 *
 * This page does not need to manage managerial contents, and is thus seperate
 * from the remainder of the site.
 */

include __DIR__ . '/../components/header.php'; ?>

    <div id="title-section" class="page-section">

        <h1>Site Title</h1>

        <p>A very, very, brief site slogan</p>

    </div> <!-- #title-section -->

    <div id="title-overlay" class="page-section"></div>

    <nav id="primary-navigation">

        <a href="contact">Contact</a>

        <a href="equipment">Equipment</a>

        <a href="network">Netwok</a>

        <a href="technology">Technology</a>

    </nav> <!-- #primary-navigation -->

    <div id="about" class="page-section">

        

    </div> <!-- #about -->


<?php include __DIR__ . '/../components/footer.php'; ?>
