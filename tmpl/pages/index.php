<?php
/**
 * Loaded as the home page of the site, or when no PATH is present.
 *
 * This page does not need to manage managerial contents, and is thus seperate
 * from the remainder of the site.
 */

// Include a title for the page, this is based off of general site information.

include __DIR__ . '/../components/header.php'; ?>

<h1>Hello world</h1>

<?php include __DIR__ . '/../components/footer.php'; ?>
