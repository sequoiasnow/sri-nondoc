<?php
/**
 * Override any defaults in this file in order to load the site and install
 * it on a new machine.
 *
 * Once finished overriding the defaults simply execute make mysql.
 */

/**
 * The host of your mysql database.
 */
define( 'DB_HOST', 'localhost' );

/**
 * The name of your mysql database user.
 */
define( 'DB_USER', 'atomic-user' );

/**
 * The password of your mysql user.
 */
define( 'DB_PASS', '1618atomicApp' );

/**
 * The name of your mysql database.
 */
define( 'DB_NAME', 'atomic_appointment' );

/**
 * The name of your mysql table prefix, used to allow multiple sites in a
 * single database.
 */
define( 'DB_TABLE_PREFIX', 'ATOMIC_' );
