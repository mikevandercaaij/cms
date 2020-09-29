<?php

$db['db_host'] = "localhost";
$db['db_user'] = "mike";
$db['db_pass'] = "XwVgFwGq";
$db['db_name'] = "mike";

foreach($db as $key => $value) {
    define(strtoupper($key), $value);
}

$connection = mysqli_connect(DB_HOST, DB_USER, DB_PASS, DB_NAME);

if(!$connection) {
echo 'query error: ' . '<br>' . mysqli_error($connection);
}

?>