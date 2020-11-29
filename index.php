<?php

include('includes/config.php');
global $config;



// Lets check for the query string
if (!$_GET['username'])
{
        // User / Profile not found.
        // Lets displauy something funny
        echo "Looking for something?";
        die;
}

$link = mysql_connect($config['DB_SERVER'], $config['DB_USER'], $config['DB_PASSWORD']);
if (!$link) {
    die('Could not connect: ' . mysql_error());
}

// make foo the current db
$db_selected = mysql_select_db($config['DB_DB', $link);
if (!$db_selected) {
    die ('Can\'t use foo : ' . mysql_error());
}

$username = $_GET['username'];

$result = mysql_query("SELECT * FROM profiles WHERE username = '$username'");

$profile = mysql_fetch_assoc($result);

// if we should display a footer or not
$footer = FALSE;

// Our social media template (Which is mobile ready)
include_once('template.html');


// close the link
mysql_close($link);


?>
