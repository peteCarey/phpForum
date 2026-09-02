<?php

define('DB_SERVER','localhost');
define('DB_USER','peterca5_root'); // for hosting
// for the browser on the local browser use the line below instead
// define('DB_USER','root');
define('DB_PASS','diogoJota20!');
define('DB_NAME','peterca5_forum_test');

$con = mysqli_connect(DB_SERVER, DB_USER, DB_PASS, DB_NAME, 3307);
if (!$con) {
    die("DB connection failed: " . mysqli_connect_error());
}
mysqli_set_charset($con, "utf8mb4");

?>