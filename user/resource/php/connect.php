<?php
/**
 * Created by PhpStorm.
 * User: Kamil
 * Date: 5/19/2017
 * Time: 12:30 PM
 */
$connection = mysqli_connect('localhost', '*', '*');
if (!$connection) {
    die("Database Connection Failed" . mysqli_error($connection));
}
$select_db = mysqli_select_db($connection, '*');
if (!$select_db) {
    die("Database Selection Failed" . mysqli_error($connection));
}

?>