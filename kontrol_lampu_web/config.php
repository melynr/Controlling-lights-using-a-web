<?php 
$dbhost = 'localhost';
$dbuser = 'root';
$dbpass = '';
$dbname = 'control_lampu';

$dbcon = new mysqli($dbhost, $dbuser, $dbpass, $dbname);

if ($dbcon->connect_error) {
    die('server bermasalah');
}
?>