<?php
define('DB_SERVER', 'localhost');
define('DB_USERNAME', 'username');    // DB username
define('DB_PASSWORD', 'password');    // DB password
define('DB_DATABASE', 'database');      // DB name
define('FB_APP_ID','');
define('FB_APP_SECRET', '');
$con  = new mysqli($DB_SERVER, $DB_USERNAME, $DB_PASSWORD, $DB_DATABASE);
if ($con->connect_errno) {
    echo "Failed to connect to MySQL: (" . $con->connect_errno . ") " . $con->connect_error;
}
?>
